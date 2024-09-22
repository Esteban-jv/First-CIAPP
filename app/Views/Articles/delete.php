<?= $this->extend("layouts/default") ?>
<?= $this->section("title") ?>Delete article<?= $this->endSection() ?>
<?= $this->section("content") ?>
    <h1>Delete article</h1>

    <p>Are you sure you want to delete the article "<?= esc($article->title) ?>"?</p>

    <?= form_open("/articles/delete/".$article->id) ?>
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit">Yes</button>
    </form>
<?= $this->endSection() ?>

