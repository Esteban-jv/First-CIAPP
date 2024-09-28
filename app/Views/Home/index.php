<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Home<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Welcome to  custom CodeIgniter 4!</h1>

    <?php if (auth()->loggedIn()): ?>
        <p>Hello, <?= auth()->user()->first_name ?></p>
        <br>
        <a href="<?= url_to('Articles::index') ?>">Manage articles</a>
        <br><br>
        <a href="<?= url_to('logout') ?>">Logout</a>
    <?php else: ?>
        <a href="<?= url_to('login') ?>">Login</a>
    <?php endif; ?>
<?= $this->endSection() ?>