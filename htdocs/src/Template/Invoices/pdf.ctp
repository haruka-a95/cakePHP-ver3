<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'IPAexGothic';
        }
        h1 { text-align: center; }
        p { font-size: 14px; }
    </style>
</head>
<body>
    <h1>請求書</h1>
    <p><strong>件名：</strong> <?= h($invoice->title) ?></p>
    <p><strong>金額：</strong> ¥<?= number_format($invoice->amount, 2) ?></p>
    <p><strong>期日：</strong> <?= h($invoice->due_date->format('Y-m-d')) ?></p>
    <p><strong>ステータス：</strong> <?= h($invoice->status) ?></p>
</body>
</html>
