<div>
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?= old('title', $article->title) ?>">
</div>
<div>
    <label for="content">Content</label>
    <textarea name="content" id="content"><?= old('content', $article->content) ?></textarea>
</div>
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
<button>Save changes</button>