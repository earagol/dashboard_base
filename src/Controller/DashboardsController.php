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

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class DashboardsController extends AppController
{

     public function isAuthorized($user){

        if(isset($user['role']) && $user['role'] === 'usuario'){
            if(in_array($this->request->action, ['index'])){
                return true;
            }
        }

        return parent::isAuthorized($user);

    }

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index()
    {
        $clientes = null;
        $fecha = date('Y-m-d');
        $control = TableRegistry::get('Ventas')->find();
        $control->select([
                    'total_ventas' => $control->func()->count('id'),
                    'monto_total' => $control->func()->sum('monto_total'),
                    'monto_efectivo' => $control->func()->sum('monto_efectivo'),
                    'monto_transferencia' => $control->func()->sum('monto_transferencia')
                ])
                ->where(['Ventas.fecha'=>date('Y-m-d')]);

        if($this->Auth->user('role') == 'usuario'){
            $control->where(['usuario_id' => $this->Auth->user('id')]);
        }else{
            $clientes = TableRegistry::get('Clientes')->find();
            $clientes = $clientes->select([
                        'total_clientes' => $clientes->func()->count('id'),
                        'credito_disponible' => $clientes->func()->sum('credito_disponible'),
                        'cuenta_cobrar' => $clientes->func()->sum('cuenta_porcobrar')
                    ])->first();
        }
                
        $dataReal =  $control->first();

        // prx($dataReal);

        $transferidas = TableRegistry::get('Ventas')->find();
        $transferidas = $transferidas->select([
                    'total_transferencia' => $transferidas->func()->count('id'),
                    'monto_transferencia' => $transferidas->func()->sum('monto_transferencia')
                ])
                ->where(['Ventas.confirma_transferencia IS NULL'])->first();

        $this->set(compact('dataReal','clientes','transferidas','fecha'));

        // prx($transferidas);
    }
}
