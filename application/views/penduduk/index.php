<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>
    <p class="mb-4">Daftar penduduk yang telah melalui proses klasifikasi.</p>

    <?php if ($this->session->flashdata('flash')): ?>
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data penduduk berhasil <strong><?= $this->session->flashdata('flash'); ?></strong>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Penduduk</h6>
            <a href="<?= base_url('penduduk/laporan'); ?>" class="btn btn-success btn-sm" target="_blank"><i class="fas fa-print fa-sm"></i> Generate Report</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Hasil Klasifikasi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($penduduk as $p): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p['nik']; ?></td>
                            <td><?= $p['nama']; ?></td>
                            <td><?= $p['alamat']; ?></td>
                            <td>
                                <?php if($p['kelas'] == 'Miskin'): ?>
                                    <span class="badge badge-danger"><?= $p['kelas']; ?></span>
                                <?php elseif($p['kelas'] == 'Tidak Miskin'): ?>
                                    <span class="badge badge-success"><?= $p['kelas']; ?></span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Belum diklasifikasi</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $p['tanggal_klasifikasi'] ? date('d-m-Y', strtotime($p['tanggal_klasifikasi'])) : '-'; ?></td>
                            <td>
                                <a href="<?= base_url('penduduk/detail/') . $p['nik']; ?>" class="btn btn-info btn-circle btn-sm" title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="<?= base_url('penduduk/ubah/') . $p['nik']; ?>" class="btn btn-warning btn-circle btn-sm" title="Ubah">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('penduduk/hapus/') . $p['nik']; ?>" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="<?= base_url('penduduk/laporanhasil/') . $p['nik']; ?>" class="btn btn-secondary btn-circle btn-sm" title="Cetak Hasil" target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>