<?php
namespace App\Controller;

use App\Controller\AppController;
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
        $this->paginate = [
            'contain' => ['Rutas', 'Clasificaciones', 'Regiones', 'Comunas', 'Usuarios']
        ];
        $clientes = $this->paginate($this->Clientes);

        $this->set(compact('clientes'));
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


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cliente = $this->Clientes->newEntity();
        if ($this->request->is('post')) {
            $validator = new \Cake\Validation\Validator();
            try {
                // pr($this->request->data);

                // $errors = $validator->errors($this->request->data);

                // if ($errors) {
                //     foreach ($errors as $key => $values) {
                //         foreach ($values as $field => $error) {
                //             throw new Exception($error);
                //         }
                //     }
                // }

                $this->request->data('usuario_id',$this->Auth->user('id'));
                $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());
                if ($this->Clientes->save($cliente)) {
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
        $comunas = $this->Clientes->Comunas->find('all', ['select'=>['id','region_id','nombre'],'limit' => 200])->toArray();
        $this->set(compact('cliente', 'rutas', 'clasificacions', 'regions', 'comunas', 'usuarios'));
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
            try {

                $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());
                if ($this->Clientes->save($cliente)) {
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
}
