<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Users<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>User Groups</h1>

<?= form_open("admin/users/".$user->id."/groups") ?>

<label>
    <input type="checkbox" name="groups[]" value="user" <?= $user->inGroup("user") ? "checked" : "" ?>>
    user
</label>
<label>
    <?php if ($user->id === auth()->user()->id): ?>
        <input type="checkbox" checked disabled> admin
        <input type="hidden" name="groups[]" value="admin">
    <?php else: ?>
        <input type="checkbox" name="groups[]" value="admin" <?= $user->inGroup("admin") ? "checked" : "" ?>>
        admin
    <?php endif; ?>
</label>
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
<button type="submit">Update groups</button>
</form>

<?= $this->endSection() ?>
