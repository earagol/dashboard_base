<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmbasesRetornado Entity
 *
 * @property int $id
 * @property int $producto_id
 * @property int $cliente_id
 * @property int $venta_id
 * @property int $cantidad
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Producto $producto
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\Venta $venta
 */
class EmbasesRetornado extends Entity
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
        'producto_id' => true,
        'cliente_id' => true,
        'venta_id' => true,
        'cantidad' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'producto' => true,
        'cliente' => true,
        'venta' => true
    ];
}
