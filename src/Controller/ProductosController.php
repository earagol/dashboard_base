<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Productos Controller
 *
 * @property \App\Model\Table\ProductosTable $Productos
 *
 * @method \App\Model\Entity\Producto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categorias', 'Usuarios']
        ];
        $productos = $this->paginate($this->Productos);
        $this->set(compact('productos'));
    }

    /**
     * View method
     *
     * @param string|null $id Producto id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $producto = $this->Productos->get($id, [
            'contain' => ['Categorias', 'Usuarios', 'ParametrosValores', 'ProductosPrecios', 'VentaDetalles']
        ]);

        $this->set('producto', $producto);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $producto = $this->Productos->newEntity();
        if ($this->request->is('post')) {
            $this->request->data('usuario_id',$this->Auth->user('id'));
            $producto = $this->Productos->patchEntity($producto, $this->request->getData());
            if ($this->Productos->save($producto)) {
                if(!empty($this->request->data['arreglo'])){
                    $this->request->data('arreglo',explode(',',$this->request->data['arreglo']));
                    // $usuariosRutasTable = TableRegistry::get('UsuariosRutas');
                    // prx($this->request->data);
                    foreach ($this->request->data('arreglo') as $key => $value) {
                        $precio = $this->Productos->ProductosPrecios->newEntity();
                        $precio = $this->Productos->ProductosPrecios->patchEntity($precio, ['usuario_id'=>$this->Auth->user('id'),'producto_id'=>$producto->id,'precio'=>str_replace('.','',$value)]);
                        $this->Productos->ProductosPrecios->save($precio);
                    }
                }
                $this->Flash->success(__('Registro exitoso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El registro no pudo realizarse, por favor intente nuevamente.'));
        }
        $categorias = $this->Productos->Categorias->find('list', ['limit' => 200]);
        $usuarios = $this->Productos->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('producto', 'categorias', 'usuarios'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Producto id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $producto = $this->Productos->get($id, [
            'contain' => ['ProductosPrecios']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $producto = $this->Productos->patchEntity($producto, $this->request->getData());
            if ($this->Productos->save($producto)) {
                if(!empty($this->request->data['precio'])){
                    $precio = $this->Productos->ProductosPrecios->newEntity();
                    $precio = $this->Productos->ProductosPrecios->patchEntity($precio, ['usuario_id'=>$this->Auth->user('id'),'producto_id'=>$id,'precio'=>str_replace('.','',$this->request->data['precio'])]);
                    $this->Productos->ProductosPrecios->save($precio);
                    $producto = $this->Productos->get($id, [
                        'contain' => ['ProductosPrecios']
                    ]);
                }
                $this->Flash->success(__('Registro exitoso.'));

                return !isset($this->request->data['plus'])?$this->redirect(['action' => 'index']):$this->redirect(['action' => 'edit',$id]);
            }
            $this->Flash->error(__('El registro no pudo realizarse, por favor intente nuevamente.'));
        }
        $categorias = $this->Productos->Categorias->find('list', ['limit' => 200]);

        // prx($producto);
        $this->set(compact('producto', 'categorias', 'usuarios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Producto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $producto = $this->Productos->get($id);
        if ($this->Productos->delete($producto)) {
            $this->Flash->success(__('El registro ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El registro no pudo eliminarse, por favor intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function deletePrecio($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $precio = $this->Productos->ProductosPrecios->get($id);
        if ($this->Productos->ProductosPrecios->delete($precio)) {
            $this->Flash->success(__('El precio ha sido eliminado.'));
        } else {
             $this->Flash->error(__('El registro no pudo eliminarse, por favor intente nuevamente.'));
        }

        return $this->redirect(['action' => 'edit',$precio->producto_id]);
    }
}
