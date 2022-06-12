<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">list of sop ik</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<?php
$data = [
    ['https://drive.google.com/drive/folders/1Ri6UnOa206v_HF7LhovdIGanya3yzqHj', 'fa-book', 'boiler'],
    ['https://drive.google.com/drive/folders/1i9XLQx_WecqSBz26Hzx54nb_VqSMzHmq', 'fa-book', 'turbin'],
    ['https://drive.google.com/drive/folders/1P5ZZjGXmFCFO8bmHGAMwHe0xDdfan2FH', 'fa-book', 'alba'],
    ['https://drive.google.com/drive/folders/1sKkrZu4jjiIwVa7oluaVYGKN47IgJDIy', 'fa-book', 'wtp'],
    ['https://drive.google.com/drive/folders/18IBMwXVj5vIsY-C38LgdcKJmUsN1xO0s', 'fa-book', 'umum']
];
?>

<div class="container-fluid text-center text-capitalize">
    <div class="row">
        <?php foreach ($data as $row) : ?>
            <div class="col-xl-4 col-md-6 mb-3">
                <a target="_blank" href="<?= $row[0]; ?>" class="text-decoration-none rounded shadow d-block">
                    <div class="p-2 bg_hijau1 rounded-top border_bottom2 text-start">
                        <i class="fas <?= $row[1]; ?> fs-2 text-success"></i>
                        <p class="fw-bolder text-uppercase fs-5 d-inline-block mb-0 text-success text-right">sop ik</p>
                    </div>
                    <div class="rounded-bottom text-dark fw-bolder text-uppercase py-2">
                        peralatan <?= $row[2]; ?>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?= $this->endSection(); ?>