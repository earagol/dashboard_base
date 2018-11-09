<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ParametrosValores Controller
 *
 * @property \App\Model\Table\ParametrosValoresTable $ParametrosValore
 *
 * @method \App\Model\Entity\ParametrosValores[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ParametrosValoresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $fecha = date('Y-m-d');

        $this->paginate = [
            'contain' => ['ParametrosValores','ParametrosTipos'],
            'conditions' => ['ParametrosValoresPadre.fecha' => $fecha]
        ];

        $parametrosValores = $this->paginate(TableRegistry::get('ParametrosValoresPadre'));
        $this->set(compact('parametrosValores','fecha'));
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
        $parametrosValores = $this->ParametrosValores->find('all')
                                                    ->contain(['Productos','ParametrosTipos'])
                                                    ->where(['ParametrosValores.padre_id' => $id])
                                                    ->toArray();
        // prx($parametrosValores);
        $this->set('parametrosValores', $parametrosValores);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $parametrosValore = $this->ParametrosValores->newEntity();
        if ($this->request->is('post')) {
            $productosTable = TableRegistry::get('Productos');
            $padreTable = TableRegistry::get('ParametrosValoresPadre');
            $productos = $productosTable->find('list', ['limit' => 200]);
            $this->request->data('usuario_id',$this->Auth->user('id'));
            $this->request->data('fecha',date('Y-m-d'));
            // prx($this->request->data);
            $padreValore = $padreTable->newEntity();
            $padreValore = $padreTable->patchEntity($padreValore, $this->request->getData());
            if($padreTable->save($padreValore)){

                if($this->request->data('tipo') == 'Diario'){
                    $valor = [];
                    $flag = false;
                    foreach ($productos as $key => $value) {
                        $parametrosValore = $this->ParametrosValores->newEntity();
                        $valor['parametros_tipo_id'] = $this->request->data('parametros_tipo_id');
                        $valor['padre_id'] = $padreValore->id;
                        $valor['producto_id'] = $key;
                        $valor['monto_o_cantidad'] = $this->request->data('producto_id_'.$key);
                        $valor['usuario_id'] = $this->request->data('usuario_id');
                        $valor['fecha'] = $this->request->data('fecha');
                        $parametrosValore = $this->ParametrosValores->patchEntity($parametrosValore, $valor);
                        if($this->ParametrosValores->save($parametrosValore)){
                            $flag = true;
                        }
                    }
                    if ($flag) {
                        $this->Flash->success(__('Registro exitoso.'));
                        return $this->redirect(['action' => 'index']);
                    }
                }else{
                    $this->request->data('padre_id',$padreValore->id);
                    $parametrosValore = $this->ParametrosValores->newEntity();
                    $parametrosValore = $this->ParametrosValores->patchEntity($parametrosValore, $this->request->getData());
                    if ($this->ParametrosValores->save($parametrosValore)) {
                        $this->Flash->success(__('Registro exitoso.'));

                        return $this->redirect(['action' => 'index']);
                    }
                }
                // prx($this->request->data);
                $this->Flash->error(__('El registro no pudo realizarse, por favor intenta nuevamente.'));
            }
            // prx($this->request->data);
            $this->Flash->error(__('El registro no pudo realizarse, por favor intenta nuevamente.'));
        }

        $parametrosTiposTable = TableRegistry::get('ParametrosTipos');
        $parametrosTipos = $parametrosTiposTable->find('list', ['limit' => 200]);

        $this->set(compact('parametrosValore', 'usuarios','parametrosTipos'));
    }

    public function datos(){
        $parametrosTiposTable = TableRegistry::get('ParametrosTipos');
        $parametrosTipos = $parametrosTiposTable->find('all')->where(['id'=>$this->request->data('tipo_parametro')])->first();
        $tipo = $parametrosTipos->tipo;
        $productos = [];
        if($parametrosTipos->tipo == 'Diario'){
            $productosTable = TableRegistry::get('Productos');
            $productos = $productosTable->find('list', ['limit' => 200]);
        }

        $this->set(compact('tipo','productos'));
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
        $parametrosValore = $this->ParametrosValores->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parametrosValore = $this->ParametrosValores->patchEntity($parametrosValore, $this->request->getData());
            if ($this->ParametrosValores->save($parametrosValore)) {
                $this->Flash->success(__('Registro exitoso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El registro no pudo realizarse, por favor intenta nuevamente.'));
        }
        $usuarios = $this->ParametrosValores->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('parametrosValore', 'usuarios'));
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
        $parametrosValore = TableRegistry::get('ParametrosValoresPadre')->get($id);
        if (TableRegistry::get('ParametrosValoresPadre')->delete($parametrosValore)) {
            $this->Flash->success(__('El registro ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El registro no pudo eliminarse, por favor intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
