<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Users<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Users</h1>

<table>
    <thead>
        <tr>
            <th>First name</th>
            <th>Email</th>
            <th>Active</th>
            <th>Banned</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><a href="<?= url_to("App\Controllers\Admin\Users::show", $user->id) ?>"><?= $user->first_name ?></a></td>
                <td><?= $user->email ?></td>
                <td><?= yesno($user->active) ?></td>
                <td><?= yesno($user->isBanned()) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $pager->links() ?>

<?= $this->endSection() ?>
