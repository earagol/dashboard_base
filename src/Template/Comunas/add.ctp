<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comuna $comuna
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Comunas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="comunas form large-9 medium-8 columns content">
    <?= $this->Form->create($comuna) ?>
    <fieldset>
        <legend><?= __('Add Comuna') ?></legend>
        <?php
            echo $this->Form->control('region_id');
            echo $this->Form->control('nombre');
            echo $this->Form->control('deleted', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
