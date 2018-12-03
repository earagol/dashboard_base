<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CierreOperacione Entity
 *
 * @property int $id
 * @property int $vendedor_id
 * @property int $admin_id
 * @property \Cake\I18n\FrozenDate $fecha_cierre
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Vendedor $vendedor
 * @property \App\Model\Entity\Admin $admin
 */
class CierreOperacione extends Entity
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
        'vendedor_id' => true,
        'admin_id' => true,
        'fecha_cierre' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'vendedor' => true,
        'admin' => true
    ];
}
