<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Users<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>User Permissions</h1>

<?= form_open("admin/users/".$user->id."/permissions") ?>

<label>
    <input type="checkbox" name="permissions[]" value="articles.edit" <?= $user->hasPermission("articles.edit") ? "checked" : "" ?>>
    articles.edit
</label>
<label>
    <input type="checkbox" name="permissions[]" value="articles.delete" <?= $user->hasPermission("articles.delete") ? "checked" : "" ?>>
    articles.delete
</label>
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
<button type="submit">Update permissions</button>
</form>

<?= $this->endSection() ?>
