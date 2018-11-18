<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Session;
use Cake\Event\Event;
use Robotusers\Excel\Registry;
use Cake\I18n\Time;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

use Box\Spout\Writer\Style\StyleBuilder;
use Box\Spout\Writer\Style\Color;

use Box\Spout\Writer\Style\Border;
use Box\Spout\Writer\Style\BorderBuilder;

/**
 * Ventas Controller
 *
 * @property \App\Model\Table\VentasTable $Ventas
 *
 * @method \App\Model\Entity\Venta[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VentasController extends AppController
{

    public function isAuthorized($user){

        if(isset($user['role']) && $user['role'] === 'usuario'){
            if(in_array($this->request->action, ['index','add','reporteDiarioVendedor','reporteClientesVentas','detalles'])){
                return true;
            }
        }

        return parent::isAuthorized($user);

    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        if($this->Auth->user('role') === 'usuario'){
            $usuario = $this->Ventas->Usuarios->find('all', ['contain'=>['Rutas'],'conditions' => ['id' => $this->Auth->user('id') ]])->first();
            if($usuario){
                $rutas = [];
                foreach ($usuario->rutas as $key => $value) {
                    $rutas[$value->id]=$value->id;
                }
            }
        }else{
            $rutas = $this->Ventas->Clientes->Rutas->find('list')->toArray();
        }

        $options = [
            'contain' => ['Rutas','Clasificaciones'],
            'conditions' => ['ruta_id IN' => array_keys($rutas)]
        ];

        if(!is_null($this->request->data('buscar'))){
            $options['conditions'] = array_merge($options['conditions'],['nombres LIKE' => '%'.$this->request->data('buscar').'%']);
        }
        $this->paginate = $options;
        $clientesTable = TableRegistry::get('Clientes');
        $clientes = $this->paginate($clientesTable);
        $this->set(compact('clientes'));
    }

    public function getVentas($usuario_id,$fecha){
        $control = $this->Ventas->find();
        $ventas =  $control->select([
                                        'id',
                                        'monto_total' => $control->func()->sum('monto_total'),
                                        'monto_efectivo' => $control->func()->sum('monto_efectivo'),
                                        'monto_transferencia' => $control->func()->sum('monto_transferencia'),
                                        'cuenta_porcobrar' => $control->func()->sum('cuenta_porcobrar'),
                                        'monto_cartera' => $control->func()->sum('monto_cartera'),
                                    ])
                                ->where([
                                        'Ventas.usuario_id' => $usuario_id,
                                        'Ventas.fecha' => $fecha,
                                        'Ventas.monto_total IS NOT NULL'
                                    ])
                                ->first();
        $valores = [];
        if($ventas){
            $valores['monto_total'] = $ventas->monto_total; 
            $valores['monto_efectivo'] = $ventas->monto_efectivo; 
            $valores['monto_transferencia'] = $ventas->monto_transferencia; 
            $valores['cuenta_porcobrar'] = $ventas->cuenta_porcobrar; 
            $valores['monto_cartera'] = $ventas->monto_cartera; 
            $valores['deuda'] = $ventas->cuenta_porcobrar-$ventas->monto_cartera; 
        }
        return $valores;
    }

    public function confirmaTransferencia(){
        $flag = false;
        $venta = $this->Ventas->get($this->request->data('venta_id'), [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $venta = $this->Ventas->patchEntity($venta, ['confirma_transferencia'=>true]);
            if ($this->Ventas->save($venta)) {
                $flag = true;
            }
        }

        die(json_encode(['success'=>$flag]));
    }


    public function cantidadVentaPorProducto($usuarioId=null,$fecha=null){
        $producto = [];
        $consolidado = $this->Ventas->VentaDetalles->find();
        $consolidados = $consolidado->select([
                                'VentaDetalles.producto_id',
                                'total' => $consolidado->func()->sum('VentaDetalles.cantidad')
                            ])
                   ->innerJoinWith('Ventas')
                   ->where(['Ventas.fecha'=>$fecha,'Ventas.usuario_id'=>$usuarioId])
                   ->group(['VentaDetalles.producto_id'])
                   ->toArray();
        if($consolidados){
            foreach ($consolidados as $key => $value) {
                $producto[$value->producto_id] = $value->total;
            }
        }
        return $producto;
    }


    public function getCarteraRecogida($usuario_id,$fecha){
        $ventas = $this->Ventas->find()
                                ->contain('Clientes')
                                ->where([
                                        'Ventas.usuario_id' => $usuario_id,
                                        'Ventas.fecha' => $fecha,
                                        'Ventas.monto_cartera IS NOT NULL'
                                    ])
                                ->toArray();
        //$valores = [];
        /*if($ventas){
            $valores['monto_total'] = $ventas->monto_total; 
            $valores['monto_efectivo'] = $ventas->monto_efectivo; 
            $valores['monto_transferencia'] = $ventas->monto_transferencia; 
            $valores['cuenta_porcobrar'] = $ventas->cuenta_porcobrar; 
            $valores['monto_cartera'] = $ventas->monto_cartera; 
            $valores['deuda'] = $ventas->cuenta_porcobrar-$ventas->monto_cartera; 
        }
        */
        return $ventas;
    }


    public function reporteDiarioVendedor(){

        if($this->request->is('post')){

            $this->viewBuilder()->setLayout('excel');

            $valoresPadreTable = TableRegistry::get('ParametrosValoresPadre');
            $paramsTipoTable = TableRegistry::get('ParametrosTipos');
            $paramsTipoDiario = $paramsTipoTable->find('list')->where(['tipo'=>'Diario'])->toArray();
            $paramsTipoGasto = $paramsTipoTable->find('list')->where(['tipo'=>'Gasto'])->toArray();
            $productosTable = TableRegistry::get('Productos');
            $productos = $productosTable->find('list')->toArray();



            if($this->request->data('usuario_id') == null){
                $this->request->data('usuario_id',$this->Auth->user('id'));
            }

            $usuario = $this->Ventas->Usuarios->find()->where(['Usuarios.id'=>$this->request->data('usuario_id')])->first();

            if($this->request->data('fecha') == null){
                $this->request->data('fecha',date('Y-m-d'));
            }

            // $fechaFormat = new Time($this->request->data('fecha'));
            // $this->request->data('fecha',$fechaFormat->format('Y-m-d'));

            $fechaFormat = new Time($this->request->data('fecha'));
            $this->request->data('fecha',$fechaFormat->format('Y-m-d'));
            $fecha = $this->request->data('fecha');

            $ventas = $this->getVentas($this->request->data('usuario_id'),$this->request->data('fecha'));
            

            $resultados = $valoresPadreTable->find('all')
                                            ->contain(['ParametrosValores','ParametrosTipos'])
                                            ->where([
                                                'ParametrosValoresPadre.fecha' => $this->request->data('fecha'),
                                                'ParametrosValoresPadre.usuario_id' => $this->request->data('usuario_id')
                                                ]
                                            );

            $resultados = $resultados->toArray();
            $valores = $diario = $gasto = [];

            if($resultados){
                
                foreach ($resultados as $key => $value) {
                    $valores[$value->parametros_tipo->tipo][$value->parametros_tipo_id]['nombre'] = $value->parametros_tipo->nombre;
                    $valores[$value->parametros_tipo->tipo][$value->parametros_tipo_id]['valores'] = [];
                    // $valores[$value->parametros_tipo->tipo][$value->parametros_tipo_id]['cantidad'] = '';

                    foreach ($value->parametros_valores as $key2 => $value2) {
                        if($value->parametros_tipo->tipo == 'Diario'){

                            if(!isset($valores[$value->parametros_tipo_id]['valores'][$value2->producto_id])){

                                $valores[$value->parametros_tipo->tipo][$value->parametros_tipo_id]['valores'][$value2->producto_id]['cantidad'] = $value2->monto_o_cantidad;
                                $valores[$value->parametros_tipo->tipo][$value->parametros_tipo_id]['valores'][$value2->producto_id]['nombre'] = $productos[$value2->producto_id];

                            }else{
                                 $valores[$value->parametros_tipo->tipo][$value->parametros_tipo_id]['valores'][$value2->producto_id]['cantidad']+=$value2->monto_o_cantidad;
                            }

                        }else{

                            if(!isset($valores[$value->parametros_tipo->tipo][$value->parametros_tipo_id]['cantidad'])){
                                 // pr('a');
                                $valores[$value->parametros_tipo->tipo][$value->parametros_tipo_id]['cantidad'] = $value2->monto_o_cantidad;

                            }else{
                                 // pr('b');
                                $valores[$value->parametros_tipo->tipo][$value->parametros_tipo_id]['cantidad']+=$value2->monto_o_cantidad;
                            }

                        }
                        
                    }
                }
                
                
            }

             //prx($paramsTipoDiario);

            foreach ($paramsTipoDiario as $keyT => $valueT) {
                $newValor = [];
                foreach ($productos as $keyP => $valueP) {

                    if(isset($valores['Diario'][$keyT]['valores'][$keyP])){
                        $newValor[$keyP] = $valores['Diario'][$keyT]['valores'][$keyP];
                    }else{
                        $newValor[$keyP] = [
                                        'nombre' => $valueP,
                                        'cantidad' => ''
                                    ];
                    }
                }
                $diario[$keyT]['nombre'] = $valueT;
                $diario[$keyT]['valores'] = $newValor;
            }

            ////Cantidad de Ventas//////
            $ventasCantidadProducto = $this->cantidadVentaPorProducto($this->request->data('usuario_id'),$this->request->data('fecha'));
            foreach ($productos as $keyP => $valueP) {

                if(isset($ventasCantidadProducto[$keyP])){
                    $newValor[$keyP]['nombre'] = $productos[$keyP];
                    $newValor[$keyP]['cantidad'] = $ventasCantidadProducto[$keyP];
                }else{
                    $newValor[$keyP] = [
                                    'nombre' => $valueP,
                                    'cantidad' => ''
                                ];
                }
            }
            $numVentas = [
                        'nombre' => 'Ventas',
                        'valores' => $newValor
                    ];

            array_push($diario,$numVentas);


                
            foreach ($paramsTipoGasto as $keyT => $valueT) {
                $newValor = [];

                    if(isset($valores['Gasto'][$keyT])){
                        $newValor = $valores['Gasto'][$keyT]['cantidad'];
                    }else{
                        $newValor = '';
                    }
                $gasto[$keyT]['nombre'] = $valueT;
                $gasto[$keyT]['cantidad'] = $newValor;
            }

            $header[] = '';
            $header = array_merge($header,$productos);


            ///CARTERA RECOGIDA////
            $carteraRecogida = $this->getCarteraRecogida($this->request->data('usuario_id'),$this->request->data('fecha'));
            //prx($carteraRecogida);

            

            // prx($valores); // Todo
            // pr($diario); //Depende de valores, ya esta ordenado
            // pr($ventas); //tOTALES DE MOVIMIENTO->TOTAL,EFECTIVO,TRANSFERENCIA
            // prx($gasto); //Depende de valores, ya esta ordenado

            $excel = 1;
            $name = 'Reporte_diario_'.$fecha;
            $this->set(compact('header','diario','excel','name','ventas','gasto','usuario','carteraRecogida'));

        }

        if($this->Auth->user('role') == 'admin'){
            $usuarios = $this->Ventas->Usuarios->find('list', ['limit' => 200]);
        }else{
            $usuarios = $this->Ventas->Usuarios->find('list', ['conditions' => ['Usuarios.id' => $this->Auth->user('id')] ,'limit' => 200]);
        }
        
        $this->set(compact('usuarios'));

    }//Fin reporteDiarioVendedor


    public function reporteClientesVentas(){


        if($this->request->is('post')){

            $this->viewBuilder()->setLayout('excel');

            if($this->request->data('fecha') == null){
                $this->request->data('fecha',date('Y-m-d'));
            }

            $fechaFormat = new Time($this->request->data('fecha'));
            $this->request->data('fecha',$fechaFormat->format('Y-m-d'));
            $fecha = $this->request->data('fecha');


            $productosTable = TableRegistry::get('Productos');
            $productos = $productosTable->find('list')->toArray();

            $comunasTable = TableRegistry::get('Comunas');
            $comunas = $comunasTable->find('list')->toArray();

            $ventas = $this->Ventas->find()
                                ->contain([
                                        // 'VentaDetalles'=> function($q) {
                                        //                     return $q
                                        //                         ->select([
                                        //                             'id',
                                        //                             'venta_id',
                                        //                             'total_producto' => $q->func()->sum('cantidad')
                                        //                         ])
                                        //                         ->group(['VentaDetalles.id']);
                                        //                 },
                                        'VentaDetalles',
                                        'Clientes'
                                     ])
                                ->where([
                                        'Ventas.fecha' => $fecha,
                                        'Ventas.monto_total IS NOT NULL'
                                    ]);


            if($this->request->data('usuario_id') == null && $this->Auth->user('role') == 'usuario'){
                 $ventas->where([
                                'Ventas.usuario_id' => $this->Auth->user('id')
                            ]);
            }

            $ventas = $ventas->toArray();

             //prx($ventas);
            $header = ['Cliente',utf8_encode('Direccion')];
            $header = array_merge($header,$productos);
            $header = array_merge($header,['Monto Efectivo','Monto Transferencia','CXC',utf8_encode('Observacion')]);

            $detallesVentas = [];
            foreach ($ventas as $key => $value) {
                $detalle = [
                            'id' => $value->cliente->id,
                            'nombre' => $value->cliente->nombres,
                            'direccion' => $value->cliente->calle." ".$value->cliente->numero_calle." ".$value->cliente->dept_casa_oficina_numero." (".$comunas[$value->cliente->comuna_id].")",
                            'observacion' => $value->cliente->observacion,
                            'monto_efectivo' => $value->monto_efectivo,
                            'monto_transferencia' => $value->monto_transferencia,
                            'cuenta_porcobrar' => $value->cuenta_porcobrar,
                            'monto_cartera' => $value->monto_cartera,
                        ];
                $producVenta = [];
                foreach ($productos as $keyP => $valueP) {
                    $detail = '';
                    foreach ($value->venta_detalles as $keyV => $valueV) {
                        if($valueV->producto_id === $keyP){
                            $detail = $valueV->cantidad;
                            break;
                        }
                    }
                    $producVenta[]=$detail;
                }

                $detalle['productos'] = $producVenta;
                $detallesVentas[] = $detalle;
            }

     //       pr($header);
       //     prx($detallesVentas);


            $excel = 1;
            $name = 'Ventas_'.$fecha;
            $this->set(compact('header','detallesVentas','excel','name'));

        }

        if($this->Auth->user('role') == 'admin'){
            $usuarios = $this->Ventas->Usuarios->find('list', ['limit' => 200]);
        }else{
            $usuarios = $this->Ventas->Usuarios->find('list', ['conditions' => ['Usuario.id' => $this->Auth->user('id')] ,'limit' => 200]);
        }
        
        $this->set(compact('usuarios'));
        
    }


    public function reporteConsolidadoVentasUsuario(){

        if($this->request->is('post')){


            $this->viewBuilder()->setLayout('excel');

            if($this->request->data('fecha') == null){
                $this->request->data('fecha',date('Y-m-d'));
            }

            $fechaFormat = new Time($this->request->data('fecha'));
            $this->request->data('fecha',$fechaFormat->format('Y-m-d'));
            $fecha = $this->request->data('fecha');
//exit('gggff');
            $consolidado = TableRegistry::get('Usuarios')->find();
            $consolidados = $consolidado->select([
                                    'Usuarios.id',
                                    'Usuarios.nombres',
                                    'Usuarios.apellidos',
                                    'Usuarios.email',
                                    'Ventas.id',
                                    'total' => $consolidado->func()->sum('Ventas.monto_total')
                                ])
                       ->innerJoinWith('Ventas')
                       ->where(['Ventas.fecha'=>$fecha])
                       ->group(['Usuarios.id'])
                       ->toArray();
            //prx($consolidado);
            $excel = 1;
            $name = 'Ventas_consolidados_vendedores_'.$fecha;
            $this->set(compact('consolidados','name','excel'));

        }

        

        
        if($this->Auth->user('role') == 'admin'){
            $usuarios = $this->Ventas->Usuarios->find('list', ['limit' => 200]);
        }else{
            $usuarios = $this->Ventas->Usuarios->find('list', ['conditions' => ['Usuarios.id' => $this->Auth->user('id')] ,'limit' => 200]);
        }

        $this->set(compact('usuarios'));
        
        
        
    }

    

    /**
     * View method
     *
     * @param string|null $id Venta id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $venta = $this->Ventas->get($id, [
            'contain' => ['Clientes', 'Usuarios', 'VentaDetalles']
        ]);

        $this->set('venta', $venta);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function detalles()
    {
        extract($this->request->data);
        
        $session = $this->request->session();
        $mensaje = false;
        if($tipo == 1){

            $productosTable = TableRegistry::get('Productos');
            $productos = $productosTable->find('list')->toArray();
            $productosPrecios = $productosTable->ProductosPrecios->find('list',['keyField'=>'id','valueField'=>'precio'])->toArray();
            
            $detallesVentas['producto_id'] = $producto;
            $detallesVentas['producto'] = $productos[$producto];
            $detallesVentas['precio_id'] = $precio;
            $detallesVentas['precio'] = $productosPrecios[$precio];
            $detallesVentas['cantidad'] = $cantidad;
            $detallesVentas['total'] = $cantidad*$detallesVentas['precio'];

            $detalles[] = $detallesVentas;

            if(!$session->read('detalles')){
                $session->write('detalles',$detalles);
            }else{
                $aux = $session->read('detalles');
                
                $flag = false;
                foreach ($aux as $value) {
                    if($value['producto_id'] == $producto){
                        $flag = true;
                        break;
                    }
                }
                if(!$flag){
                    array_push($aux,$detalles[0]);
                    $session->write('detalles',$aux);
                }else{
                    $mensaje = 'El producto ya esta incluido.';
                }
                $detalles = $aux;
            }

        }else if($tipo == 2){

            $detalles = $session->read('detalles');
            unset($detalles[$this->request->data('index')]);
            $session->write('detalles',$detalles);

        }else{

            $aux = $session->read('detalles');
            $detalles = $aux;
            $detalles[$this->request->data('index')]['cantidad'] = $this->request->data('cantidad');
            $detalles[$this->request->data('index')]['total'] = $this->request->data('cantidad') * $detalles[$this->request->data('index')]['precio'];
            $session->write('detalles',$detalles);

        }

        $this->set(compact('detalles','mensaje'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null,$visitaId=null)
    {
        $session = $this->request->session();
        $venta = $this->Ventas->newEntity();
        if ($this->request->is('post')) {
            $this->request->data('usuario_id',$this->Auth->user('id'));
            $this->request->data('cuenta_porcobrar',str_replace('.','',$this->request->data('cuenta_porcobrar')));
            $this->request->data('monto_total',$this->request->data('totales'));
            $this->request->data('pago_cartera',$this->request->data('pagar_cartera'));
            $this->request->data('credito',str_replace('.','',$this->request->data('credito')));
            $this->request->data('monto_efectivo',str_replace('.','',$this->request->data('monto_efectivo')));
            $this->request->data('monto_transferencia',str_replace('.','',$this->request->data('monto_transferencia')));
            $this->request->data('ano',date('Y'));
            $this->request->data('mes',date('m'));
            $this->request->data('dia',date('d'));
            $this->request->data('fecha',date('Y-m-d'));
            $this->request->data('created',date('Y-m-d H:i:s'));

            if($this->request->data('monto_efectivo') == null || $this->request->data('monto_efectivo') == 0){
                $this->request->data('efectivo',false);
                $this->request->data('monto_efectivo',null);
            }else{
                $this->request->data('efectivo',true);
            }


            if($this->request->data('monto_transferencia') == null || $this->request->data('monto_transferencia') == 0){
                $this->request->data('transferencia',false);
                $this->request->data('monto_transferencia',null);
            }else{
                $this->request->data('transferencia',true);
            }



            if(!$this->request->data('pago_cartera')){
                $this->request->data('monto_cartera',null);
                $this->request->data('monto_efectivo_cartera',null);
                $this->request->data('monto_transferencia_cartera',null);
            }else{
                $montoCartera = 0;

                if($this->request->data('monto_efectivo_cartera') == null || $this->request->data('monto_efectivo_cartera') == 0){
                    $this->request->data('monto_efectivo_cartera',null);
                }else{
                    $this->request->data('monto_efectivo_cartera',str_replace('.','',$this->request->data('monto_efectivo_cartera')));
                    $montoCartera+= $this->request->data('monto_efectivo_cartera');
                }


                if($this->request->data('monto_transferencia_cartera') == null || $this->request->data('monto_transferencia_cartera') == 0){
                    $this->request->data('monto_transferencia_cartera',null);
                }else{
                    $this->request->data('monto_transferencia_cartera',str_replace('.','',$this->request->data('monto_transferencia_cartera')));
                    $montoCartera+= $this->request->data('monto_transferencia_cartera');
                }

                $this->request->data('monto_cartera',$montoCartera);

            }

            $this->request->data('monto_efectivo_cartera',str_replace('.','',$this->request->data('monto_efectivo_cartera')));
            $this->request->data('monto_transferencia_cartera',str_replace('.','',$this->request->data('monto_transferencia_cartera')));
            

            $this->request->data('tiene_detalles',true);
            if($session->read('detalles') == null){
                $this->request->data('tiene_detalles',false);
                $this->request->data('monto_total',null);
            }

            $venta = $this->Ventas->patchEntity($venta, $this->request->getData());
            if ($this->Ventas->save($venta)) {

                $controlTable = TableRegistry::get('ControlDeudaPagos');
                $client = [];
                if($session->read('detalles') != null){
                    foreach ($session->read('detalles') as $key => $value) {
                        $value['precio_unitario'] = $value['precio'];
                        $value['venta_id'] = $venta->id;
                        $detalles = $this->Ventas->VentaDetalles->newEntity();
                        $detalles = $this->Ventas->VentaDetalles->patchEntity($detalles, $value);
                        $this->Ventas->VentaDetalles->save($detalles);
                    }
                }
                
                $client['credito_disponible'] = $this->request->data('credito');
                $client['cuenta_porcobrar']= $this->request->data('cuenta_porcobrar_cliente');
                if($this->request->data('cuenta_porcobrar') != 0){
                    $client['credito_disponible']= $this->request->data('credito')-$this->request->data('cuenta_porcobrar');
                    $client['cuenta_porcobrar']= $this->request->data('cuenta_porcobrar_cliente')+$this->request->data('cuenta_porcobrar');

                    $control['tipo'] = 'P';
                    $control['cliente_id'] = $this->request->data('cliente_id');
                    $control['monto'] = $this->request->data('cuenta_porcobrar');
                    $control['venta_id'] = $venta->id;
                    $control['usuario_id'] = $this->Auth->user('id');

                    $detallesControl = $controlTable->newEntity();
                    $detallesControl = $controlTable->patchEntity($detallesControl, $control);
                    $controlTable->save($detallesControl);
                }

                if($this->request->data('pago_cartera')){
                    // $client['credito_disponible']= $this->request->data('credito')+$this->request->data('cuenta_porcobrar');
                    $client['credito_disponible']= $client['credito_disponible']+$this->request->data('monto_cartera');
                    // $client['cuenta_porcobrar']= $this->request->data('cuenta_porcobrar_cliente')-$this->request->data('cuenta_porcobrar');
                    $client['cuenta_porcobrar']= $client['cuenta_porcobrar']-$this->request->data('monto_cartera');
                    $control['tipo'] = 'A';
                    $control['cliente_id'] = $this->request->data('cliente_id');
                    $control['monto'] = $this->request->data('monto_cartera') * -1;
                    $control['venta_id'] = $venta->id;
                    $control['usuario_id'] = $this->Auth->user('id');
                    $detallesControl = $controlTable->newEntity();
                    $detallesControl = $controlTable->patchEntity($detallesControl, $control);
                    $controlTable->save($detallesControl);
                }

                $cliUpd = $this->Ventas->Clientes->get($this->request->data('cliente_id'), [
                    'contain' => []
                ]);
                $clienteUpdate = $this->Ventas->Clientes->patchEntity($cliUpd, $client);
                $this->Ventas->Clientes->save($clienteUpdate);

                $visitalTable = TableRegistry::get('Visitas');
                $visitalTable->updateAll(
                    ['status' => 'R'],
                    ['cliente_id' => $this->request->data('cliente_id'),'status' => 'P']
                );
                $mensaje = $session->read('detalles') != null?'Venta realizada con exito.':'Pago de cartera exitoso.';

                $this->Flash->success(__($mensaje));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La venta no pudo ser procesada, intente nuevamente.'));
        }

        $session->delete('detalles');

        
        $cliente = $this->Ventas->Clientes->find()->where(['id'=>$id])->first();
        $productosTable = TableRegistry::get('Productos');
        $productos = $productosTable->find('list')->toArray();
        $productosPrecios = $productosTable->ProductosPrecios->find('all')->toArray();

        $compruebaVisita = $this->compruebaVisita($visitaId,$productos);
        if($session->read('detalles')){
            $this->set('detalles',$session->read('detalles'));
        }

        

        

        $carteraPendiente = $this->carteraPendiente($id);
        $carteraPendiente = $carteraPendiente['sum'];


        $this->set(compact('venta', 'cliente','productos','productosPrecios','carteraPendiente'));
    }


    private function carteraPendiente($id){

        $control = TableRegistry::get('ControlDeudaPagos')->find();
        $control->select(['id','sum' => $control->func()->sum('monto')])
                ->where(['cliente_id' => $id]);
                //->group(['id']);
        $saldo = $control->first();
               // prx($saldo);
        return $saldo;
    }


    private function compruebaVisita($visitaId = null,$productos=null){
        if($visitaId){
            $visitas = TableRegistry::get('Visitas')->VisitaDetalles->find()->where(['visita_id'=>$visitaId])->toArray();
            if($visitas){
                $session = $this->request->session();
                $productosTable = TableRegistry::get('Productos');
                $productosPrecios = $productosTable->ProductosPrecios->find('list',['keyField'=>'id','valueField'=>'precio'])->toArray();

                foreach ($visitas as $key => $value) {
                    $detallesVentas['producto_id'] = $value->producto_id;
                    $detallesVentas['producto'] = $productos[$value->producto_id];
                    $detallesVentas['precio_id'] = $value->precio_id;
                    $detallesVentas['precio'] = $productosPrecios[$value->precio_id];
                    $detallesVentas['cantidad'] = $value->cantidad;
                    $detallesVentas['total'] = $value->cantidad*$detallesVentas['precio'];

                    $detalles[] = $detallesVentas;
                }

                $session->write('detalles',$detalles);
            }
        }
    }//Fin compruebaVisita

    /**
     * Edit method
     *
     * @param string|null $id Venta id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $venta = $this->Ventas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $venta = $this->Ventas->patchEntity($venta, $this->request->getData());
            if ($this->Ventas->save($venta)) {
                $this->Flash->success(__('The venta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The venta could not be saved. Please, try again.'));
        }
        $clientes = $this->Ventas->Clientes->find('list', ['limit' => 200]);
        $usuarios = $this->Ventas->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('venta', 'clientes', 'usuarios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Venta id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $venta = $this->Ventas->get($id);
        if ($this->Ventas->delete($venta)) {
            $this->Flash->success(__('The venta has been deleted.'));
        } else {
            $this->Flash->error(__('The venta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
