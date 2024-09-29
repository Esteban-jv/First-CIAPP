<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Images<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Edit image</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach (session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open_multipart('articles/'.$article->id.'/image/create') ?>
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

    <label>Image</label>
    <input type="file" name="image" id="image">

    <button type="submit">Upload</button>


    </form>
<?= $this->endSection() ?>