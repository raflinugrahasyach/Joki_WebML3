<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <!-- Menampilkan error validasi -->
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('penduduk/ubah/' . $penduduk['nik']); ?>" method="post">
                <p class="font-italic text-info">Catatan: Halaman ini hanya untuk mengubah data diri penduduk. Data kriteria klasifikasi tidak dapat diubah.</p>
                <hr>
                
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" name="nik" class="form-control" id="nik" value="<?= $penduduk['nik']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $penduduk['nama']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" value="<?= $penduduk['tgl_lahir']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" id="alamat" required><?= $penduduk['alamat']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="rt_rw">RT/RW</label>
                    <input type="text" name="rt_rw" class="form-control" id="rt_rw" value="<?= $penduduk['rt_rw']; ?>" required>
                </div>
                
                <hr>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="<?= base_url('penduduk'); ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
