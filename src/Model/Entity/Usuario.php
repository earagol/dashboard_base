<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Usuario Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $nombres
 * @property string $apellidos
 * @property bool $activo
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 */
class Usuario extends Entity
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
        'username' => true,
        'password' => true,
        'nombres' => true,
        'apellidos' => true,
        'email' => true,
        'activo' => true,
        'role' => true,
        'usuario_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected $_virtual = ['full_name'];

    protected function _getFullName() {
        return $this->_properties['nombres'] . ' ' . $this->_properties['apellidos'];
    }

}
