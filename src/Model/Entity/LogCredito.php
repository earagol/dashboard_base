<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LogCredito Entity
 *
 * @property int $id
 * @property int $cliente_id
 * @property float $monto
 * @property int $usuario_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Cliente $cliente
 */
class LogCredito extends Entity
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
        'cliente_id' => true,
        'monto' => true,
        'usuario_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'cliente' => true
    ];
}
