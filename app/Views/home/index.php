<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<?= $this->include('home/schedule'); ?>
<?= $this->include('home/notice'); ?>

<?= $this->endSection(); ?>