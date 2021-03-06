<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Exception;
use Cake\I18n\Time;

use App\Controller\VentasController;


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
            if(in_array($this->request->action, ['home','logout','login','cambioClave','perfil','edit'])){
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


    public function cierreOperacionesDiario(){

        $cierreTable = TableRegistry::get('CierreOperaciones');
        $cierres = $cierreTable->find()->contain(['Vendedor','Admin'])->where(['fecha_cierre' => date('Y-m-d')])->toArray();

        $this->paginate = [
            'contain' => ['Vendedor','Admin'],
            'conditions' => ['fecha_cierre' => date('Y-m-d')]
        ];

        $cierres = $this->paginate($cierreTable);
        $this->set(compact('cierres'));
    }


    public function addCierre(){

        $cierreTable = TableRegistry::get('CierreOperaciones');
        if($this->request->is('post')){

            if($this->request->data('usuario_id') != null){

                if(!$cierreTable->find()->where(['vendedor_id'=>$this->request->data('usuario_id'),'fecha_cierre' => date('Y-m-d')])->first()){
                    $userId = $this->request->data('usuario_id');
                    $cierreFecha = date('Y-m-d');

                    $fechaFormat = new Time($cierreFecha);
                    $fechaManana = $fechaFormat->modify('+1 days');

                    if(date('w', strtotime($fechaManana)) == 0){
                        $fechaManana = $fechaFormat->modify('+1 days');
                    }


                    $cierre = $cierreTable->newEntity();
                    $cierre = $cierreTable->patchEntity($cierre, [
                                    'vendedor_id'=> $userId,
                                    'admin_id'=>$this->Auth->user('id'),
                                    'fecha_cierre'=>$cierreFecha
                                ]);
                    if($cierreTable->save($cierre)){
                        $controller = new VentasController();
                        $calculo = $controller->calculoReporteDiario($userId, $cierreFecha);
                        if($calculo['productoTotal']){
                            $padre['parametros_tipo_id'] = 1;
                            $padre['usuario_id'] = $userId;
                            $padre['fecha'] = $fechaManana;
                            $padre['observacion'] = 'automatico';
                            $padre['cierre_id'] = $cierre->id;

                            $padreTable = TableRegistry::get('ParametrosValoresPadre');
                            $padreValore = $padreTable->newEntity();
                            $padreValore = $padreTable->patchEntity($padreValore, $padre);
                            if($padreTable->save($padreValore)){

                                
                                $parametrosValoresTable = TableRegistry::get('ParametrosValores');
                                foreach ($calculo['productoTotal'] as $key => $value) {
                                    $parametrosValore = $parametrosValoresTable->newEntity();
                                    $valor['parametros_tipo_id'] = 1;
                                    $valor['padre_id'] = $padreValore->id;
                                    $valor['producto_id'] = $key;
                                    $valor['monto_o_cantidad'] = $value;
                                    $valor['usuario_id'] = $userId;
                                    $valor['fecha'] = $fechaManana;
                                    $valor['tipo'] = 'Diario';
                                    $parametrosValore = $parametrosValoresTable->patchEntity($parametrosValore, $valor);
                                    if($parametrosValoresTable->save($parametrosValore)){
                                        $flag = true;
                                    }
                                }
                            }
                        }

                        // $controller->admin_cron_cierre(true);

                        $this->Flash->success(__('Cierre de operaciones exitoso.'));
                        return $this->redirect(['action' => 'cierreOperacionesDiario']);
                    }

                }else{
                    $this->Flash->error('Ya se realizo el cierre para este vendedor.');
                }

               
            }else{
                $this->Flash->error('Seleccione al vendedor.');
            }
        }

        $usuarios = $this->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('usuarios'));
    }



    public function deleteCierre($id = null)
    {
        // prx('kljkjhkjhkjh');
        $cierreTable = TableRegistry::get('CierreOperaciones');
        $this->request->allowMethod(['post', 'delete']);
        $cierre = $cierreTable->get($id);
        if ($cierreTable->delete($cierre)) {
            $padreTable = TableRegistry::get('ParametrosValoresPadre');

            $padre = $padreTable->find()->where(['cierre_id' => $id])->first();
            $padreTable->deleteAll(['cierre_id' => $id]);

            $parametrosValoresTable = TableRegistry::get('ParametrosValores');
            $parametrosValoresTable->deleteAll(['padre_id' => $padre->id]);
            $this->Flash->success(__('El registro ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El registro no pudo eliminarse, por favor intente nuevamente.'));
        }

        return $this->redirect(['action' => 'cierreOperacionesDiario']);
    }



    public function cambioClave()
    {
        $usuario = $this->Usuarios->get($this->Auth->user('id'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $validator = new \Cake\Validation\Validator();

            try {

                $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
                if ($this->Usuarios->save($usuario)) {
                    $this->Flash->success(__('Registro exitoso.'));

                    return $this->redirect('/');
                }

                $this->Flash->error(__('El registro no pudo realizarse, por favor intente nuevamente.'));

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

        $this->set(compact('usuario'));
    }//Fin cambioClave


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Rutas']
        ];
        $usuarios = $this->paginate($this->Usuarios);
        //prx($usuarios);

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


                $this->request->data('created',date('Y-m-d H:i:s'));
                $this->request->data('usuario_id',$this->Auth->user('id'));
                //prx($this->request->getData());
                $usuario = $this->Usuarios->patchEntity($usuario, $this->request->data);
                if ($this->Usuarios->save($usuario)) {
                    if($this->request->data('ruta_id')){
                        $usuariosRutasTable = TableRegistry::get('UsuariosRutas');
                        foreach ($this->request->data('ruta_id') as $key => $value) {
                            $usuarioRuta = $usuariosRutasTable->newEntity();
                            $usuarioRuta = $usuariosRutasTable->patchEntity($usuarioRuta, ['usuario_id'=>$usuario->id,'ruta_id'=>$value,'user_id'=>$this->Auth->user('id')]);
                            $usuariosRutasTable->save($usuarioRuta);
                        }
                    }
                    $this->Flash->success(__('Registro exitoso.'));
                    return $this->redirect(['action' => 'index']);
                }
               //prx($this->request->data);
                $this->Flash->error(__('El registro no pudo realizarse, por favor intente nuevamente.'));

            } catch (Exception $e) {
                $message = $e->getMessage();
                $this->Flash->error($message);  
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
        if($this->Auth->user('role') === 'usuario' && $this->Auth->user('id') != $id){
            $this->Flash->error(__('Acción invalida.'));
            return $this->redirect(['action' => 'perfil',$this->Auth->user('id')]);
        }

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
                    unset($this->request->data['password']);
                }
                

                $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
                if ($this->Usuarios->save($usuario)) {
                    if($this->request->data('ruta_id')){
                        $usuariosRutasTable = TableRegistry::get('UsuariosRutas');
                        $usuariosRutasTable->deleteAll(['usuario_id' => $id]);
                        foreach ($this->request->data('ruta_id') as $key => $value) {
                            $usuarioRuta = $usuariosRutasTable->newEntity();
                            $usuarioRuta = $usuariosRutasTable->patchEntity($usuarioRuta, ['usuario_id'=>$usuario->id,'ruta_id'=>$value,'user_id'=>$this->Auth->user('id')]);
                            $usuariosRutasTable->save($usuarioRuta);
                        }
                    }

                    $this->Flash->success(__('Registro exitoso.'));

                    if(isset($this->request->data['redirect'])){
                        return $this->redirect(['action' => 'perfil',$id]);
                    }

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('El registro no pudo realizarse, por favor intente nuevamente.'));

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

    public function perfil($id = null)
    {
        if($this->Auth->user('role') === 'usuario' && $this->Auth->user('id') != $id){
            $this->Flash->error(__('Acción invalida. No tienes privilegios para editar otros perfiles.'));
            return $this->redirect(['action' => 'perfil',$this->Auth->user('id')]);
        }

        $usuario = $this->Usuarios->get($id, [
            'contain' => ['Rutas']
        ]);

        $this->set(compact('usuario'));

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
            $this->Flash->success(__('El registro ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El registro no pudo eliminarse, por favor intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
