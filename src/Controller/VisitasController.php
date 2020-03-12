<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Exception;
use Cake\ORM\TableRegistry;
use Cake\Network\Session;

/**
 * Visitas Controller
 *
 * @property \App\Model\Table\VisitasTable $Visitas
 *
 * @method \App\Model\Entity\Visita[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VisitasController extends AppController
{

    public function isAuthorized($user){

        if(isset($user['role']) && $user['role'] === 'usuario'){
            if(in_array($this->request->action, ['index'])){
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
        // $options = [
        //     'select' => [
        //         'Clientes.nombres'
        //     ],
        //     'contain' => ['Usuarios', 'Usuarios'],
        //     'join' => [
        //         'Clientes' => [
        //             'table' => 'Clientes',
        //             'type' => 'INNER',
        //             'conditions' => 'Visitas.cliente_id = Clientes.id'
        //         ]
        //     ],
        //     'order' => ['id' => 'DESC']
        // ];

        $query = $this->Visitas->find()
                               ->select([
                                    'Clientes.nombres',
                                    'Clientes.calle',
                                    'Clientes.numero_calle',
                                    'Clientes.dept_casa_oficina_numero',
                                    'Visitas.fecha_vencimiento',
                                    'Visitas.status',
                                    'Visitas.id',
                                    'Usuarios.nombres',
                                    'Usuarios.apellidos'
                               ])
                               ->innerJoinWith('Clientes')
                               ->innerJoinWith('Usuarios')
                               ->contain([
                                    'Usuarios',
                               ])
                               ->order([
                                    'Visitas.id' => 'DESC'
                               ]);

        if($this->Auth->user('role') === 'usuario'){
            $query->where([
                    'Visitas.usuario_id'=>$this->Auth->user('id')
                ]);
            // $options = array_merge($options,['conditions'=>['Visitas.usuario_id'=>$this->Auth->user('id')]]);
        }

        if(!is_null($this->request->data('buscar'))){
            $formato = function ($pista = null) {
                $array = explode(' ',$pista);
                $pista = '%'.implode('%',$array).'%';
                return $pista;
            };
            $pista = $formato($this->request->data('buscar'));
            $query->where([
                    'Clientes.'.$this->request->data('tipo').' LIKE' => $pista
                ]);
            // $options['conditions'] = array_merge($options['conditions'],['Clientes.'.$this->request->data('tipo').' LIKE' => $pista]);
        }

        $visitas = $this->paginate($query);
        // pr($visitas);
        // exit;

        $this->set(compact('visitas'));
    }


    public function reporteVisitas(){
        $this->viewBuilder()->setLayout('excel');

        $visitasPendientes = $this->Visitas->find()->contain(['Usuarios', 'Clientes', 'Usuarios','VisitaDetalles']) ->where(['Visitas.status'=> 'P'])->toArray();

        $visitas = [];
        $total = 0;
        $name = 'visitas_pendientes_'.date('Y-m-d');

        if($visitasPendientes){
            $productosTable = TableRegistry::get('Productos');
            $productos = $productosTable->find('list')->toArray();
            $productoTotal = [];
            if($productos){
                foreach ($productos as $keypp => $valuepp) {
                    $productoTotal[$keypp] = 0;
                }
            }

            foreach ($visitasPendientes as $key => $value) {
                $visita = [
                    'cliente' => $value->cliente->nombres,
                    'vendedor' => $value->usuario->full_name,
                    'total' => $value->monto_total,
                ];

                $total+=$value->monto_total;
                // $monto = 
                $producto = [];
                foreach ($productos as $keyp => $valuep) {
                   $producto[$keyp] = '';
                   // prx($value);
                   if(isset($value->visita_detalles) && $value->visita_detalles){
                        foreach ($value->visita_detalles as $keyv => $valuev) {
                            if($valuev->producto_id == $keyp){
                                $producto[$keyp] = $valuev->cantidad;
                                $productoTotal[$keyp]+=$valuev->cantidad;
                            }
                        }
                   }
                }

                $visita['productos'] = $producto;
                $visitas[] = $visita;
            }
            
        }

        $this->set(compact('productos','visitas', 'productoTotal','total','name'));
    }//Fin reporteVisitas

    /**
     * View method
     *
     * @param string|null $id Visita id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $visita = $this->Visitas->get($id, [
            'contain' => ['Usuarios', 'Clientes', 'Users']
        ]);

        $this->set('visita', $visita);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->session();
        $visita = $this->Visitas->newEntity();
        if ($this->request->is('post')) {
            $flag = true;
            $validator = new \Cake\Validation\Validator();
            try {
                $now = new Time($this->request->data('fecha_vencimiento'));
                $this->request->data('fecha_vencimiento',$now->format('Y-m-d'));

                if($this->request->data('fecha_vencimiento') < date('Y-m-d')){
                    $this->Flash->alert(__('La fecha de vencimiento no puede ser menor a la fecha de hoy.'));
                }else{

                    $this->request->data('monto_total',$this->request->data('totales'));
                    $this->request->data('monto_efectivo',str_replace('.','',$this->request->data('monto_efectivo')));
                    $this->request->data('monto_transferencia',str_replace('.','',$this->request->data('monto_transferencia')));

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

                    $this->request->data('tiene_detalles',true);
                    if($session->read('detalles') == null){
                        $this->request->data('tiene_detalles',false);
                        $this->request->data('monto_total',null);
                    }

                    $this->request->data('status','P');
                    $this->request->data('user_id',$this->Auth->user('id'));
                    $visita = $this->Visitas->patchEntity($visita, $this->request->getData());
                    if ($this->Visitas->save($visita)) {

                        if($session->read('detalles') != null){
                            foreach ($session->read('detalles') as $key => $value) {
                                $value['precio_unitario'] = $value['precio'];
                                $value['visita_id'] = $visita->id;
                                $detalles = $this->Visitas->VisitaDetalles->newEntity();
                                $detalles = $this->Visitas->VisitaDetalles->patchEntity($detalles, $value);
                                $this->Visitas->VisitaDetalles->save($detalles);
                            }
                        }

                        $this->Flash->success(__('Registro exitoso.'));

                        return $this->redirect(['action' => 'index']);
                    }

                    $this->Flash->error(__('El registro no pudo realizarse, por favor intente nuevamente.'));

                }

                
            } catch (Exception $e) {
                $message = $e->getMessage();
                $this->Flash->error($message);  
            }
        }
        $usuarios = $this->Visitas->Usuarios->find('list', ['limit' => 200]);

        $session->delete('detalles');

        $productosTable = TableRegistry::get('Productos');
        $productos = $productosTable->find('list')->toArray();
        $productosPrecios = $productosTable->ProductosPrecios->find('all')
                                                             ->order([
                                                                'producto_id,precio' => 'ASC'
                                                             ])
                                                             ->toArray();

        $this->set(compact('visita', 'usuarios', 'usuarios','productos','productosPrecios'));
    }


     /**
     * Select method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function select()
    {

        $usuarioId = $this->request->data('usuarioId');
        $usuariosRutas = $this->Visitas->Usuarios->find()->contain(['Rutas'])->where(['Usuarios.id'=>$usuarioId])->first();
        $rutas = [];
        if($usuariosRutas){
            foreach ($usuariosRutas->rutas as $key => $value) {
                $rutas[] = $value->id;
            }
        }

        $clientes = [];

        if($rutas){

            $clientes = $this->Visitas->Clientes->find('list',[
                                                    'keyField' => 'id',
                                                    'valueField' => 'show_select'
                                                ])
                                                ->notMatching(
                                                    'Visitas', function ($q) {
                                                        return $q->where(['Visitas.status' => 'P']);
                                                    }
                                                )
                                                ->where(['ruta_id IN' => $rutas])
                                                ->toArray();

        }
        
        $this->set(compact('clientes'));
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
                    if($value['producto_id'] === $producto){
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

        }else{

            $detalles = $session->read('detalles');
            unset($detalles[$this->request->data('index')]);
            $session->write('detalles',$detalles);

        }
        $this->set(compact('detalles','mensaje'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Visita id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $visita = $this->Visitas->get($id, [
            'contain' => ['Clientes']
        ]);
        // prx($visita);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $now = new Time($this->request->data('fecha_vencimiento'));
            $this->request->data('fecha_vencimiento',$now->format('Y-m-d'));
            $visita = $this->Visitas->patchEntity($visita, $this->request->getData());
            if ($this->Visitas->save($visita)) {
                $this->Flash->success(__('Registro exitoso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El registro no pudo realizarse, por favor intente nuevamente.'));
        }
        $usuarios = $this->Visitas->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('visita', 'usuarios', 'clientes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Visita id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $visita = $this->Visitas->get($id);
        if ($this->Visitas->delete($visita)) {
            $this->Flash->success(__('El registro ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El registro no pudo eliminarse, por favor intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }



    public function reporteVisitasDiferentesAVentas(){

        if($this->request->is('post')){

            $this->viewBuilder()->setLayout('excel');

            if($this->request->data('usuario_id') == null){
                $this->request->data('usuario_id',$this->Auth->user('id'));
            }
            

            if($this->request->data('fecha') == null){
                $this->request->data('fecha',date('Y-m-d'));
            }

            $calculo = $this->calculoReporteDiario($this->request->data('usuario_id'),$this->request->data('fecha'));
            extract($calculo);
            $excel = 1;
            $name = 'Reporte_diario_'.$fecha;
            $this->set(compact('header','diario','excel','name','ventas','gasto','usuario','carteraRecogida','productoTotal'));

        }

        if($this->Auth->user('role') == 'admin'){
            $usuarios = $this->Ventas->Usuarios->find('list', ['limit' => 200]);
        }else{
            $usuarios = $this->Ventas->Usuarios->find('list', ['conditions' => ['Usuarios.id' => $this->Auth->user('id')] ,'limit' => 200]);
        }
        
        $this->set(compact('usuarios'));

    }//Fin reporteVisitasDiferentesAVentas


    public function reporteVisitasVentasDiferentes(){

        if($this->request->is('post')){

            $this->viewBuilder()->setLayout('excel');

            if($this->request->data('desde') == null){
                $this->request->data('desde',date('Y-m-d'));
            }

            if($this->request->data('hasta') == null){
                $this->request->data('hasta',date('Y-m-d'));
            }

            $productosTable = TableRegistry::get('Productos');
            $productos = $productosTable->find('list')->toArray();
            $productoTotal = [];
            if($productos){
                foreach ($productos as $keypp => $valuepp) {
                    $productosAll[$keypp] = 0;
                }
            }
            

            $fechaFormat = new Time($this->request->data('desde'));
            $this->request->data('desde',$fechaFormat->format('Y-m-d'));
            $desde = $this->request->data('desde');

            $fechaFormat = new Time($this->request->data('hasta'));
            $this->request->data('hasta',$fechaFormat->format('Y-m-d'));
            $hasta = $this->request->data('hasta');

            $visitasDiferentes = $this->Visitas->Ventas->find()
                                               ->contain(['VentaDetalles','Usuarios', 'Clientes'=>['Regiones','Comunas'],'Visitas'=>['VisitaDetalles']])
                                               ->innerJoinWith('Visitas')
                                               ->where([
                                                    'Ventas.fecha >='=>$desde,
                                                    'Ventas.fecha <='=>$hasta,
                                                    'Visitas.monto_total !='=> false,
                                                    'Ventas.monto_total !='=> 'Visitas.monto_total',
                                                ])
                                               ->toArray();
            $ventas = [];
            if($visitasDiferentes){

                foreach ($visitasDiferentes as $key => $value) {

                    $valor = [
                                'vendedor' => $value->usuario->full_name,
                                'cliente' => $value->cliente->nombres,
                                'direccion' => $value->cliente->regione->nombre." ".$value->cliente->comuna->nombre." ".$value->cliente->calle." ".$value->cliente->numero_calle." ".$value->cliente->dept_casa_oficina_numero,
                                'productos_visita' => $productosAll,
                                'productos_venta' => $productosAll,
                                'monto_venta' => $value->monto_total,
                                'monto_visita' => $value->visita->monto_total,
                            ];
                    $valor['detalles'] = [];
                    if($value->visita->visita_detalles){
                        foreach ($value->visita->visita_detalles as $keyv => $valuev) {
                            $valor['productos_visita'][$valuev->producto_id] = $valuev->cantidad;
                        }
                    }
                    
                    if($value->venta_detalles){
                        foreach ($value->venta_detalles as $keyvv => $valuevv) {
                            $valor['productos_venta'][$valuevv->producto_id] = $valuevv->cantidad;
                        }
                    }

                    $ventas[] = $valor;
                }

            }
            $excel = 1;
            $name = 'Reporte_diferencias_visitas_ventas_'.date('Y-m-d');
            $this->set(compact('name','excel','ventas','productos'));
        }
        
    }//Fin reporteVisitasVentasDiferentes
}
