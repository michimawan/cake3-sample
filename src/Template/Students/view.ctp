<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Student'), ['action' => 'edit', $student->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Prodis'), ['controller' => 'Prodis', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Prodi'), ['controller' => 'Prodis', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="students view large-9 medium-8 columns content">
    <h3><?= h($student->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($student->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Prodi') ?></th>
            <td><?= $student->has('prodi') ? $this->Html->link($student->prodi->name, ['controller' => 'Prodis', 'action' => 'view', $student->prodi->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($student->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Nim') ?></th>
            <td><?= $this->Number->format($student->nim) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($student->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($student->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('File Name') ?></h4>
        <?= $this->Text->autoParagraph(h($student->file_name)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Path') ?></h4>
        <?= $this->Text->autoParagraph(h($student->file_path)); ?>
    </div>
    <div class="row">
        <h4><?= __('Mime Type') ?></h4>
        <?= $this->Text->autoParagraph(h($student->mime_type)); ?>
    </div>
</div>
