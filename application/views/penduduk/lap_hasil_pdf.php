<!DOCTYPE html>
<html><head><title>Laporan Hasil Klasifikasi</title>
<style>
    body{ font-family: sans-serif; }
    table{ width: 100%; border-collapse: collapse; border: 1px solid black;}
    th, td{ padding: 8px; text-align: left; border: 1px solid black; }
    h3{ text-align: center; }
    .font-weight-bold { font-weight: bold; }
</style>
</head><body>
<h3>HASIL KLASIFIKASI PENDUDUK</h3>
<table>
    <tr><th width="30%">NIK</th><td><?= $penduduk['nik']; ?></td></tr>
    <tr><th>Nama Lengkap</th><td><?= $penduduk['nama']; ?></td></tr>
    <tr><th>Tanggal Lahir</th><td><?= date('d F Y', strtotime($penduduk['tgl_lahir'])); ?></td></tr>
    <tr><th>Alamat</th><td><?= $penduduk['alamat']; ?></td></tr>
    <tr><th>RT/RW</th><td><?= $penduduk['rt_rw']; ?></td></tr>
    <tr><th>Tanggal Klasifikasi</th><td><?= date('d F Y, H:i:s', strtotime($penduduk['tanggal_klasifikasi'])); ?></td></tr>
    <tr><th class="font-weight-bold">Hasil Akhir</th><td class="font-weight-bold"><?= strtoupper($penduduk['kelas']); ?></td></tr>
</table>
</body></html>