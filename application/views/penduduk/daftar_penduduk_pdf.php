<!DOCTYPE html>
<html><head><title>Laporan Daftar Penduduk</title>
<style>
    body{ font-family: sans-serif; }
    table{ width: 100%; border-collapse: collapse; }
    table, th, td{ border: 1px solid black; }
    th, td{ padding: 8px; text-align: left; }
    h3{ text-align: center; }
</style>
</head><body>
<h3>DAFTAR PENDUDUK HASIL KLASIFIKASI</h3>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Hasil Klasifikasi</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach($penduduk as $p): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $p['nik']; ?></td>
            <td><?= $p['nama']; ?></td>
            <td><?= $p['alamat']; ?></td>
            <td><?= $p['kelas']; ?></td>
            <td><?= date('d-m-Y', strtotime($p['tanggal_klasifikasi'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body></html>