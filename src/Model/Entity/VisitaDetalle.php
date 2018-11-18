<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VisitaDetalle Entity
 *
 * @property int $id
 * @property int $visita_id
 * @property int $producto_id
 * @property int $precio_id
 * @property float $precio_unitario
 * @property int $cantidad
 * @property float $total
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Visita $visita
 * @property \App\Model\Entity\Producto $producto
 * @property \App\Model\Entity\Precio $precio
 */
class VisitaDetalle extends Entity
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
        'visita_id' => true,
        'producto_id' => true,
        'precio_id' => true,
        'precio_unitario' => true,
        'cantidad' => true,
        'total' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'visita' => true,
        'producto' => true,
        'precio' => true
    ];
}
