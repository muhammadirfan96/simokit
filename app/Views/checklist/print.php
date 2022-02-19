<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form checklist</title>
    <link rel="stylesheet" href="css/cetak.css">
</head>

<body>
    <div class="table">
        <table width="100%" border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Pertanyaan</th>
                <th colspan="2">Jawaban</th>
                <th rowspan="2" width="25%">Komentar</th>
            </tr>
            <tr>
                <th>Yes</th>
                <th>No</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($pertanyaan as $row) : ?>
                <tr>
                    <td>
                        <?= $i; ?>
                    </td>
                    <td>
                        <?= $pertanyaan[$i - 1]["pertanyaan"]; ?>
                    </td>
                    <?php $jwb[$i - 1][0] == "&#9745" ? $warnaYes = "green" : $warnaYes = "red"; ?>
                    <td style="font-size:30px;color:<?= $warnaYes; ?>;">
                        <?= $jwb[$i - 1][0]; ?>
                    </td>
                    <?php $jwb[$i - 1][1] == "&#9745" ? $warnaNo = "green" : $warnaNo = "red"; ?>
                    <td style="font-size:30px;color:<?= $warnaNo; ?>;">
                        <?= $jwb[$i - 1][1]; ?>
                    </td>
                    <td>
                        <?= $komen["komen" . $i]; ?>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach ?>
        </table>
    </div>
    <br>
    <b>CATATAN :</b> <?= $checklist["catatan"]; ?><br><br>
    <div class="table">
        <table>
            <tr>
                <td>
                    <table border="0" cellpadding="10" cellspacing="0">
                        <tr>
                            <td colspan="2">Jeneponto, <?= $checklist["tanggal"]; ?></td>
                        </tr>
                        <tr>
                            <td class="ttd">
                                <div>
                                    <p><?= $atasan[0]['jabatan']; ?></p>
                                    <div><?= $ttdAtasan[0]; ?></div>
                                    <p><?= $atasan[0]['nama']; ?></p>
                                    <hr style="width:60%; color:black; margin:1px;">
                                    <p><?= $atasan[0]['nip']; ?></p>
                                </div>
                            </td>
                            <td class="ttd">

                                <p>pegawai <?= $pegawai[0]['bidang']; ?></p>
                                <?php if (count($pegawai) == 1) : ?>
                                    <div>
                                        <div><?= $ttdPegawai[0]; ?></div>
                                        <p><?= $pegawai[0]["fullname"]; ?></p>
                                        <hr style="width:60%; color:black; margin:1px;">
                                        <p><?= $pegawai[0]["username"]; ?></p>
                                    </div>
                                <?php endif ?>

                                <?php if (count($pegawai) > 1) : ?>
                                    <div>
                                        <?php $i = 0 ?>
                                        <?php foreach ($pegawai as $peg) : ?>
                                            <span><?= $ttdPegawai[$i]; ?></span>
                                            <?php $i++ ?>
                                        <?php endforeach ?>
                                        <br>
                                        <?= $cetakPelaksana; ?>
                                    </div>
                                <?php endif ?>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>