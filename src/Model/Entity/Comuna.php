<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comuna Entity
 *
 * @property int $id
 * @property int $region_id
 * @property string $nombre
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Region $region
 * @property \App\Model\Entity\Cliente[] $clientes
 */
class Comuna extends Entity
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
        'region_id' => true,
        'nombre' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'region' => true,
        'clientes' => true
    ];
}
