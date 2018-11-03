<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Session;
use Cake\Event\Event;

/**
 * Ventas Controller
 *
 * @property \App\Model\Table\VentasTable $Ventas
 *
 * @method \App\Model\Entity\Venta[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VentasController extends AppController
{

    // public function beforeFilter(Event $event)
    // {
    //     $this->getEventManager()->off($this->Csrf);
    // }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        if($this->Auth->user('role') === 'usuario'){
            $rutas = $this->Ventas->Usuarios->Rutas->find('list', ['conditions' => ['usuario_id' => $this->Auth->user('role') ]])->toArray();
        }else{
            $rutas = $this->Ventas->Clientes->Rutas->find('list')->toArray();
        }
        // prx($rutas->toArray());

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
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $venta = $this->Ventas->newEntity();
        if ($this->request->is('post')) {
            $venta = $this->Ventas->patchEntity($venta, $this->request->getData());
            if ($this->Ventas->save($venta)) {
                $this->Flash->success(__('The venta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The venta could not be saved. Please, try again.'));
        }
        $cliente = $this->Ventas->Clientes->find()->where(['id'=>$id])->first();
        $productosTable = TableRegistry::get('Productos');
        $productos = $productosTable->find('list')->toArray();
        $productosPrecios = $productosTable->ProductosPrecios->find('all')->toArray();

        $session = $this->request->session();
        $session->delete('detalles');

        $carteraPendiente = $this->carteraPendiente($id);

        $this->set(compact('venta', 'cliente','productos','productosPrecios','carteraPendiente'));
    }


    private function carteraPendiente($id){

        $control = TableRegistry::get('ControlDeudaPagos')->find();
        $saldo = $control->select(['id','sum' => $control->func()->sum('monto')])
                ->where(['cliente_id' => $id])
                ->first();
        return $saldo->sum;
    }

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
