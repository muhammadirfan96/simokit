<div class="table-responsive mb-3">
    <table class="table table-hover">
        <thead class="table-success text-center text-capitalize align-middle">
            <tr>
                <th scope="col">no</th>
                <th scope="col">aksi</th>
                <th scope="col">tanggal</th>
                <th scope="col">diinput oleh</th>
                <th scope="col">nama peralatan</th>
                <th scope="col">catatan</th>
            </tr>
        </thead>

        <?php $i = 1 + (5 * ($currentPage - 1)); ?>
        <?php foreach ($servicerequest as $row) : ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td>
                    <a class="btn btn-sm btn-danger mb-2" href="/db_checklist/<?= $row["id"]; ?>" role="button" target="_blank">print</a>

                    <form action="/db_checklist/<?= $row["id"]; ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-sm btn-secondary" type="submit" onclick="return confirm('delete?')">delete</button>
                    </form>
                </td>
                <td><?= $row["tanggal"]; ?></td>
                <td><?= $row["diinput_oleh"]; ?></td>
                <td><?= $row["namaPeralatan"] ?></td>
                <td><?= $row["catatan"] ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</div>