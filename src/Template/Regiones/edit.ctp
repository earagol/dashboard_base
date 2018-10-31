<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Regione $regione
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $regione->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $regione->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Regiones'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="regiones form large-9 medium-8 columns content">
    <?= $this->Form->create($regione) ?>
    <fieldset>
        <legend><?= __('Edit Regione') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('deleted', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
