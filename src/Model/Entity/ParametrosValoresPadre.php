<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ParametrosValoresPadre Entity
 *
 * @property int $id
 * @property int $parametros_tipo_id
 * @property \Cake\I18n\FrozenDate $fecha
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\ParametrosTipo $parametros_tipo
 */
class ParametrosValoresPadre extends Entity
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
        'parametros_tipo_id' => true,
        'fecha' => true,
        'usuario_id' => true,
        'observacion' => true,
        'cierre_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'parametros_tipo' => true
    ];
}
