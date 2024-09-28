<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Users<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>User</h1>

<dl>
    <dt>First name</dt>
    <dd><?= $user->first_name ?></dd>
    <dt>Email</dt>
    <dd><?= $user->email ?></dd>
    <dt>Active</dt>
    <dd><?= $user->active ?></dd>
    <dt>Created at</dt>
    <dd><?= $user->created_at->humanize() ?></dd>
</dl>

<?= form_open("admin/users/".$user->id."/toggle-ban") ?>

    <button type="submit"><?= $user->isBanned() ? "Unban" : "Ban" ?></button>

<?= $this->endSection() ?>
