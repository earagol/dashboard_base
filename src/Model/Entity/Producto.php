<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Producto Entity
 *
 * @property int $id
 * @property int $categoria_id
 * @property string $nombre
 * @property string $descripcion
 * @property int $usuario_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Categoria $categoria
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\ParametrosValore[] $parametros_valores
 * @property \App\Model\Entity\ProductosPrecio[] $productos_precios
 * @property \App\Model\Entity\VentaDetalle[] $venta_detalles
 */
class Producto extends Entity
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
        'categoria_id' => true,
        'nombre' => true,
        'descripcion' => true,
        'usuario_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'categoria' => true,
        'usuario' => true,
        'parametros_valores' => true,
        'productos_precios' => true,
        'venta_detalles' => true
    ];
}
