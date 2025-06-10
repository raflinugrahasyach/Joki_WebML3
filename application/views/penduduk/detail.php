<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Lengkap: <?= $penduduk['nama']; ?></h6>
        </div>
        <div class="card-body">
            <h5>Data Diri</h5>
            <table class="table table-striped table-bordered">
                <tr><th width="30%">NIK</th><td><?= $penduduk['nik']; ?></td></tr>
                <tr><th>Nama</th><td><?= $penduduk['nama']; ?></td></tr>
                <tr><th>Tanggal Lahir</th><td><?= date('d F Y', strtotime($penduduk['tgl_lahir'])); ?></td></tr>
                <tr><th>Alamat</th><td><?= $penduduk['alamat']; ?></td></tr>
                <tr><th>RT/RW</th><td><?= $penduduk['rt_rw']; ?></td></tr>
            </table>

            <h5 class="mt-4">Data Variabel Klasifikasi</h5>
            <table class="table table-striped table-bordered">
                <tr><th width="30%">Jenis Kelamin</th><td><?= $penduduk['j_kelamin'] == 1 ? 'Laki-laki' : 'Perempuan'; ?></td></tr>
                <tr><th>Pendidikan</th><td>
                    <?php 
                        $pendidikan = ['1' => 'Perguruan Tinggi', '2' => 'SLTA', '3' => 'SLTP', '4' => 'SD'];
                        echo $pendidikan[$penduduk['pendidikan']];
                    ?>
                </td></tr>
                <tr><th>Pekerjaan</th><td>
                    <?php 
                        $pekerjaan = ['1' => 'Pegawai/Karyawan', '2' => 'Dagang', '3' => 'Tani', '4' => 'Buruh', '5' => 'Tidak Bekerja'];
                        echo $pekerjaan[$penduduk['pekerjaan']];
                    ?>
                </td></tr>
                 <tr><th>Jumlah Anak Sekolah</th><td><?= $penduduk['anak_sekolah']; ?></td></tr>
                <tr><th>...</th><td>...</td></tr>
            </table>
            
             <h5 class="mt-4">Hasil Akhir</h5>
             <table class="table table-striped table-bordered">
                <tr><th width="30%">Hasil Klasifikasi</th>
                    <td class="font-weight-bold <?= $penduduk['kelas'] == 'Miskin' ? 'text-danger' : 'text-success' ?>">
                        <?= $penduduk['kelas']; ?>
                    </td>
                </tr>
                <tr><th>Tanggal Klasifikasi</th><td><?= date('d F Y, H:i:s', strtotime($penduduk['tanggal_klasifikasi'])); ?></td></tr>
            </table>

            <a href="<?= base_url('penduduk'); ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

</div>