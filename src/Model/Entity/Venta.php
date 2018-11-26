<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Venta Entity
 *
 * @property int $id
 * @property int $cliente_id
 * @property int $usuario_id
 * @property float $monto_total
 * @property bool $efectivo
 * @property float $monto_efectivo
 * @property bool $transferencia
 * @property float $monto_transferencia
 * @property float $cuenta_porcobrar
 * @property bool $pago_cartera
 * @property int $ano
 * @property int $mes
 * @property int $dia
 * @property string $observacion
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\VentaDetalle[] $venta_detalles
 */
class Venta extends Entity
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
        'cliente_id' => true,
        'usuario_id' => true,
        'monto_total' => true,
        'efectivo' => true,
        'monto_efectivo' => true,
        'transferencia' => true,
        'monto_transferencia' => true,
        'confirma_transferencia' => true,
        'fecha_transferencia' => true,
        'cuenta_porcobrar' => true,
        'pago_cartera' => true,
        'monto_cartera' => true,
        'monto_efectivo_cartera' => true,
        'monto_transferencia_cartera' => true,
        'confirma_transferencia_cartera' => true,
        'ano' => true,
        'mes' => true,
        'dia' => true,
        'observacion' => true,
        'tiene_detalles' => true,
        'fecha' => true,
        'usuario_id_anulacion' => true,
        'observacion_anulacion' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'cliente' => true,
        'usuario' => true,
        'venta_detalles' => true
    ];
}
