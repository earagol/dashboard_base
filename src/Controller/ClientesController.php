<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Exception;


/**
 * Clientes Controller
 *
 * @property \App\Model\Table\ClientesTable $Clientes
 *
 * @method \App\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientesController extends AppController
{

    public function isAuthorized($user){

        if(isset($user['role']) && $user['role'] === 'usuario'){
            if(in_array($this->request->action, ['index','add'])){
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
        $ClientesView = TableRegistry::get('VClientes');
        $options = [
            'contain' => [
                'Rutas', 
                'Clasificaciones', 
                'Regiones', 
                'Comunas', 
                'Usuarios'
            ],
            'conditions' => []
        ];

        if($this->Auth->user('role') === 'usuario'){
            $usuario = $this->Clientes->Usuarios->find('all', ['contain'=>['Rutas'],'conditions' => ['id' => $this->Auth->user('id') ]])->first();
            if($usuario->rutas){
                $rutas = [];
                foreach ($usuario->rutas as $key => $value) {
                    $rutas[$value->id] = $value->id;
                }
                $options['conditions'] = array_merge($options['conditions'],['VClientes.ruta_id IN' => array_keys($rutas)]);
            }
        }

        if(!is_null($this->request->data('buscar'))){
            $formato = function ($pista = null) {
                $array = explode(' ',$pista);
                $pista = '%'.implode('%',$array).'%';
                return $pista;
            };
            $pista = $formato($this->request->data('buscar'));
            $options['conditions'] = array_merge($options['conditions'],['VClientes.'.$this->request->data('tipo').' LIKE' => $pista]);
        }
        $this->paginate = $options;

        // $clientes = $this->paginate($this->Clientes);
        $clientes = $this->paginate($ClientesView);
        // pr($clientes);
        // exit;
        $this->set(compact('clientes'));
    }//Fin index


    public function precios($id = null)
    {   
        if($this->request->is('post')){
           
            if($this->request->data('producto_id') && $this->request->data('precio_id')){
                $validar = $this->Clientes->ClientesPrecios->find()
                                                            ->innerJoinWith('ProductosPrecios')
                                                            ->where([
                                                                'ClientesPrecios.cliente_id' => $this->request->data('cliente_id'),
                                                                'ProductosPrecios.producto_id' => $this->request->data('producto_id')
                                                            ])
                                                            ->first();
                if(!$validar){
                    $value = [
                        'cliente_id' => $this->request->data('cliente_id'),
                        'producto_precio_id'=> $this->request->data('precio_id')
                    ];
                    $precio = $this->Clientes->ClientesPrecios->newEntity();
                    $precio = $this->Clientes->ClientesPrecios->patchEntity($precio, $value);
                    if($this->Clientes->ClientesPrecios->save($precio)){
                        $this->Flash->success(__('Registro exitoso.'));
                    }
                }else{
                    $this->Flash->error(__('El producto ya tiene un precio asociado a este cliente.'));
                }
                
            }
            $this->request->data('producto_id','');
        }

        $productosTable = TableRegistry::get('Productos');
        $cliente = $this->Clientes->find()
                                              ->contain(['ClientesPrecios' => ['ProductosPrecios' => 'Productos']])
                                              ->where([
                                                'id'=>$id
                                              ])
                                              ->first();

        $productos = $productosTable->find('list')->toArray();
        $productosPrecios = $productosTable->ProductosPrecios->find('all')->toArray();
        $this->set(compact('cliente','productos','productosPrecios'));
    }//Fin precios

     public function deleteprecio($id = null, $cliente_id = null)
    {
        $cliente = $this->Clientes->ClientesPrecios->get($id);
        if ($this->Clientes->ClientesPrecios->delete($cliente)) {
            $this->Flash->success(__('El registro ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El registro no pudo eliminarse, por favor intente nuevamente.'));
        }

        return $this->redirect(['action' => 'precios',$cliente_id]);
    }

    /**
     * View method
     *
     * @param string|null $id Cliente id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cliente = $this->Clientes->get($id, [
            'contain' => ['Rutas', 'Clasificaciones', 'Regiones', 'Comunas', 'Usuarios', 'ControlDeudaPagos', 'Ventas', 'Visitas']
        ]);

        $this->set('cliente', $cliente);
    }


    
    public function logCreditos($clienteId = null,$monto = null){
        $value = ['cliente_id' => $clienteId,'monto'=>$monto,'usuario_id'=>$this->Auth->user('id')];
        $credito = $this->Clientes->LogCreditos->newEntity();
        $credito = $this->Clientes->LogCreditos->patchEntity($credito, $value);
        $this->Clientes->LogCreditos->save($credito);

    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($where = null)
    {
        $cliente = $this->Clientes->newEntity();
        if ($this->request->is('post')) {
            if(!$this->Clientes->find()->where(['rut'=>trim($this->request->data('rut'))])->first()){
                $this->request->data('rut',trim($this->request->data('rut')));

                $this->request->data('credito_disponible',str_replace('.','',$this->request->data('credito_disponible')));
                $this->request->data('usuario_id',$this->Auth->user('id'));
                $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());
                if ($a = $this->Clientes->save($cliente)) {
                    if($this->request->data('credito_disponible') != null || $this->request->data('credito_disponible') !=0){
                        $this->logCreditos($cliente->id,$this->request->data('credito_disponible'));
                    }
                    $this->Flash->success(__('Registro exitoso.'));
                    if($this->request->data('where') == 'venta'){
                        return $this->redirect(['controller'=>'ventas','action' => 'add',$cliente->id]);
                    }
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('El registro no pudo realizarse, por favor intente nuevamente.'));

            }else{
                $this->Flash->error(__('El rut ya existe registrado.'));
            }
        }
        $rutas = $this->Clientes->Rutas->find('list', ['limit' => 200]);
        $clasificacions = $this->Clientes->Clasificaciones->find('list', ['limit' => 200]);
        $regions = $this->Clientes->Regiones->find('list', ['limit' => 200]);
        $comunas = $this->Clientes->Comunas->find('all', ['select'=>['id','region_id','nombre'],'limit' => 200])->toArray();
        $comunasList = [];
        if($this->request->data('region_id')){
            $comunasList = $this->Clientes->Comunas->find('list')->where(['region_id'=>$this->request->data('region_id')])->toArray();
        }
        $this->set(compact('cliente', 'rutas', 'clasificacions', 'regions', 'comunas', 'usuarios','where','comunasList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cliente id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cliente = $this->Clientes->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $auxCreditoDisponible = $cliente->credito_disponible;
            try {
                $this->request->data('credito_disponible',str_replace('.','',$this->request->data('credito_disponible')));
                $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());
                if ($this->Clientes->save($cliente)) {
                    if(($this->request->data('credito_disponible') != null || $this->request->data('credito_disponible') !=0) && ($this->request->data('credito_disponible') != $auxCreditoDisponible)){
                        $this->logCreditos($cliente->id,$this->request->data('credito_disponible'));
                    }
                    $this->Flash->success(__('Registro exitoso.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('El registro no pudo realizarse, por favor intente nuevamente.'));
            } catch (Exception $e) {
                $message = $e->getMessage();
                $this->Flash->error($message);
            }
        }

        $rutas = $this->Clientes->Rutas->find('list', ['limit' => 200]);
        $clasificacions = $this->Clientes->Clasificaciones->find('list', ['limit' => 200]);
        $regions = $this->Clientes->Regiones->find('list', ['limit' => 200]);
        $comunas = $this->Clientes->Comunas->find('list', ['limit' => 200]);
        $comunasAll = $this->Clientes->Comunas->find('all', ['select'=>['id','region_id','nombre'],'limit' => 200])->toArray();
        $this->set(compact('cliente', 'rutas', 'clasificacions', 'regions', 'comunas', 'comunasAll'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cliente id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cliente = $this->Clientes->get($id);
        if ($this->Clientes->delete($cliente)) {
            $this->Flash->success(__('El registro ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El registro no pudo eliminarse, por favor intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function exportarMorosos()
    {
        $this->viewBuilder()->setLayout('excel');
        $clienteMorosos = $this->Clientes->clientesMorosos($this->Auth->user('id'));
        $name = 'Reporte_morosos';
        $this->set(compact('clienteMorosos','name'));
    }


    
}
