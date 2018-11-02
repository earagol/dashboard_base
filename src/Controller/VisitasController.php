<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

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
        }else{
            // prx(date('Y-m-d'));
            $this->vencerVisitas();
        }

        $this->paginate = $options;
        $visitas = $this->paginate($this->Visitas);

        $this->set(compact('visitas'));
    }


    private function vencerVisitas(){

        // prx($this->Visitas->find()->where(['fecha_vencimiento <' => date('Y-m-d'),'status'=> 'P'])->toArray());
        
        $this->Visitas->updateAll(['status' => 'V'],['fecha_vencimiento <' => date('Y-m-d'),'status'=> 'P']);

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
        $visita = $this->Visitas->newEntity();
        if ($this->request->is('post')) {
            $validator = new \Cake\Validation\Validator();
            try {

                $this->request->data('status','P');
                // if($this->request->data('fecha_vencimiento') === date('m/d/Y')){
                //     $now = new Time($this->request->data('fecha_vencimiento'));
                //     $this->request->data('fecha_vencimiento',$now->modify('+3 days'));
                //     exit;
                // }
                $now = new Time($this->request->data('fecha_vencimiento'));
                $this->request->data('fecha_vencimiento',$now->modify('+3 days'));
                // prx($this->request->data);
                // $this->request->data('fecha_vencimiento',date('Y-m-d'));
                $this->request->data('user_id',$this->Auth->user('id'));
                $visita = $this->Visitas->patchEntity($visita, $this->request->getData());
                if ($this->Visitas->save($visita)) {
                    $this->Flash->success(__('Registro exitoso.'));

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('El registro no pudo realizarse, por favor intente nuevamente.'));
            } catch (Exception $e) {
                $message = $e->getMessage();
                $this->Flash->error($message);  
            }
        }
        $usuarios = $this->Visitas->Usuarios->find('list', ['limit' => 200]);
        // $usuarios = $this->Visitas->Usuarios->find('list')->combine('id','full_name');

        $clientes = $this->Visitas->Clientes->find('list')->notMatching(
            'Visitas', function ($q) {
                return $q->where(['Visitas.status' => 'P']);
            }
        );


        // $clientes = $this->Visitas->Clientes->find('list', ['Visitas.status NOT IN'=>['P'],'limit' => 200]);
        $this->set(compact('visita', 'usuarios', 'clientes', 'usuarios'));
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
