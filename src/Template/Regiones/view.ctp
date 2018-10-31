<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Regione $regione
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Regione'), ['action' => 'edit', $regione->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Regione'), ['action' => 'delete', $regione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $regione->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Regiones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Regione'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="regiones view large-9 medium-8 columns content">
    <h3><?= h($regione->nombre) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($regione->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($regione->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($regione->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($regione->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($regione->deleted) ?></td>
        </tr>
    </table>
</div>
