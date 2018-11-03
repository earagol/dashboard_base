<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Venta $venta
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $venta->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $venta->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ventas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Venta Detalles'), ['controller' => 'VentaDetalles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Venta Detalle'), ['controller' => 'VentaDetalles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ventas form large-9 medium-8 columns content">
    <?= $this->Form->create($venta) ?>
    <fieldset>
        <legend><?= __('Edit Venta') ?></legend>
        <?php
            echo $this->Form->control('cliente_id', ['options' => $clientes]);
            echo $this->Form->control('usuario_id', ['options' => $usuarios]);
            echo $this->Form->control('monto_total');
            echo $this->Form->control('efectivo');
            echo $this->Form->control('monto_efectivo');
            echo $this->Form->control('transferencia');
            echo $this->Form->control('monto_transferencia');
            echo $this->Form->control('cuenta_porcobrar');
            echo $this->Form->control('pago_cartera');
            echo $this->Form->control('ano');
            echo $this->Form->control('mes');
            echo $this->Form->control('dia');
            echo $this->Form->control('observacion');
            echo $this->Form->control('deleted', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
