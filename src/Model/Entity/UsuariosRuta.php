<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsuariosRuta Entity
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $ruta_id
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Ruta $ruta
 * @property \App\Model\Entity\User $user
 */
class UsuariosRuta extends Entity
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
        'ruta_id' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'usuario' => true,
        'ruta' => true,
        'user' => true
    ];
}
