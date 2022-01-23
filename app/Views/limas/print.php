<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>print lima es</title>
    <link rel="stylesheet" href="css/limaS.css">
</head>

<body>
    <br><br>
    <p class="center bold size12 my0">PELAKSANAAN 5S</p>

    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td class="bold biru" colspan="6">INFORMASI</td>
        </tr>
        <tr>
            <td class="bold biruMuda" colspan="2">Satuan Kerja<br><br>OPERASI</td>
            <td class="bold biruMuda besar" colspan="2">NAMA PELAKSANA<br><br><?= $pegawai['fullname']; ?></td>
            <td class="bold biruMuda">Area / Lokasi Kerja<br><br><?= $limas['area']; ?></td>
            <td class="bold biruMuda" width="120px">WAKTU<br><br><?= date('H:i', strtotime($limas['tanggal'])); ?></td>
        </tr>
        <tr>
            <td class="bold biru" colspan="6">PENDAHULUAN</td>
        </tr>
        <tr>
            <td class="bold biruMuda" colspan="2">Tujuan</td>
            <td colspan="4">Menjadi kegiatan rutin operator yang membudaya, terjadwal dan termonitoring</td>
        </tr>
        <tr>
            <td class="bold biruMuda" colspan="2">Sasaran</td>
            <td colspan="4">Membersihkan debu, tetesan oli, dan membuang sampah yang ada di sekitar peralatan <?= $limas['namaPeralatan']; ?></td>
        </tr>
        <tr>
            <td class="bold biru" colspan="6">PENILAIAN</td>
        </tr>
        <tr>
            <td class="bold biruMuda" width="30px" text-rotate="90" rowspan="2">LEVEL</td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
        </tr>
        <tr>
            <td>Belum memulai kegiatan 5S, tidak ada usaha sama sekali.</td>
            <td>Sudah memulai kegiatan 5S, tetapi ada banyak perbaikan major <i>(perbaikan perlu beberapa hari)</i></td>
            <td>Cukup baik, hanya perlu beberapa improvement minor <i>(bisa langsung saat itu memperbaiki kondisi)</i></td>
            <td>sudah baik, hanya perlu sedikit improvement</td>
            <td>Sudah sangat baik, terus pertahankan kondisi seperti ini</td>
        </tr>
        <tr>
            <td class="bold orangeMuda" colspan="2">URAIAN</td>
            <td class="bold orangeMuda">CHECK ITEM</td>
            <td class="bold orangeMuda" colspan="2">DESKRIPSI</td>
            <td class="bold orangeMuda">NILAI 1 - 5</td>
        </tr>
        <tr>
            <td class="bold biruMuda" text-rotate="90" rowspan="5">PELAKSANAAN 5S</td>
            <td class="biruMuda">STEP 1: Seiri, Ringkasi<br>Merupakan kegiatan memilih dan membuang barang atau file yang tidak diperlukan lagi</td>

            <td class="orangeMuda" rowspan="5" colspan="4">
                <table width="100%" border="1" cellpadding="1" cellspacing="0">

                    <?php for ($i = 1; $i <= 25; $i++) : ?>
                        <tr>
                            <td class="left white" width="127px"><?= $checkItem[$i - 1]; ?></td>
                            <td class="left white"><?= $pertanyaan[$i - 1]['pertanyaan']; ?></td>
                            <td width="116px" class="white"><?= $nilaiLimas['nilai' . $i]; ?></td>
                        </tr>
                    <?php endfor; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td class="biruMuda">STEP 2: Seiton, Rapih<br>Merupakan kegiatan merapihkan semua barang dan file</td>
        </tr>
        <tr>
            <td class="biruMuda">STEP 3: Seiso, Resik<br>Merupakan kegiatan membersihkan tempat kerja, ruangan kerja, dan lingkungan kerja secara rutin</td>
        </tr>
        <tr>
            <td class="biruMuda">STEP 4: Seiketsu, Rawat<br>Merupakan kegiatan perawatan atau maintenance terhadap kegiatan Seiri, Seiton, dan Seiso</td>
        </tr>
        <tr>
            <td class="biruMuda">STEP 5: Shitsuke, Rajin<br>Merupakan suatu kebiasaan dan pemeliharaan program 5S yang sudah berjalan</td>
        </tr>
        <tr>
            <td class="bold biruMuda" text-rotate="90" rowspan="2">DOKUMENTASI</td>
            <td class="bold orangeMuda" colspan="2">KONDISI SEBELUM</td>
            <td class="bold orangeMuda" colspan="3">KONDISI SETELAH</td>
        </tr>
        <tr>
            <td colspan="2"><img src="img-5s/<?= $limas['fotoSebelum']; ?>" width=" 120px" max-height="90px"></td>
            <td colspan="3"><img src="img-5s/<?= $limas['fotoSetelah']; ?>" width=" 140px" max-height="90px"></td>
        </tr>
        <tr>
            <td class="bold biruMuda" text-rotate="90">CATATAN</td>
            <td class="left" colspan="5"><?= $limas['saran']; ?></td>
        </tr>
    </table>
    <table class="size12" width="100%" border="0" cellpadding="10" cellspacing="0">
        <tr>
            <td class="left" colspan="2">Jeneponto, <?= date('d-m-Y', strtotime($limas['tanggal'])); ?></td>
        </tr>
        <tr>
            <td class="ttd">
                <div>
                    <p><?= $atasan['jabatan']; ?></p>
                    <div><?= $ttd[0]; ?></div>
                    <p><?= $atasan['nama']; ?></p>
                    <hr style="width:60%; color:black; margin:1px;">
                    <p><?= $atasan['nip']; ?></p>
                </div>
            </td>
            <td class="ttd">
                <div>
                    <p>pegawai <?= $pegawai['bidang']; ?></p>
                    <div><?= $ttd[1]; ?></div>
                    <p><?= $pegawai['fullname']; ?></p>
                    <hr style="width:60%; color:black; margin:1px;">
                    <p><?= $pegawai['username']; ?></p>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>