<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ruta $ruta
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ruta'), ['action' => 'edit', $ruta->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ruta'), ['action' => 'delete', $ruta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ruta->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rutas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ruta'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rutas view large-9 medium-8 columns content">
    <h3><?= h($ruta->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombres') ?></th>
            <td><?= h($ruta->nombres) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ruta->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario Id') ?></th>
            <td><?= $this->Number->format($ruta->usuario_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($ruta->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($ruta->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($ruta->deleted) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Usuarios') ?></h4>
        <?php if (!empty($ruta->usuarios)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Nombres') ?></th>
                <th scope="col"><?= __('Apellidos') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Activo') ?></th>
                <th scope="col"><?= __('Role') ?></th>
                <th scope="col"><?= __('Usuario Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($ruta->usuarios as $usuarios): ?>
            <tr>
                <td><?= h($usuarios->id) ?></td>
                <td><?= h($usuarios->username) ?></td>
                <td><?= h($usuarios->password) ?></td>
                <td><?= h($usuarios->nombres) ?></td>
                <td><?= h($usuarios->apellidos) ?></td>
                <td><?= h($usuarios->email) ?></td>
                <td><?= h($usuarios->activo) ?></td>
                <td><?= h($usuarios->role) ?></td>
                <td><?= h($usuarios->usuario_id) ?></td>
                <td><?= h($usuarios->created) ?></td>
                <td><?= h($usuarios->modified) ?></td>
                <td><?= h($usuarios->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Usuarios', 'action' => 'view', $usuarios->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Usuarios', 'action' => 'edit', $usuarios->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Usuarios', 'action' => 'delete', $usuarios->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuarios->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Clientes') ?></h4>
        <?php if (!empty($ruta->clientes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Ruta Id') ?></th>
                <th scope="col"><?= __('Clasificacion Id') ?></th>
                <th scope="col"><?= __('Tipo') ?></th>
                <th scope="col"><?= __('Razon Social') ?></th>
                <th scope="col"><?= __('Nombres') ?></th>
                <th scope="col"><?= __('Apellidos') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Sexo') ?></th>
                <th scope="col"><?= __('Rut') ?></th>
                <th scope="col"><?= __('Telefono1') ?></th>
                <th scope="col"><?= __('Telefono2') ?></th>
                <th scope="col"><?= __('Observacion') ?></th>
                <th scope="col"><?= __('Region Id') ?></th>
                <th scope="col"><?= __('Comuna Id') ?></th>
                <th scope="col"><?= __('Calle') ?></th>
                <th scope="col"><?= __('Numero Calle') ?></th>
                <th scope="col"><?= __('Dept Casa Oficina Numero') ?></th>
                <th scope="col"><?= __('Credito Disponible') ?></th>
                <th scope="col"><?= __('Cuenta Porcobrar') ?></th>
                <th scope="col"><?= __('Activo') ?></th>
                <th scope="col"><?= __('Usuario Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($ruta->clientes as $clientes): ?>
            <tr>
                <td><?= h($clientes->id) ?></td>
                <td><?= h($clientes->ruta_id) ?></td>
                <td><?= h($clientes->clasificacion_id) ?></td>
                <td><?= h($clientes->tipo) ?></td>
                <td><?= h($clientes->razon_social) ?></td>
                <td><?= h($clientes->nombres) ?></td>
                <td><?= h($clientes->apellidos) ?></td>
                <td><?= h($clientes->email) ?></td>
                <td><?= h($clientes->sexo) ?></td>
                <td><?= h($clientes->rut) ?></td>
                <td><?= h($clientes->telefono1) ?></td>
                <td><?= h($clientes->telefono2) ?></td>
                <td><?= h($clientes->observacion) ?></td>
                <td><?= h($clientes->region_id) ?></td>
                <td><?= h($clientes->comuna_id) ?></td>
                <td><?= h($clientes->calle) ?></td>
                <td><?= h($clientes->numero_calle) ?></td>
                <td><?= h($clientes->dept_casa_oficina_numero) ?></td>
                <td><?= h($clientes->credito_disponible) ?></td>
                <td><?= h($clientes->cuenta_porcobrar) ?></td>
                <td><?= h($clientes->activo) ?></td>
                <td><?= h($clientes->usuario_id) ?></td>
                <td><?= h($clientes->created) ?></td>
                <td><?= h($clientes->modified) ?></td>
                <td><?= h($clientes->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Clientes', 'action' => 'view', $clientes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Clientes', 'action' => 'edit', $clientes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Clientes', 'action' => 'delete', $clientes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
