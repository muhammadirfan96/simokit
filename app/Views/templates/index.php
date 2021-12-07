<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title; ?></title>
    <link href="<?= base_url(); ?>/sb-admin/css/styles.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/css/bootstrap.min.css" rel="stylesheet" />
    <script src="<?= base_url(); ?>/js/jquery-3.6.0.min.js"></script>
    <link href="<?= base_url(); ?>/fontawesome/css/all.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/template.css" rel="stylesheet">
</head>

<body>
    <?= $this->include('templates/topbar'); ?>
    <?= $this->include('templates/sidebar'); ?>

    <script src="<?= base_url(); ?>/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url(); ?>/sb-admin/js/scripts.js"></script>
</body>

</html>