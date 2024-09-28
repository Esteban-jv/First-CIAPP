<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title><?= $this->renderSection('title') ?></title>
</head>
<body>
    <nav>
        <a href="<?= url_to('/') ?>">Home</a>
        <?php if (auth()->loggedIn()): ?>
            Hello, <?= auth()->user()->first_name ?>
            <a href="<?= url_to('Articles::index') ?>">Manage articles</a>
            <a href="<?= url_to('admin/users') ?>">Manage users</a>
            <a href="<?= url_to('logout') ?>">Logout</a>
        <?php else: ?>
            <a href="<?= url_to('login') ?>">Login</a>
        <?php endif; ?>
    </nav>
    <?php if (session()->has('message')): ?>
        <p><?= session('message') ?></p>
    <?php endif; ?>
    <?= $this->renderSection('content') ?>
</body>
</html>