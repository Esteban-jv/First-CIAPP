<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Articles<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Article <?= esc($article->title) ?></h1>

    <p><?= esc($article->content) ?></p>

    <?php if ($article->isOwner()): ?>
        <a href="<?= url_to('Articles::edit',$article->id) ?>">Edit</a>
        <a href="<?= url_to('Articles::confirmDelete',$article->id) ?>">Delete</a>
    <?php endif ?>
<?= $this->endSection() ?>