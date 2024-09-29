<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Articles<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Article <?= esc($article->title) ?></h1>

    <p><?= esc($article->content) ?></p>

    <!-- hasPermission just check the user permission but can checks user permissions and groups permissions -->
    <?php if ($article->isOwner() ||
                auth()->user()->can("articles.edit")): ?>
        <a href="<?= url_to('Articles::edit',$article->id) ?>">Edit</a>
    <?php endif ?>
    <?php if ($article->isOwner() ||
                auth()->user()->can("articles.delete")): ?>
        <a href="<?= url_to('Articles::confirmDelete',$article->id) ?>">Delete</a>
    <?php endif ?>
<?= $this->endSection() ?>