<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Exception;

/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 *
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuariosController extends AppController
{

    public function isAuthorized($user){

        if(isset($user['role']) && $user['role'] === 'usuario'){
            if(in_array($this->request->action, ['home','logout','index','login'])){
                return true;
            }
        }

        return parent::isAuthorized($user);

    }

    public function login(){
        $this->viewBuilder()->setLayout('login');

        if($this->request->is('post')){
            $user = $this->Auth->identify();
            if($user){

                if(!$user['activo']){
                    $this->Flash->error('Usuario Inactivo', ['key' => 'auth']);
                }else{
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                }
                
            }else{
                $this->Flash->error('Usuario o contraseña inconrrecta', ['key' => 'auth']);
            }

        }
    }

    public function logout()
    {

        $this->redirect($this->Auth->logout());

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $usuarios = $this->paginate($this->Usuarios);

        $this->set(compact('usuarios'));
    }

    /**
     * View method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => []
        ]);

        $this->set('usuario', $usuario);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usuario = $this->Usuarios->newEntity();
        if ($this->request->is('post')) {
            $validator = new \Cake\Validation\Validator();

            try {
                $validator
                    ->add('password2', 'custom', [
                        'rule' => function ($value, $context) {
                            return $value === $context['data']['password'];
                        },
                        'message' => 'Las contraseñas no coinciden.'
                    ]);

                $errors = $validator->errors($this->request->data);

                if ($errors) {
                    foreach ($errors as $key => $values) {
                        foreach ($values as $field => $error) {
                            throw new Exception($error);
                        }
                    }
                }

                $this->request->data('usuario_id',$this->Auth->user('id'));
                $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
                if ($this->Usuarios->save($usuario)) {
                    if($this->request->data('ruta_id')){
                        $usuariosRutasTable = TableRegistry::get('UsuariosRutas');
                        foreach ($this->request->data('ruta_id') as $key => $value) {
                            $usuarioRuta = $usuariosRutasTable->newEntity();
                            $usuarioRuta = $usuariosRutasTable->patchEntity($usuarioRuta, ['usuario_id'=>$usuario->id,'ruta_id'=>$value]);
                            $usuariosRutasTable->save($usuarioRuta);
                        }
                    }
                    $this->Flash->success(__('The usuario has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The usuario could not be saved. Please, try again.'));

            } catch (Exception $e) {
                $message = $e->getMessage();
                if ($alertModal)
                {
                    $this->Flash->error($message);
                }
                else
                {
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }


            
        }

        $rutas = TableRegistry::get('Rutas')->find('list')->toArray();
        $this->set(compact('usuario','rutas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => ['Rutas']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $validator = new \Cake\Validation\Validator();

            try {

                if(!empty($this->request->data['password'])){

                    $validator
                        ->add('password2', 'custom', [
                            'rule' => function ($value, $context) {
                                return $value === $context['data']['password'];
                            },
                            'message' => 'Las contraseñas no coinciden.'
                        ]);

                    $errors = $validator->errors($this->request->data);

                    if ($errors) {
                        foreach ($errors as $key => $values) {
                            foreach ($values as $field => $error) {
                                throw new Exception($error);
                            }
                        }
                    }

                }else{
                    unset($usuario->password);
                }
                

                $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
                if ($this->Usuarios->save($usuario)) {
                    if($this->request->data('ruta_id')){
                        $usuariosRutasTable = TableRegistry::get('UsuariosRutas');
                        $usuariosRutasTable->deleteAll(['usuario_id' => $id]);
                        foreach ($this->request->data('ruta_id') as $key => $value) {
                            $usuarioRuta = $usuariosRutasTable->newEntity();
                            $usuarioRuta = $usuariosRutasTable->patchEntity($usuarioRuta, ['usuario_id'=>$usuario->id,'ruta_id'=>$value]);
                            $usuariosRutasTable->save($usuarioRuta);
                        }
                    }
                    $this->Flash->success(__('The usuario has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The usuario could not be saved. Please, try again.'));

            } catch (Exception $e) {
                $message = $e->getMessage();
                if ($alertModal)
                {
                    $this->Flash->error($message);
                }
                else
                {
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
        }

        $rutasUser = [];
        if($usuario->rutas){
            foreach ($usuario->rutas as $key => $value) {
                $rutasUser[] = $value->id;
            }
            $this->request->data('ruta_id',$rutasUser);
        }
        

        $rutas = TableRegistry::get('Rutas')->find('list')->toArray();
        $this->set(compact('usuario','rutas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuario = $this->Usuarios->get($id);
        if ($this->Usuarios->delete($usuario)) {
            $this->Flash->success(__('The usuario has been deleted.'));
        } else {
            $this->Flash->error(__('The usuario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
