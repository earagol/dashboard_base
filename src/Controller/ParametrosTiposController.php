<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ParametrosTipos Controller
 *
 * @property \App\Model\Table\ParametrosTiposTable $ParametrosTipos
 *
 * @method \App\Model\Entity\ParametrosTipo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ParametrosTiposController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Usuarios']
        ];
        $parametrosTipos = $this->paginate($this->ParametrosTipos);

        $this->set(compact('parametrosTipos'));
    }

    /**
     * View method
     *
     * @param string|null $id Parametros Tipo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parametrosTipo = $this->ParametrosTipos->get($id, [
            'contain' => ['Usuarios']
        ]);

        $this->set('parametrosTipo', $parametrosTipo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $parametrosTipo = $this->ParametrosTipos->newEntity();
        if ($this->request->is('post')) {
            $this->request->data('usuario_id',$this->Auth->user('id'));
            $parametrosTipo = $this->ParametrosTipos->patchEntity($parametrosTipo, $this->request->getData());
            if ($this->ParametrosTipos->save($parametrosTipo)) {
                $this->Flash->success(__('Registro exitoso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El registro no pudo realizarse, por favor intenta nuevamente.'));
        }
        $usuarios = $this->ParametrosTipos->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('parametrosTipo', 'usuarios'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Parametros Tipo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $parametrosTipo = $this->ParametrosTipos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parametrosTipo = $this->ParametrosTipos->patchEntity($parametrosTipo, $this->request->getData());
            if ($this->ParametrosTipos->save($parametrosTipo)) {
                $this->Flash->success(__('Registro exitoso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El registro no pudo realizarse, por favor intenta nuevamente.'));
        }
        $usuarios = $this->ParametrosTipos->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('parametrosTipo', 'usuarios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Parametros Tipo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parametrosTipo = $this->ParametrosTipos->get($id);
        if ($this->ParametrosTipos->delete($parametrosTipo)) {
            $this->Flash->success(__('El registro ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El registro no pudo eliminarse, por favor intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
