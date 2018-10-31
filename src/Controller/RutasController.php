<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rutas Controller
 *
 * @property \App\Model\Table\RutasTable $Rutas
 *
 * @method \App\Model\Entity\Ruta[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RutasController extends AppController
{
 
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $rutas = $this->paginate($this->Rutas);

        $this->set(compact('rutas'));
    }

    /**
     * View method
     *
     * @param string|null $id Ruta id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ruta = $this->Rutas->get($id, [
            'limit' => 10
        ]);

        $this->set('ruta', $ruta);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ruta = $this->Rutas->newEntity();
        if ($this->request->is('post')) {
            $this->request->data('usuario_id',$this->Auth->user('id'));
            $ruta = $this->Rutas->patchEntity($ruta, $this->request->getData());
            if ($this->Rutas->save($ruta)) {
                $this->Flash->success(__('Registro exitoso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El registro no pudo realizarse, por favor intenta nuevamente.'));
        }
        $this->set(compact('ruta'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ruta id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ruta = $this->Rutas->get($id, [
            'contain' => ['Usuarios']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ruta = $this->Rutas->patchEntity($ruta, $this->request->getData());
            if ($this->Rutas->save($ruta)) {
                $this->Flash->success(__('Registro exitoso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El registro no pudo realizarse, por favor intenta nuevamente.'));
        }
        $this->set(compact('ruta'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ruta id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ruta = $this->Rutas->get($id);
        if ($this->Rutas->delete($ruta)) {
            $this->Flash->success(__('El registro ha sido eliminado'));
        } else {
            $this->Flash->error(__('El registro no pudo eliminarse, por favor intenta nuevamente'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
