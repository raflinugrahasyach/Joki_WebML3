<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $judul; ?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Hasil Klasifikasi untuk NIK: <?= $nik; ?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Nama Lengkap</th>
                            <td><?= $nama; ?></td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td><?= $nik; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td><?= date('d F Y', strtotime($tgl_lahir)); ?></td>
                        </tr>
                         <tr>
                            <th>Alamat</th>
                            <td><?= $alamat; ?></td>
                        </tr>
                         <tr>
                            <th>RT/RW</th>
                            <td><?= $rt_rw; ?></td>
                        </tr>
                        <tr>
                            <th>Hasil Klasifikasi</th>
                            <td>
                                <?php if($kelas == 'Miskin'): ?>
                                    <h4 class="font-weight-bold text-danger"><?= $kelas; ?></h4>
                                <?php else: ?>
                                    <h4 class="font-weight-bold text-success"><?= $kelas; ?></h4>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <a href="<?= base_url('penduduk'); ?>" class="btn btn-primary">Kembali ke Daftar Penduduk</a>
                </div>
            </div>
        </div>
    </div>
</div>