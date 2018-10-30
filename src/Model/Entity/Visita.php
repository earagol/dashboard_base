<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Visita Entity
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $cliente_id
 * @property string $observacion
 * @property \Cake\I18n\FrozenTime $fecha_vencimiento
 * @property string $status
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\User $user
 */
class Visita extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'usuario_id' => true,
        'cliente_id' => true,
        'observacion' => true,
        'fecha_vencimiento' => true,
        'status' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'usuario' => true,
        'cliente' => true,
        'user' => true
    ];
}
