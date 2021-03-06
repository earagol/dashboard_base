<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    // public function initialize()
    // {
    //     parent::initialize();

    //     $this->loadComponent('RequestHandler', [
    //         'enableBeforeRedirect' => false,
    //     ]);
    //     $this->loadComponent('Flash');

        
    //      * Enable the following component for recommended CakePHP security settings.
    //      * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         
    //     //$this->loadComponent('Security');
    // }

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'finder' => 'auth',
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ],
                    'userModel' => 'Usuarios'
                ]
            ],
            'loginAction' => [
                'controller' => 'Usuarios',
                'action' => 'login'
            ],
            'authError' => false,
            'loginRedirect' => [
                'controller' => 'Dashboards',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Usuarios',
                'action' => 'login'
            ],
            // 'unauthorizedRedirect' => $this->referer()

        ]);


        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    public function beforeFilter(Event $event)
    {
        // $this->response->header('Access-Control-Allow-Origin');
        // $this->response->header('Access-Control-Allow-Methods');

        $this->set('currentUser',$this->Auth->User());
        $this->set('token',$this->request->getParam('_csrfToken'));
    }



    public function isAuthorized($user){

        if(isset($user['role']) && $user['role'] === 'admin'){
                return true;
        }
        $this->Flash->error(__('No esta autorizado para realizar esta acción.'));
        return false;
    }

    public function beforeRender(Event $event)
    {
        // Note: These defaults are just to get started quickly with development
        // and should not be used in production. You should instead set "_serialize"
        // in each action as required.
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }


        if(!$this->request->is('ajax') && $this->request->params['action'] != 'login' && $this->viewBuilder()->layout() != 'excel'){
           $this->viewBuilder()->layout('tema2'); 
        }

        // pj(Configure::read('relative'));
        // exit;
        $this->set('url',Configure::read('relative'));

        //prx($this->request->getParam('controller'));_
    }
}
