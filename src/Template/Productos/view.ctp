<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Producto $producto
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Producto'), ['action' => 'edit', $producto->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Producto'), ['action' => 'delete', $producto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $producto->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Productos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Producto'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parametros Valores'), ['controller' => 'ParametrosValores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parametros Valore'), ['controller' => 'ParametrosValores', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Productos Precios'), ['controller' => 'ProductosPrecios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Productos Precio'), ['controller' => 'ProductosPrecios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Venta Detalles'), ['controller' => 'VentaDetalles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Venta Detalle'), ['controller' => 'VentaDetalles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="productos view large-9 medium-8 columns content">
    <h3><?= h($producto->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Categoria') ?></th>
            <td><?= $producto->has('categoria') ? $this->Html->link($producto->categoria->id, ['controller' => 'Categorias', 'action' => 'view', $producto->categoria->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($producto->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= $producto->has('usuario') ? $this->Html->link($producto->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $producto->usuario->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($producto->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($producto->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($producto->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($producto->deleted) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Descripcion') ?></h4>
        <?= $this->Text->autoParagraph(h($producto->descripcion)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Parametros Valores') ?></h4>
        <?php if (!empty($producto->parametros_valores)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Tipo Id') ?></th>
                <th scope="col"><?= __('Producto Id') ?></th>
                <th scope="col"><?= __('Monto O Cantidad') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($producto->parametros_valores as $parametrosValores): ?>
            <tr>
                <td><?= h($parametrosValores->id) ?></td>
                <td><?= h($parametrosValores->tipo_id) ?></td>
                <td><?= h($parametrosValores->producto_id) ?></td>
                <td><?= h($parametrosValores->monto_o_cantidad) ?></td>
                <td><?= h($parametrosValores->created) ?></td>
                <td><?= h($parametrosValores->modified) ?></td>
                <td><?= h($parametrosValores->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ParametrosValores', 'action' => 'view', $parametrosValores->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ParametrosValores', 'action' => 'edit', $parametrosValores->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ParametrosValores', 'action' => 'delete', $parametrosValores->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parametrosValores->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Productos Precios') ?></h4>
        <?php if (!empty($producto->productos_precios)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Producto Id') ?></th>
                <th scope="col"><?= __('Precio') ?></th>
                <th scope="col"><?= __('Usuario Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($producto->productos_precios as $productosPrecios): ?>
            <tr>
                <td><?= h($productosPrecios->id) ?></td>
                <td><?= h($productosPrecios->producto_id) ?></td>
                <td><?= h($productosPrecios->precio) ?></td>
                <td><?= h($productosPrecios->usuario_id) ?></td>
                <td><?= h($productosPrecios->created) ?></td>
                <td><?= h($productosPrecios->modified) ?></td>
                <td><?= h($productosPrecios->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ProductosPrecios', 'action' => 'view', $productosPrecios->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ProductosPrecios', 'action' => 'edit', $productosPrecios->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProductosPrecios', 'action' => 'delete', $productosPrecios->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productosPrecios->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Venta Detalles') ?></h4>
        <?php if (!empty($producto->venta_detalles)): ?>
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
            <?php foreach ($producto->venta_detalles as $ventaDetalles): ?>
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
