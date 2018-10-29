<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente $cliente
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cliente'), ['action' => 'edit', $cliente->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cliente'), ['action' => 'delete', $cliente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cliente->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clientes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cliente'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rutas'), ['controller' => 'Rutas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ruta'), ['controller' => 'Rutas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Control Deuda Pagos'), ['controller' => 'ControlDeudaPagos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Control Deuda Pago'), ['controller' => 'ControlDeudaPagos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ventas'), ['controller' => 'Ventas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Venta'), ['controller' => 'Ventas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Visitas'), ['controller' => 'Visitas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Visita'), ['controller' => 'Visitas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clientes view large-9 medium-8 columns content">
    <h3><?= h($cliente->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ruta') ?></th>
            <td><?= $cliente->has('ruta') ? $this->Html->link($cliente->ruta->nombre, ['controller' => 'Rutas', 'action' => 'view', $cliente->ruta->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= h($cliente->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Razon Social') ?></th>
            <td><?= h($cliente->razon_social) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombres') ?></th>
            <td><?= h($cliente->nombres) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellidos') ?></th>
            <td><?= h($cliente->apellidos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($cliente->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sexo') ?></th>
            <td><?= h($cliente->sexo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rut') ?></th>
            <td><?= h($cliente->rut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telefono1') ?></th>
            <td><?= h($cliente->telefono1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telefono2') ?></th>
            <td><?= h($cliente->telefono2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Calle') ?></th>
            <td><?= h($cliente->calle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero Calle') ?></th>
            <td><?= h($cliente->numero_calle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dept Casa Oficina Numero') ?></th>
            <td><?= h($cliente->dept_casa_oficina_numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= $cliente->has('usuario') ? $this->Html->link($cliente->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $cliente->usuario->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cliente->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Clasificacion Id') ?></th>
            <td><?= $this->Number->format($cliente->clasificacion_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Region Id') ?></th>
            <td><?= $this->Number->format($cliente->region_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comuna Id') ?></th>
            <td><?= $this->Number->format($cliente->comuna_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Credito Disponible') ?></th>
            <td><?= $this->Number->format($cliente->credito_disponible) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cuenta Porcobrar') ?></th>
            <td><?= $this->Number->format($cliente->cuenta_porcobrar) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($cliente->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($cliente->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($cliente->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activo') ?></th>
            <td><?= $cliente->activo ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Observacion') ?></h4>
        <?= $this->Text->autoParagraph(h($cliente->observacion)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Control Deuda Pagos') ?></h4>
        <?php if (!empty($cliente->control_deuda_pagos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Tipo') ?></th>
                <th scope="col"><?= __('Cliente Id') ?></th>
                <th scope="col"><?= __('Monto') ?></th>
                <th scope="col"><?= __('Monto Efectivo') ?></th>
                <th scope="col"><?= __('Monto Cheque') ?></th>
                <th scope="col"><?= __('Monto Transferencia') ?></th>
                <th scope="col"><?= __('Usuario Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($cliente->control_deuda_pagos as $controlDeudaPagos): ?>
            <tr>
                <td><?= h($controlDeudaPagos->id) ?></td>
                <td><?= h($controlDeudaPagos->tipo) ?></td>
                <td><?= h($controlDeudaPagos->cliente_id) ?></td>
                <td><?= h($controlDeudaPagos->monto) ?></td>
                <td><?= h($controlDeudaPagos->monto_efectivo) ?></td>
                <td><?= h($controlDeudaPagos->monto_cheque) ?></td>
                <td><?= h($controlDeudaPagos->monto_transferencia) ?></td>
                <td><?= h($controlDeudaPagos->usuario_id) ?></td>
                <td><?= h($controlDeudaPagos->created) ?></td>
                <td><?= h($controlDeudaPagos->modified) ?></td>
                <td><?= h($controlDeudaPagos->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ControlDeudaPagos', 'action' => 'view', $controlDeudaPagos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ControlDeudaPagos', 'action' => 'edit', $controlDeudaPagos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ControlDeudaPagos', 'action' => 'delete', $controlDeudaPagos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $controlDeudaPagos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Ventas') ?></h4>
        <?php if (!empty($cliente->ventas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Cliente Id') ?></th>
                <th scope="col"><?= __('Usuario Id') ?></th>
                <th scope="col"><?= __('Monto Total') ?></th>
                <th scope="col"><?= __('Efectivo') ?></th>
                <th scope="col"><?= __('Monto Efectivo') ?></th>
                <th scope="col"><?= __('Transferencia') ?></th>
                <th scope="col"><?= __('Monto Transferencia') ?></th>
                <th scope="col"><?= __('Cuenta Porcobrar') ?></th>
                <th scope="col"><?= __('Pago Cartera') ?></th>
                <th scope="col"><?= __('Ano') ?></th>
                <th scope="col"><?= __('Mes') ?></th>
                <th scope="col"><?= __('Dia') ?></th>
                <th scope="col"><?= __('Observacion') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($cliente->ventas as $ventas): ?>
            <tr>
                <td><?= h($ventas->id) ?></td>
                <td><?= h($ventas->cliente_id) ?></td>
                <td><?= h($ventas->usuario_id) ?></td>
                <td><?= h($ventas->monto_total) ?></td>
                <td><?= h($ventas->efectivo) ?></td>
                <td><?= h($ventas->monto_efectivo) ?></td>
                <td><?= h($ventas->transferencia) ?></td>
                <td><?= h($ventas->monto_transferencia) ?></td>
                <td><?= h($ventas->cuenta_porcobrar) ?></td>
                <td><?= h($ventas->pago_cartera) ?></td>
                <td><?= h($ventas->ano) ?></td>
                <td><?= h($ventas->mes) ?></td>
                <td><?= h($ventas->dia) ?></td>
                <td><?= h($ventas->observacion) ?></td>
                <td><?= h($ventas->created) ?></td>
                <td><?= h($ventas->modified) ?></td>
                <td><?= h($ventas->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Ventas', 'action' => 'view', $ventas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Ventas', 'action' => 'edit', $ventas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ventas', 'action' => 'delete', $ventas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ventas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Visitas') ?></h4>
        <?php if (!empty($cliente->visitas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Usuario Id') ?></th>
                <th scope="col"><?= __('Cliente Id') ?></th>
                <th scope="col"><?= __('Observacion') ?></th>
                <th scope="col"><?= __('Fecha Vencimiento') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($cliente->visitas as $visitas): ?>
            <tr>
                <td><?= h($visitas->id) ?></td>
                <td><?= h($visitas->usuario_id) ?></td>
                <td><?= h($visitas->cliente_id) ?></td>
                <td><?= h($visitas->observacion) ?></td>
                <td><?= h($visitas->fecha_vencimiento) ?></td>
                <td><?= h($visitas->status) ?></td>
                <td><?= h($visitas->user_id) ?></td>
                <td><?= h($visitas->created) ?></td>
                <td><?= h($visitas->modified) ?></td>
                <td><?= h($visitas->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Visitas', 'action' => 'view', $visitas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Visitas', 'action' => 'edit', $visitas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Visitas', 'action' => 'delete', $visitas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visitas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
