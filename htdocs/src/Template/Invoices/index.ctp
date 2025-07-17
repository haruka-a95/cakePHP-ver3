<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invoice[]|\Cake\Collection\CollectionInterface $invoices
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('アクション') ?></li>
        <li><?= $this->Html->link(__('請求書を作成'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="invoices index large-9 medium-8 columns content">
    <h3><?= __('請求書') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', 'ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title', '件名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount', '金額') ?></th>
                <th scope="col"><?= $this->Paginator->sort('due_date', '期日') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status', 'ステータス') ?></th>
                <th scope="col" class="actions"><?= __('アクション') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= $this->Number->format($invoice->id) ?></td>
                <td><?= h($invoice->title) ?></td>
                <td><?= $this->Number->format($invoice->amount) ?></td>
                <td><?= h($invoice->due_date) ?></td>
                <td><?= h($invoice->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $invoice->id]) ?>
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $invoice->id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?>
                    <?= $this->Html->link('PDF出力', ['action' => 'print', $invoice->id], ['target' => '_blank']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('1件目')) ?>
            <?= $this->Paginator->prev('< ' . __('前へ')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('次へ') . ' >') ?>
            <?= $this->Paginator->last(__('最後へ') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
