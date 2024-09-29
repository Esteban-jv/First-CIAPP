<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Articles<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Article <?= esc($article->title) ?></h1>

    <?php if ($article->image): ?>
        <img src="<?= url_to("App\Controllers\Articles\Image::get", $article->id) ?>" alt="article image">

        <?= form_open('articles/'.$article->id.'/image/delete') ?>
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

        <button type="submit">Delete</button>

        </form>
    <?php else: ?>
        <a href="<?= url_to('App\Controllers\Articles\Image::new', $article->id) ?>">Add image</a>
    <?php endif ?>

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