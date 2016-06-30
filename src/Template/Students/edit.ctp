<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $student->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Students'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Prodis'), ['controller' => 'Prodis', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Prodi'), ['controller' => 'Prodis', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="students form large-9 medium-8 columns content">
    <?= $this->Form->create($student, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Edit Student') ?></legend>
        <?php
            echo $this->Form->input('nim');
            echo $this->Form->input('name');
            echo $this->Form->input('prodi_id', ['options' => $prodis]);
            echo $this->Form->input('photo', [
                'type' => 'file',
                'label' => 'Photo',
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
