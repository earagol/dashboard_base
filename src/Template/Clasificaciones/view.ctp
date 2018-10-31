<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clasificacione $clasificacione
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Clasificacione'), ['action' => 'edit', $clasificacione->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Clasificacione'), ['action' => 'delete', $clasificacione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clasificacione->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clasificaciones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Clasificacione'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clasificaciones view large-9 medium-8 columns content">
    <h3><?= h($clasificacione->nombre) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($clasificacione->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($clasificacione->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descuento') ?></th>
            <td><?= $this->Number->format($clasificacione->descuento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($clasificacione->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($clasificacione->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($clasificacione->deleted) ?></td>
        </tr>
    </table>
</div>
