<div>
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?= old('title', $article->title) ?>">
</div>
<div>
    <label for="content">Content</label>
    <textarea name="content" id="content"><?= old('content', $article->content) ?></textarea>
</div>
<button>Save changes</button>