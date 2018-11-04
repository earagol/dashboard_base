<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ParametrosTipo $parametrosTipo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Parametros Tipo'), ['action' => 'edit', $parametrosTipo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Parametros Tipo'), ['action' => 'delete', $parametrosTipo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parametrosTipo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Parametros Tipos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parametros Tipo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="parametrosTipos view large-9 medium-8 columns content">
    <h3><?= h($parametrosTipo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= h($parametrosTipo->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($parametrosTipo->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= $parametrosTipo->has('usuario') ? $this->Html->link($parametrosTipo->usuario->full_name, ['controller' => 'Usuarios', 'action' => 'view', $parametrosTipo->usuario->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($parametrosTipo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($parametrosTipo->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($parametrosTipo->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($parametrosTipo->deleted) ?></td>
        </tr>
    </table>
</div>
