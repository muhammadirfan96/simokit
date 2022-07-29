<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">approved checklist</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/approved_home">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table id="datatablesSimple">
            <thead class="table-success text-capitalize">
                <tr>
                    <th scope="col">aksi</th>
                    <th scope="col">tanggal</th>
                    <th scope="col">diinput oleh</th>
                    <th scope="col">nama peralatan</th>
                    <th scope="col">catatan</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col">aksi</th>
                    <th scope="col">tanggal</th>
                    <th scope="col">diinput oleh</th>
                    <th scope="col">nama peralatan</th>
                    <th scope="col">catatan</th>
                </tr>
            </tfoot>

            <tbody>
                <?php foreach ($checklist as $row) : ?>
                    <tr>
                        <td>
                            <a style="pointer-events:<?= $row["approved"] == 'n' ? 'none' : ''; ?>;" class="btn btn-sm <?= $row["approved"] == 'n' ? 'btn-danger' : 'btn-primary'; ?> my-1" href="/approved_checklist/printChecklist/<?= $row["id"]; ?>" role="button" target="_blank"><i class="fas fa-print"></i></a>
                        </td>
                        <td><?= $row["tanggal"]; ?></td>
                        <td><?= $row["diinput_oleh"]; ?></td>
                        <td><?= $row["namaPeralatan"] ?></td>
                        <td><?= $row["catatan"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>