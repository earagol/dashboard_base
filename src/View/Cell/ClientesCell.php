<?php

namespace App\View\Cell;

use Cake\View\Cell;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\Network\Session;

/**
 * Sidebar cell
 */
class ClientesCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function add($where = null)
    {
        $session = $this->request->session();
        $this->set('currentUser',$session->read('Auth.User'));
        $this->set('token',$this->request->getParam('_csrfToken'));
        $clientesTable = tableRegistry::get('Clientes');
        // prx($session->read('Auth.User'));
        $usuarioId = $session->read('Auth.User.id');
        $role = $session->read('Auth.User.role');

        if($role === 'usuario'){
            $usuario = $clientesTable->Usuarios->find('all', ['contain'=>['Rutas'],'conditions' => ['id' => $usuarioId ]])->first();
            if($usuario->rutas){
                $rutas = [];
                foreach ($usuario->rutas as $key => $value) {
                    $rutas[$value->id]=$value->id;
                }
                $rutas = $clientesTable->Rutas->find('list', ['limit' => 200,'conditions' => ['id IN' => array_keys($rutas)]]);
            }
        }else{
            $rutas = $clientesTable->Rutas->find('list', ['limit' => 200]);
        }

        
        $cliente = $clientesTable->newEntity();
        
        $clasificacions = $clientesTable->Clasificaciones->find('list', ['limit' => 200]);
        $regions = $clientesTable->Regiones->find('list', ['limit' => 200]);
        $comunas = $clientesTable->Comunas->find('all', ['select'=>['id','region_id','nombre'],'limit' => 200])->toArray();
        $this->set(compact('cliente', 'rutas', 'clasificacions', 'regions', 'comunas', 'usuarios','where'));
    }
}
