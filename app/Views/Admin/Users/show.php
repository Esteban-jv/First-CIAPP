<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Users<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>User Groups</h1>

<dl>
    <dt>First name</dt>
    <dd><?= $user->first_name ?></dd>
    <dt>Email</dt>
    <dd><?= $user->email ?></dd>
    <dt>Active</dt>
    <dd><?= $user->active ?></dd>
    <dt>Created at</dt>
    <dd><?= $user->created_at->humanize() ?></dd>
    <dt>Groups</dt>
    <dd>
        <ul>
            <?php foreach ($user->getGroups() as $group) : ?>
                <li><?= $group ?></li>
            <?php endforeach; ?>
        </ul>
    </dd>
    <a href="<?= url_to("Admin\Users::groups", $user->id) ?>">Edit groups</a>
    <dt>Permissions</dt>
    <dd>
        <ul>
            <?php foreach ($user->getPermissions() as $permission) : ?>
                <li><?= $permission ?></li>
            <?php endforeach; ?>
        </ul>
    </dd>
    <a href="<?= url_to("Admin\Users::permissions", $user->id) ?>">Edit permissions</a>
</dl>

<?= form_open("admin/users/".$user->id."/toggle-ban") ?>

    <button type="submit"><?= $user->isBanned() ? "Unban" : "Ban" ?></button>

<?= $this->endSection() ?>
