<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title><?= $this->renderSection('title') ?></title>
</head>
<body>
    <?php if (session()->has('message')): ?>
        <p><?= session('message') ?></p>
    <?php endif; ?>
    <?= $this->renderSection('content') ?>
</body>
</html>