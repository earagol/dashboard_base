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

    private function vencerVisitas(){
        $visitasTable = tableRegistry::get('Visitas');
        $query = $visitasTable->find()->contain('VisitaDetalles')->where(['fecha_vencimiento <' => date('Y-m-d'),'status'=> 'P']);
        if($query){

            foreach ($query as $key => $value) {
                $value = $value->toArray();
                unset($value['created'],$value['modified']);
                $value['fecha_vencimiento'] = date('Y-m-d');
                // prx($value);
                $visita = $visitasTable->newEntity();
                $visita = $visitasTable->patchEntity($visita, $value);
                $visitasTable->save($visita);
                if($value['visita_detalles']){
                    foreach ($value['visita_detalles'] as $keyV => $valueV) {
                        unset($valueV['created'],$valueV['modified']);
                        $valueV['visita_id'] = $visita->id;
                        $detalles = $visitasTable->VisitaDetalles->newEntity();
                        $detalles = $visitasTable->VisitaDetalles->patchEntity($detalles, $valueV);
                        $visitasTable->VisitaDetalles->save($detalles);
                    }
                }
            }

            $visitasTable->updateAll(['status' => 'V'],['fecha_vencimiento <' => date('Y-m-d'),'status'=> 'P']);

        }

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
    public function index($flag = false)
    {
        if(!$flag && $this->Auth->user('role') === 'usuario'){
            return $this->redirect(['controller'=>'ventas','action' => 'add']);
        }
        
        $clientes = null;
        $fecha = date('Y-m-d');
        $control = TableRegistry::get('Ventas')->find();
        $control->select([
                    'total_ventas' => $control->func()->count('id'),
                    'monto_total' => $control->func()->sum('monto_total'),
                    'monto_efectivo' => $control->func()->sum('monto_efectivo'),
                    'monto_transferencia' => $control->func()->sum('monto_transferencia')
                ])
                ->where(['Ventas.fecha'=>date('Y-m-d'),'Ventas.monto_total IS NOT NULL']);

        

        if($this->Auth->user('role') == 'usuario'){
            $visitasPendientes = TableRegistry::get('Visitas')->find()->contain(['Usuarios', 'Clientes', 'Usuarios'])->where(['Visitas.status'=> 'P','Visitas.usuario_id'=>$this->Auth->user('id')])->toArray();
            $control->where(['usuario_id' => $this->Auth->user('id')]);
        }else{
            $this->vencerVisitas();
            $visitasPendientes = TableRegistry::get('Visitas')->find()->contain(['Usuarios', 'Clientes', 'Usuarios']) ->where(['Visitas.status'=> 'P'])->toArray();

            $clientes = TableRegistry::get('Clientes')->find();
            $clientes = $clientes->select([
                        'total_clientes' => $clientes->func()->count('id'),
                        'credito_disponible' => $clientes->func()->sum('credito_disponible'),
                        'cuenta_cobrar' => $clientes->func()->sum('cuenta_porcobrar')
                    ])->first();


            $clienteTransPen = TableRegistry::get('Clientes')->find();
            $clienteTransPen = $clienteTransPen->select([
                                    'Clientes.id',
                                    'Clientes.nombres',
                                    'Clientes.rut',
                                    'Clientes.email',
                                    'Clientes.telefono1',
                                    'Clientes.telefono2',
                                    'Ventas.id',
                                    'Ventas.monto_total',
                                    'Ventas.monto_transferencia',
                                    'Ventas.monto_transferencia_cartera',
                                    'Ventas.fecha',
                                    // 'total' => $clienteTransPen->func()->count('Ventas.id')
                                ])
                       ->innerJoinWith('Ventas', function ($q) {
                                            return $q
                                                    ->where([
                                                            'OR' => [
                                                                [
                                                                    'Ventas.confirma_transferencia IS NULL',
                                                                    'Ventas.monto_transferencia IS NOT NULL'
                                                                ],
                                                                [
                                                                    'Ventas.confirma_transferencia_cartera IS NULL',
                                                                    'Ventas.monto_transferencia_cartera IS NOT NULL'
                                                                ]
                                                            ]
                                                        ]);
                                            }
                                        )
                        ->toArray();

        }
                
        $dataReal =  $control->first();

        $transferidas = TableRegistry::get('Ventas')->find();
        $transferidas = $transferidas->select([
                    'total_transferencia' => $transferidas->func()->count('id'),
                    'monto_transferencia1' => $transferidas->func()->sum('monto_transferencia'),
                    'monto_transferencia_cartera' => $transferidas->func()->sum('monto_transferencia_cartera')
                ])
                ->formatResults(function (\Cake\Collection\CollectionInterface $results) {
                    return $results->map(function ($row) {
                        $row['monto_transferencia'] = $row['monto_transferencia1'] + $row['monto_transferencia_cartera'];

                        return $row;
                    });
                })
                ->where([
                    'OR' => [
                        [
                            'Ventas.confirma_transferencia IS NULL',
                            'Ventas.monto_transferencia IS NOT NULL'
                        ],
                        [
                            'Ventas.confirma_transferencia_cartera IS NULL',
                            'Ventas.monto_transferencia_cartera IS NOT NULL'
                        ]
                    ]
                ])->first();

        $clientesTable = TableRegistry::get('Clientes');


        ///////////////////MOROSOS/////////////////////////

        $clienteMorosos = $clientesTable->clientesMorosos($this->Auth->user('id'),$this->Auth->user('role'));


        //////////////////CXC////////////////////////////Adaptar esta funcion para pasar id del vendedor y retorne el cxc por vendedor

        $cxc = $clientesTable->totalCXC($this->Auth->user('id'),$this->Auth->user('role'));
        
        $this->set(compact('dataReal','clientes','transferidas','fecha','clienteTransPen','visitasPendientes','clienteMorosos','cxc'));
    }
}
