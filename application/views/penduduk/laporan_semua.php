<!DOCTYPE html>
<html><head>
    <title>Laporan Data Penduduk</title>
    <style>
        body {
            font-family: sans-serif;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head><body>
    <h1>Daftar Seluruh Penduduk</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Status Kemiskinan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($penduduk as $p) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p['nik']; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td>
                        <?php
                        // Cek jika data jenis kelamin ada (dari tabel klasifikasi)
                        if (isset($p['jenis_kelamin']) && $p['jenis_kelamin'] !== null) {
                            echo ($p['jenis_kelamin'] == 1) ? 'Laki-laki' : 'Perempuan';
                        } else {
                            echo '-'; // Tampilkan strip jika belum ada data
                        }
                        ?>
                    </td>
                    <td><?= $p['alamat']; ?></td>
                    <td>
                        <?php
                        // Cek jika status kemiskinan ada (dari tabel hasil)
                        if (isset($p['status_kemiskinan']) && $p['status_kemiskinan'] !== null) {
                            echo $p['status_kemiskinan'];
                        } else {
                            echo 'Belum Diklasifikasi';
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body></html>
