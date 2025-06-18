<?php
// Definisikan pemetaan nilai ke teks agar mudah dibaca
$map_jenis_kelamin = [1 => 'Laki-laki', 2 => 'Perempuan'];
$map_pendidikan = [1 => 'Tidak Sekolah', 2 => 'SD', 3 => 'SMP', 4 => 'SMA', 5 => 'Perguruan Tinggi'];
$map_pekerjaan = [1 => 'Tidak Bekerja', 2 => 'Petani', 3 => 'Buruh', 4 => 'Wiraswasta', 5 => 'PNS/TNI/Polri'];
$map_perkawinan = [1 => 'Belum Kawin', 2 => 'Kawin', 3 => 'Janda/Duda'];
$map_lantai = [1 => 'Tanah', 2 => 'Semen/plester', 3 => 'Keramik/lainnya'];
$map_dinding = [1 => 'Bambu/kayu', 2 => 'Tembok'];
$map_listrik = [1 => 'Tanpa Listrik', 2 => '450 Watt', 3 => '900 Watt', 4 => '>900 Watt'];
$map_air = [1 => 'Sumur', 2 => 'Sungai/mata air', 3 => 'PDAM'];
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Lengkap: <?= htmlspecialchars($penduduk['nama']); ?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Data Diri</h5>
                    <table class="table table-bordered">
                        <tr><th>NIK</th><td><?= htmlspecialchars($penduduk['nik']); ?></td></tr>
                        <tr><th>Nama</th><td><?= htmlspecialchars($penduduk['nama']); ?></td></tr>
                        <tr><th>Tanggal Lahir</th><td><?= date('d F Y', strtotime($penduduk['tgl_lahir'])); ?></td></tr>
                        <tr><th>Alamat</th><td><?= htmlspecialchars($penduduk['alamat']); ?></td></tr>
                        <tr><th>RT/RW</th><td><?= htmlspecialchars($penduduk['rt_rw']); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Data Variabel Klasifikasi</h5>
                    <table class="table table-bordered">
                        <tr><th>Jenis Kelamin</th><td><?= isset($penduduk['jenis_kelamin']) ? $map_jenis_kelamin[$penduduk['jenis_kelamin']] : '-'; ?></td></tr>
                        <tr><th>Pendidikan</th><td><?= isset($penduduk['pendidikan']) ? $map_pendidikan[$penduduk['pendidikan']] : '-'; ?></td></tr>
                        <tr><th>Pekerjaan</th><td><?= isset($penduduk['pekerjaan']) ? $map_pekerjaan[$penduduk['pekerjaan']] : '-'; ?></td></tr>
                        <tr><th>Status Perkawinan</th><td><?= isset($penduduk['status_perkawinan']) ? $map_perkawinan[$penduduk['status_perkawinan']] : '-'; ?></td></tr>
                        <tr><th>Jumlah Anak Sekolah</th><td><?= isset($penduduk['anak_sekolah']) ? htmlspecialchars($penduduk['anak_sekolah']) : '-'; ?></td></tr>
                        <tr><th>Lantai Rumah</th><td><?= isset($penduduk['lantai_rumah']) ? $map_lantai[$penduduk['lantai_rumah']] : '-'; ?></td></tr>
                        <tr><th>Dinding Rumah</th><td><?= isset($penduduk['dinding_rumah']) ? $map_dinding[$penduduk['dinding_rumah']] : '-'; ?></td></tr>
                        <tr><th>Daya Listrik</th><td><?= isset($penduduk['daya_listrik']) ? $map_listrik[$penduduk['daya_listrik']] : '-'; ?></td></tr>
                        <tr><th>Sumber Air</th><td><?= isset($penduduk['sumber_air']) ? $map_air[$penduduk['sumber_air']] : '-'; ?></td></tr>
                    </table>
                </div>
            </div>
            <hr>
            <h5>Hasil Akhir</h5>
            <table class="table table-bordered" style="width:50%;">
                <tr>
                    <th>Hasil Klasifikasi</th>
                    <td>
                        <?php if (isset($penduduk['kelas'])) : ?>
                            <span class="font-weight-bold text-<?= $penduduk['kelas'] == 'Miskin' ? 'danger' : 'success'; ?>">
                                <?= htmlspecialchars($penduduk['kelas']); ?>
                            </span>
                        <?php else : echo '-'; endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Klasifikasi</th>
                    <td><?= isset($penduduk['tanggal_klasifikasi']) ? date('d F Y, H:i:s', strtotime($penduduk['tanggal_klasifikasi'])) : '-'; ?></td>
                </tr>
            </table>
            <br>
            <a href="<?= base_url('penduduk'); ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
