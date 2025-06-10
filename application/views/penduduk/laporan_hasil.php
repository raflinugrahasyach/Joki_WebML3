<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Klasifikasi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h3, .header p { margin: 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { width: 35%; background-color: #f8f9fc; }
        .result { font-weight: bold; font-size: 1.2em; }
    </style>
</head>
<body>
    <div class="header">
        <h3>HASIL KLASIFIKASI PENDUDUK</h3>
        <p>Berdasarkan Metode Support Vector Machine</p>
    </div>
    <h3>Data Diri</h3>
    <table>
        <tr>
            <th>NIK</th>
            <td>'<?= $penduduk['nik']; ?></td>
        </tr>
        <tr>
            <th>Nama Lengkap</th>
            <td><?= $penduduk['nama']; ?></td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td><?= date('d F Y', strtotime($penduduk['tgl_lahir'])); ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?= $penduduk['alamat']; ?></td>
        </tr>
         <tr>
            <th>RT/RW</th>
            <td><?= $penduduk['rt_rw']; ?></td>
        </tr>
    </table>
    <br>
    <h3>Hasil Akhir</h3>
    <table>
        <tr>
            <th>Tanggal Klasifikasi</th>
            <td><?= date('d F Y, H:i:s', strtotime($penduduk['tanggal_klasifikasi'])); ?></td>
        </tr>
        <tr>
            <th class="result">Status Klasifikasi</th>
            <td class="result"><?= strtoupper($penduduk['kelas']); ?></td>
        </tr>
    </table>
</body>
</html>