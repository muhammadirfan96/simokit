<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">detail kpi</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/kpi_monitoring">
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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 rounded p-2 my-2 shadow">
            <span class="fw-bold text-light text-uppercase px-2 rounded bg_orange0"><?= $user['fullname']; ?></span>
            <table class="table table-sm teble-borderless fw-bold text-uppercase">
                <tr>
                    <td width="50px">nip</td>
                    <td>: <?= $user['username']; ?></td>
                </tr>
                <tr>
                    <td>bidang</td>
                    <td>: <?= $user['bidang']; ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6 rounded p-2 my-2 shadow">
            <span class="fw-bold text-light text-uppercase px-2 rounded bg_orange0">reset kpi</span>
            <p class="text-bolder text-uppercase mb-0">peringatan</p>
            <ol class="fst-italic">
                <li>sebaiknya dilakukan hanya pada semester baru</li>
                <li>setelah anda melakukan reset maka</li>
                <ul>
                    <li>file evidence yang telah diupload akan di hapus</li>
                    <li>status kpi menjadi belum terapprove</li>
                </ul>
            </ol>
            <button class="btn btn-sm bg_merah0 text-white fst-italic mb-2" type="button" onclick="return konfir('reset', null, <?= $user['id']; ?>)">reset</button>
        </div>
        <!-- <hr class="border border-primary"> -->
        <div class="col-md-6 rounded p-2 my-2 shadow">
            <span class="fw-bold text-light text-uppercase px-2 rounded bg_orange0">key performance indicator</span>
            <div class="overflow-auto mb-2" style="height: 220px;">
                <table class="table table-sm">
                    <?php if (count($kpiUser) == 0) : ?>
                        <p class="text-center fw-bolder"><i class="fas fa-triangle-exclamation text-danger" style="font-size: 160px;"></i><br>KPI BELUM DI TAMBAHKAN</p>
                    <?php endif ?>
                    <?php foreach ($kpiUser as $row) : ?>
                        <tr>
                            <td width="90%"><?= $row['name']; ?></td>
                            <td>
                                <a href="/kpi_monitoring/approve/<?= $row['id']; ?>/<?= $row['user_id']; ?>" class="btn btn-sm fst-italic <?= $row['approve'] == 'y' ? 'text-white bg_hijau0 pe-none' : 'text-dark bg_hijau1'; ?> <?= $row['evidence'] == '' ? 'pe-none' : ''; ?>">approve</a>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-sm text-white bg_merah0 fst-italic" type="button" onclick="return konfir('delete',<?= $row['id']; ?>,<?= $row['user_id']; ?>)">delete</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
        <div class="col-md-6 rounded p-2 my-2 shadow">
            <span class="fw-bold text-light text-uppercase px-2 rounded bg_orange0">list of kpi</span>
            <form action="/kpi_monitoring/add" method="post">
                <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                <div class="overflow-auto mb-2" style="height: 200px;">
                    <table class="table table-sm">
                        <?php foreach ($listKpi as $row) : ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="kpi_id[]" value="<?= $row['id']; ?>" id="<?= $row['id']; ?>">
                                </td>
                                <td width="97%">
                                    <label for="<?= $row['id']; ?>"><?= $row['name']; ?></label>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>

                </div>
                <button class="btn btn-sm bg_birulaut0 mb-3 fst-italic" type="submit">add</button>
            </form>
        </div>

    </div>
</div>

<script>
    function konfir(method, idKpi, idUser) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus permanen data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = '/kpi_monitoring/' + method + '/' + idKpi + '/' + idUser;
            }
        });
    }
</script>

<?= $this->endSection(); ?>