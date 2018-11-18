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
        $options = [
            'contain' => ['Usuarios', 'Clientes', 'Usuarios'],
            'order' => ['id' => 'DESC']
        ];

        if($this->Auth->user('role') === 'usuario'){
            $options = array_merge($options,['conditions'=>['Visitas.usuario_id'=>$this->Auth->user('id')]]);
        }

        $this->paginate = $options;
        $visitas = $this->paginate($this->Visitas);

        $this->set(compact('visitas'));
    }


    


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
            //prx($this->request->data);
            $flag = true;
            $validator = new \Cake\Validation\Validator();
            try {
                // throw new Exception($error);
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

        $clientes = $this->Visitas->Clientes->find('list')->notMatching(
            'Visitas', function ($q) {
                return $q->where(['Visitas.status' => 'P']);
            }
        );

        $session->delete('detalles');

        $productosTable = TableRegistry::get('Productos');
        $productos = $productosTable->find('list')->toArray();
        $productosPrecios = $productosTable->ProductosPrecios->find('all')->toArray();

        $this->set(compact('visita', 'usuarios', 'clientes', 'usuarios','productos','productosPrecios'));
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
}
