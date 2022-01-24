<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>print service request</title>
    <link rel="stylesheet" href="css/cetakSrCm.css">
</head>

<body>
    <div style="border: 3px solid black; padding: 7px;" class="table">

        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <td>
                    <div class="dalam">
                        <table border="0" cellpadding="5" cellspacing="0">
                            <tr>
                                <td width="30%">Nomor SR</td>
                                <!-- <td>:</td> -->
                                <td colspan="5" width="70%">: <?= $serviceRequest['nomorSr']; ?></td>
                            </tr>
                            <tr>
                                <td>Hari</td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $daftarHari[date('l', strtotime($serviceRequest["tanggal"]))]; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= date('d-m-Y', strtotime($serviceRequest["tanggal"])); ?></td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= date('H:i', strtotime($serviceRequest["tanggal"])); ?> WITA</td>
                            </tr>
                            <tr>
                                <td>Unit</td>
                                <!-- <td>:</td> -->
                                <td class="right">#1</td>
                                <td style="font-size:30px;"><b><?= $unit["satu"]; ?></b></td>
                                <td class="right">#2</td>
                                <td style="font-size:30px;"><b><?= $unit["dua"]; ?></b></td>
                                <td style="font-size: 8px; font-style: italic;"><b>* dicentang</b></td>
                            </tr>
                            <tr>
                                <td>Area</td>
                                <!-- <td>:</td> -->
                                <td class="center">Boiler<br>
                                    <b style="font-size:30px;"><?= $area["boiler"]; ?></b>
                                </td>
                                <td class="center">Turbin<br>
                                    <b style="font-size:30px;"><?= $area["turbin"]; ?></b>
                                </td>
                                <td class="center">WTP<br>
                                    <b style="font-size:30px;"><?= $area["wtp"]; ?></b>
                                </td>
                                <td class="center">Electrical<br>
                                    <b style="font-size:30px;"><?= $area["electrical"]; ?></b>
                                </td>
                                <td style="font-size: 8px; font-style: italic;"><b>* dicentang</b></td>
                            </tr>
                            <tr>
                                <td>Nama Peralatan</td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["namaPeralatan"]; ?></td>
                            </tr>
                            <tr>
                                <td>No. KKS</td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["kks"]; ?></td>
                            </tr>
                            <tr>
                                <td>Uraian Gangguan</td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["uraianGangguan1"]; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["uraianGangguan1"]; ?></td>
                            </tr>
                            <tr>
                                <td>Normal Operasi</td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["normalOperasi1"]; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["normalOperasi2"]; ?></td>
                            </tr>
                            <tr>
                                <td>Indikasi/Gejala</td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["gejala1"]; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["gejala2"]; ?></td>
                            </tr>

                            <tr>
                                <td>Prioritas</td>
                                <!-- <td>:</td> -->
                                <td class="center">1<br>
                                    <b style="font-size:30px;"><?= $prioritas["emergency"]; ?></b>
                                </td>
                                <td class="center">2<br>
                                    <b style="font-size:30px;"><?= $prioritas["urgent"]; ?></b>
                                </td>
                                <td class="center">3<br>
                                    <b style="font-size:30px;"><?= $prioritas["normal"]; ?></b>
                                </td>
                                <td></td>
                                <td>
                                    <div style="font-size: 8px; font-style: italic;"><b>
                                            *(1) = emergency - hari yang sama<br>
                                            *(2) = urgent - 1 s/d 2 minggu<br>
                                            *(3) = normal - 2 s/d 4 minggu
                                        </b></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Akibat Kerusakan</td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["akibatKerusakan1"]; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["akibatKerusakan2"]; ?></td>
                            </tr>
                            <tr>
                                <td>Kemungkinan Dampak/Resiko</td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["kemungkinanDampak1"]; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["kemungkinanDampak2"]; ?></td>
                            </tr>
                            <tr>
                                <td>Tindakan Sementara</td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["tindakanSementara1"]; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["tindakanSementara2"]; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <!-- <td>:</td> -->
                                <td colspan="5">: <?= $serviceRequest["tindakanSementara3"]; ?></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <table border="0" cellpadding="10" cellspacing="0">
                        <tr>
                            <td colspan="2">Jeneponto, <?= date('d-m-Y', strtotime($serviceRequest["tanggal"])); ?></td>
                        </tr>
                        <tr>
                            <td class="ttd">
                                <div>
                                    <p><?= $atasan['jabatan']; ?></p>
                                    <div><?= $ttd[0]; ?></div>
                                    <p><?= $atasan['nama']; ?></p>
                                    <hr style="width:60%; color:black; margin:1px;">
                                    <p><?= $atasan["nip"]; ?></p>
                                </div>
                            </td>
                            <td class="ttd">
                                <div>
                                    <p>pegawai <?= $pegawai['bidang']; ?></p>
                                    <div><?= $ttd[1]; ?></div>
                                    <p><?= $pegawai["fullname"]; ?></p>
                                    <hr style="width:60%; color:black; margin:1px;">
                                    <p><?= $pegawai["username"]; ?></p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div><br>
    <div class="evidence">
        <table border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td class="center bold"><?= $evidence[0]; ?><br><br>
                    <img src="img-sr/<?= $fotoSR[0]; ?>" max-height="325px">
                </td>
            </tr>
            <?php if ($serviceRequest["ket"] == 'flm') : ?>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td class="center bold"><?= $evidence[1]; ?><br><br>
                        <img src="img-sr/<?= $fotoSR[1]; ?>" max-height="325px">
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>