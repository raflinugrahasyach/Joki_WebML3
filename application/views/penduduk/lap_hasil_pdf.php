<!DOCTYPE html>
<html><head>
    <title>Laporan Hasil Klasifikasi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
    </style>
</head><body>

    <h1>Laporan Hasil Klasifikasi Penduduk</h1>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Hasil Klasifikasi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($penduduk as $p) :
            ?>
                <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td><?php echo $p['nik']; ?></td>
                    <td><?php echo $p['nama']; ?></td>
                    <td><?php echo $p['jenis_kelamin']; ?></td>
                    <td><?php echo $p['hasil_klasifikasi']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body></html>