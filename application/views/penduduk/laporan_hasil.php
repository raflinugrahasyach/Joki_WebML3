<!DOCTYPE html>
<html>
<head><title><?= $judul; ?></title></head>
<body>
  <h2><?= $judul; ?></h2>
  <p><strong>NIK:</strong> <?= $penduduk['nik']; ?></p>
  <p><strong>Nama:</strong> <?= $penduduk['nama']; ?></p>
  <p><strong>Kelas:</strong> <?= $hasil['kelas']; ?></p>
  <p><strong>Akurasi Model:</strong> <?= round($hasil['akurasi']*100,2); ?> %</p>
  <p><strong>Tanggal:</strong> <?= date('d-m-Y H:i', strtotime($hasil['tanggal_klasifikasi'])); ?></p>
</body>
</html>
