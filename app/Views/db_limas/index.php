<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container">
    <div class="row">
        <div class="col-11">
            <p class="fs-4 fw-bold my-3 text-light text-uppercase"><span class="bg-secondary rounded px-2">database kegiatan 5s</span></p>
        </div>
        <div class="col-1 justify-content-end d-flex">
            <a class="fs-4 text-danger my-3" href="/db_home">
                <div class="justify-content-end d-flex"><i class="fas fa-backspace"></i></div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
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
                    <th scope="col">area</th>
                    <th scope="col">saran</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col">aksi</th>
                    <th scope="col">tanggal</th>
                    <th scope="col">diinput oleh</th>
                    <th scope="col">nama peralatan</th>
                    <th scope="col">area</th>
                    <th scope="col">saran</th>
                </tr>
            </tfoot>

            <tbody>
                <?php foreach ($limas as $row) : ?>
                    <tr>
                        <td>
                            <a class="btn btn-sm btn-danger d-inline me-2" href="/db_limas/<?= $row["id"]; ?>" role="button" target="_blank">print</a>

                            <form class="d-inline" action="/db_limas/<?= $row["id"]; ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-sm btn-secondary mt-2" type="submit" onclick="return confirm('delete?')">delete</button>
                            </form>
                        </td>
                        <td><?= $row["tanggal"]; ?></td>
                        <td><?= $row["diinput_oleh"]; ?></td>
                        <td><?= $row["namaPeralatan"] ?></td>
                        <td><?= $row["area"] ?></td>
                        <td><?= $row["saran"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>