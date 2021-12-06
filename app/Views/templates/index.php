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
    <script src="<?= base_url(); ?>/js/jquery-3.6.0.min.js"></script>
    <link href="<?= base_url(); ?>/fontawesome/css/all.css" rel="stylesheet">
</head>

<body>
    <?= $this->include('templates/topbar'); ?>
    <?= $this->include('templates/sidebar'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>/sb-admin/js/scripts.js"></script>
</body>

</html>