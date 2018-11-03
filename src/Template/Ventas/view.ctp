<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Venta $venta
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Venta'), ['action' => 'edit', $venta->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Venta'), ['action' => 'delete', $venta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $venta->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ventas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Venta'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Venta Detalles'), ['controller' => 'VentaDetalles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Venta Detalle'), ['controller' => 'VentaDetalles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ventas view large-9 medium-8 columns content">
    <h3><?= h($venta->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Cliente') ?></th>
            <td><?= $venta->has('cliente') ? $this->Html->link($venta->cliente->nombres, ['controller' => 'Clientes', 'action' => 'view', $venta->cliente->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= $venta->has('usuario') ? $this->Html->link($venta->usuario->full_name, ['controller' => 'Usuarios', 'action' => 'view', $venta->usuario->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($venta->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Monto Total') ?></th>
            <td><?= $this->Number->format($venta->monto_total) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Monto Efectivo') ?></th>
            <td><?= $this->Number->format($venta->monto_efectivo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Monto Transferencia') ?></th>
            <td><?= $this->Number->format($venta->monto_transferencia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cuenta Porcobrar') ?></th>
            <td><?= $this->Number->format($venta->cuenta_porcobrar) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ano') ?></th>
            <td><?= $this->Number->format($venta->ano) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mes') ?></th>
            <td><?= $this->Number->format($venta->mes) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dia') ?></th>
            <td><?= $this->Number->format($venta->dia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($venta->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($venta->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($venta->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Efectivo') ?></th>
            <td><?= $venta->efectivo ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transferencia') ?></th>
            <td><?= $venta->transferencia ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pago Cartera') ?></th>
            <td><?= $venta->pago_cartera ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Observacion') ?></h4>
        <?= $this->Text->autoParagraph(h($venta->observacion)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Venta Detalles') ?></h4>
        <?php if (!empty($venta->venta_detalles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Venta Id') ?></th>
                <th scope="col"><?= __('Producto Id') ?></th>
                <th scope="col"><?= __('Precio Id') ?></th>
                <th scope="col"><?= __('Precio Unitario') ?></th>
                <th scope="col"><?= __('Cantidad') ?></th>
                <th scope="col"><?= __('Total') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($venta->venta_detalles as $ventaDetalles): ?>
            <tr>
                <td><?= h($ventaDetalles->id) ?></td>
                <td><?= h($ventaDetalles->venta_id) ?></td>
                <td><?= h($ventaDetalles->producto_id) ?></td>
                <td><?= h($ventaDetalles->precio_id) ?></td>
                <td><?= h($ventaDetalles->precio_unitario) ?></td>
                <td><?= h($ventaDetalles->cantidad) ?></td>
                <td><?= h($ventaDetalles->total) ?></td>
                <td><?= h($ventaDetalles->created) ?></td>
                <td><?= h($ventaDetalles->modified) ?></td>
                <td><?= h($ventaDetalles->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'VentaDetalles', 'action' => 'view', $ventaDetalles->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'VentaDetalles', 'action' => 'edit', $ventaDetalles->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'VentaDetalles', 'action' => 'delete', $ventaDetalles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ventaDetalles->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
