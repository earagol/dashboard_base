<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ControlDeudaPago Entity
 *
 * @property int $id
 * @property string $tipo
 * @property int $cliente_id
 * @property float $monto
 * @property float $monto_efectivo
 * @property float $monto_cheque
 * @property float $monto_transferencia
 * @property int $usuario_id
 * @property int $venta_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Venta $venta
 */
class ControlDeudaPago extends Entity
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
        'tipo' => true,
        'cliente_id' => true,
        'monto' => true,
        'monto_efectivo' => true,
        'monto_cheque' => true,
        'monto_transferencia' => true,
        'usuario_id' => true,
        'venta_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'cliente' => true,
        'usuario' => true,
        'venta' => true
    ];
}
