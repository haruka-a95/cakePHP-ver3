<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invoice $invoice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('アクション') ?></li>
        <li><?= $this->Html->link(__('請求書リスト'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="invoices form large-9 medium-8 columns content">
    <?= $this->Form->create($invoice) ?>
    <fieldset>
        <legend><?= __('請求書追加') ?></legend>
        <?php
            echo $this->Form->control('title', ['label' => '件名']);
            echo $this->Form->control('amount', ['label' => '金額']);
            echo $this->Form->control('due_date', ['label' => '期日']);
            echo $this->Form->control('status', ['label' => 'ステータス']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->end() ?>
</div>
