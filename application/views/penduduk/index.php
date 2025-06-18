<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <a href="<?= base_url('penduduk/tambah'); ?>" class="btn btn-primary mb-3">Tambah Data</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Status Kemiskinan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($penduduk as $p) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p['nik']; ?></td>
                            <td><?= $p['nama']; ?></td>
                            <td><?= $p['alamat']; ?></td>
                            <td>
                                <?php if (!empty($p['status_kemiskinan'])) : ?>
                                    <span class="badge <?= $p['status_kemiskinan'] == 'Miskin' ? 'badge-danger' : 'badge-success'; ?>">
                                        <?= $p['status_kemiskinan']; ?>
                                    </span>
                                <?php else : ?>
                                    <span class="badge badge-secondary">Belum Diklasifikasi</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('penduduk/detail/') . $p['nik']; ?>" class="btn btn-sm btn-info">Detail</a>
                                <a href="<?= base_url('penduduk/ubah/') . $p['nik']; ?>" class="btn btn-sm btn-warning">Ubah</a>
                                <a href="<?= base_url('penduduk/hapus/') . $p['nik']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>