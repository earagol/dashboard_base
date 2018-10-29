<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Clasificacione Entity
 *
 * @property int $id
 * @property string $nombre
 * @property float $descuento
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 */
class Clasificacione extends Entity
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
        'nombre' => true,
        'descuento' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true
    ];
}
