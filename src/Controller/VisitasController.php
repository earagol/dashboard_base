<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Visitas Controller
 *
 * @property \App\Model\Table\VisitasTable $Visitas
 *
 * @method \App\Model\Entity\Visita[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VisitasController extends AppController
{

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
            $options = array_merge($options,['conditions'=>['usuario_id'=>$this->Auth->user('role')]]);
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
        $visita = $this->Visitas->newEntity();
        if ($this->request->is('post')) {
            $validator = new \Cake\Validation\Validator();
            try {

                $this->request->data('status','P');
                $this->request->data('fecha_vencimiento','2018-10-30');
                $this->request->data('user_id',$this->Auth->user('id'));
                $visita = $this->Visitas->patchEntity($visita, $this->request->getData());
                if ($this->Visitas->save($visita)) {
                    $this->Flash->success(__('The visita has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('The visita could not be saved. Please, try again.'));
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
            $visita = $this->Visitas->patchEntity($visita, $this->request->getData());
            if ($this->Visitas->save($visita)) {
                $this->Flash->success(__('The visita has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visita could not be saved. Please, try again.'));
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
            $this->Flash->success(__('The visita has been deleted.'));
        } else {
            $this->Flash->error(__('The visita could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
