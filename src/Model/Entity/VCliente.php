<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
// use Cake\ORM\TableRegistry;

/**
 * Cliente Entity
 *
 * @property int $id
 * @property int $ruta_id
 * @property int $clasificacion_id
 * @property string $tipo
 * @property string $razon_social
 * @property string $nombres
 * @property string $apellidos
 * @property string $email
 * @property string $sexo
 * @property string $rut
 * @property string $telefono1
 * @property string $telefono2
 * @property string $observacion
 * @property int $region_id
 * @property int $comuna_id
 * @property string $calle
 * @property string $numero_calle
 * @property string $dept_casa_oficina_numero
 * @property float $credito_disponible
 * @property float $cuenta_porcobrar
 * @property bool $activo
 * @property int $usuario_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Ruta $ruta
 * @property \App\Model\Entity\Clasificacion $clasificacion
 * @property \App\Model\Entity\Region $region
 * @property \App\Model\Entity\Comuna $comuna
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\ControlDeudaPago[] $control_deuda_pagos
 * @property \App\Model\Entity\Venta[] $ventas
 * @property \App\Model\Entity\Visita[] $visitas
 */
class VCliente extends Entity
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
        'ruta_id' => true,
        'clasificacion_id' => true,
        'tipo' => true,
        'nombres' => true,
        'email' => true,
        'sexo' => true,
        'rut' => true,
        'telefono1' => true,
        'telefono2' => true,
        'observacion' => true,
        'region_id' => true,
        'comuna_id' => true,
        'calle' => true,
        'numero_calle' => true,
        'dept_casa_oficina_numero' => true,
        'credito_disponible' => true,
        'cuenta_porcobrar' => true,
        'activo' => true,
        'usuario_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'ruta' => true,
        'clasificacion' => true,
        'region' => true,
        'comuna' => true,
        'usuario' => true,
        'control_deuda_pagos' => true,
        'ventas' => true,
        'visitas' => true
    ];
    
    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */

    protected $_virtual = ['show_select','full_address'];

    protected function _getShowSelect() {
        if(isset($this->_properties['nombres']) && isset($this->_properties['rut'])){
            return $this->_properties['nombres'] . ' - ' . $this->_properties['rut'];
        }
    }

    protected function _getFullAddress()
    {
        // return $this->comuna->nombre . ' ' .$this->calle . ' N° ' . $this->numero_calle . ' ' . $this->dept_casa_oficina_numero;
        return $this->calle . ' N° ' . $this->numero_calle . ' ' . $this->dept_casa_oficina_numero;
    }
}
