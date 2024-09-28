<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Set Password<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Edit article</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach (session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open() ?>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>

    <label for="password_confirm">Confirm Password</label>
    <input type="password" name="password_confirm" id="password_confirm" required>

    <button type="submit">Save</button>

    </form>
<?= $this->endSection() ?>