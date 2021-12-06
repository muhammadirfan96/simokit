<div style="font-size: 12px;" class="table-responsive mb-3">
    <table class="table table-hover">
        <thead class="table-success text-center text-capitalize align-middle">
            <tr>
                <th scope="col">no</th>
                <th scope="col">aksi</th>
                <th scope="col">ket</th>
                <th scope="col">diinput oleh</th>
                <th scope="col">nomor sr</th>
                <th scope="col">tanggal</th>
                <th scope="col">unit</th>
                <th scope="col">area</th>
                <th scope="col">nama peralatan</th>
                <th scope="col">KKS</th>
                <th scope="col">uraian gangguan 1</th>
                <th scope="col">uraian gangguan 2</th>
                <th scope="col">normal operasi 1</th>
                <th scope="col">normal operasi 2</th>
                <th scope="col">gejala 1</th>
                <th scope="col">gejala 2</th>
                <th scope="col">prioritas</th>
                <th scope="col">akibat kerusakan 1</th>
                <th scope="col">akibat kerusakan 2</th>
                <th scope="col">kemungkinan dampak 1</th>
                <th scope="col">kemungkinan dampak 2</th>
                <th scope="col">tindakan sementara 1</th>
                <th scope="col">tindakan sementara 2</th>
                <th scope="col">tindakan sementara 3</th>
                <th scope="col">evidence 1</th>
                <th scope="col">evidence 2</th>
            </tr>
        </thead>

        <?php $i = 1 + (5 * ($currentPage - 1)); ?>
        <?php foreach ($servicerequest as $row) : ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td>
                    <a class="btn btn-sm btn-danger mb-2" href="/db_servicerequest/<?= $row["id"]; ?>" role="button" target="_blank">print</a>

                    <form action="/db_servicerequest/<?= $row["id"]; ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-sm btn-secondary" type="submit" onclick="return confirm('delete?')">delete</button>
                    </form>
                </td>
                <td><?= $row["ket"]; ?></td>
                <td><?= $row["diinput_oleh"]; ?></td>
                <td><?= $row["nomorSr"] ?></td>
                <td><?= $row["tanggal"] ?></td>
                <td><?= $row["unit"]; ?></td>
                <td><?= $row["area"]; ?></td>
                <td><?= $row["namaPeralatan"]; ?></td>
                <td><?= $row["kks"]; ?></td>
                <td><?= $row["uraianGangguan1"]; ?></td>
                <td><?= $row["uraianGangguan2"]; ?></td>
                <td><?= $row["normalOperasi1"]; ?></td>
                <td><?= $row["normalOperasi2"]; ?></td>
                <td><?= $row["gejala1"]; ?></td>
                <td><?= $row["gejala2"]; ?></td>
                <td><?= $row["prioritas"]; ?></td>
                <td><?= $row["akibatKerusakan1"]; ?></td>
                <td><?= $row["akibatKerusakan2"]; ?></td>
                <td><?= $row["kemungkinanDampak1"]; ?></td>
                <td><?= $row["kemungkinanDampak2"]; ?></td>
                <td><?= $row["tindakanSementara1"]; ?></td>
                <td><?= $row["tindakanSementara2"]; ?></td>
                <td><?= $row["tindakanSementara3"]; ?></td>
                <td>

                </td>
                <td>

                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</div>