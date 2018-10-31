<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Regiones Controller
 *
 * @property \App\Model\Table\RegionesTable $Regiones
 *
 * @method \App\Model\Entity\Regione[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $regiones = $this->paginate($this->Regiones);

        $this->set(compact('regiones'));
    }

    /**
     * View method
     *
     * @param string|null $id Regione id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $regione = $this->Regiones->get($id, [
            'contain' => []
        ]);

        $this->set('regione', $regione);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $regione = $this->Regiones->newEntity();
        if ($this->request->is('post')) {
            $regione = $this->Regiones->patchEntity($regione, $this->request->getData());
            if ($this->Regiones->save($regione)) {
                $this->Flash->success(__('The regione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The regione could not be saved. Please, try again.'));
        }
        $this->set(compact('regione'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Regione id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $regione = $this->Regiones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $regione = $this->Regiones->patchEntity($regione, $this->request->getData());
            if ($this->Regiones->save($regione)) {
                $this->Flash->success(__('The regione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The regione could not be saved. Please, try again.'));
        }
        $this->set(compact('regione'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Regione id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $regione = $this->Regiones->get($id);
        if ($this->Regiones->delete($regione)) {
            $this->Flash->success(__('The regione has been deleted.'));
        } else {
            $this->Flash->error(__('The regione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
