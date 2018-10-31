<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Clasificaciones Controller
 *
 * @property \App\Model\Table\ClasificacionesTable $Clasificaciones
 *
 * @method \App\Model\Entity\Clasificacione[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClasificacionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $clasificaciones = $this->paginate($this->Clasificaciones);

        $this->set(compact('clasificaciones'));
    }

    /**
     * View method
     *
     * @param string|null $id Clasificacione id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clasificacione = $this->Clasificaciones->get($id, [
            'contain' => []
        ]);

        $this->set('clasificacione', $clasificacione);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clasificacione = $this->Clasificaciones->newEntity();
        if ($this->request->is('post')) {
            $clasificacione = $this->Clasificaciones->patchEntity($clasificacione, $this->request->getData());
            if ($this->Clasificaciones->save($clasificacione)) {
                $this->Flash->success(__('The clasificacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clasificacione could not be saved. Please, try again.'));
        }
        $this->set(compact('clasificacione'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clasificacione id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clasificacione = $this->Clasificaciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clasificacione = $this->Clasificaciones->patchEntity($clasificacione, $this->request->getData());
            if ($this->Clasificaciones->save($clasificacione)) {
                $this->Flash->success(__('The clasificacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clasificacione could not be saved. Please, try again.'));
        }
        $this->set(compact('clasificacione'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clasificacione id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clasificacione = $this->Clasificaciones->get($id);
        if ($this->Clasificaciones->delete($clasificacione)) {
            $this->Flash->success(__('The clasificacione has been deleted.'));
        } else {
            $this->Flash->error(__('The clasificacione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
