<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">key performance indicator</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="flash-data-warning" data-flashdata="<?= session()->getFlashdata('pesanWarning'); ?>"></div>
            <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('pesanSuccess'); ?>"></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col rounded shadow p-2">
            <table class="table table-sm">
                <?php if (count($kpiUser) == 0) : ?>
                    <p class="text-center fw-bolder"><i class="fas fa-triangle-exclamation text_merah" style="font-size: 160px;"></i><br>KPI BELUM DI TAMBAHKAN</p>
                <?php endif ?>
                <?php foreach ($kpiUser as $row) : ?>
                    <tr>
                        <td width="90%"><?= $row['name']; ?></td>
                        <td>
                            <a class="btn btn-sm fst-italic pe-none <?= $row['approve'] == 'y' ? 'text-white bg_hijau0' : 'text-dark bg_hijau1'; ?>">approve</a>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $row['id']; ?>" class="btn btn-sm fst-italic <?= $row['evidence'] != '' ? 'text-white bg_biru0' : 'text-dark bg_biru1'; ?>">evidence</button>
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop<?= $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-capitalize" id="staticBackdropLabel">evidence <?= $row['name']; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php if ($row['evidence'] != '') : ?>
                                                <table class="table table-sm table-borderless">
                                                    <tr>
                                                        <td width="90%">
                                                            <?= $row['evidence']; ?>
                                                        </td>
                                                        <td>
                                                            <a href="/kpi/download/<?= $row['evidence']; ?>" class="btn btn-sm bg_biru0 fst-italic text-white" target="_blank">download</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            <?php endif ?>
                                            <?php if ($row['evidence'] == '') : ?>
                                                <p class="text-center fw-bolder"><i class="fas fa-triangle-exclamation text-danger" style="font-size: 160px;"></i><br>EVIDENCE BELUM ADA</p>
                                            <?php endif ?>

                                            <form action="/kpi/upload/<?= $row['id']; ?>" method="post" enctype="multipart/form-data">
                                                <input class="form-control rounded mb-3" type="file" name="<?= $row['id']; ?>" id="<?= $row['id']; ?>" required>

                                                <button class="btn btn-sm bg_hijau0 fst-italic text-white" <?= $row['approve'] == 'y' ? 'disabled' : ''; ?>><?= $row['evidence'] != '' ? 'edit' : 'upload'; ?></button>
                                                <span class="text-danger fst-italic"><?= $row['approve'] == 'y' ? 'evidence sudah diapprove. tidak dapat diedit' : ''; ?></span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>