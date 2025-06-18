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
            <?php if ($this->session->flashdata('flash-error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->flashdata('flash-error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('penduduk/proses_tambah'); ?>" method="post">
                <div class="row">
                    <!-- Kolom Data Diri Penduduk -->
                    <div class="col-md-6">
                        <h5>Data Diri Penduduk</h5>
                        <hr>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" class="form-control" id="nik" value="<?= set_value('nik'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="<?= set_value('nama'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" value="<?= set_value('tgl_lahir'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" id="alamat" required><?= set_value('alamat'); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="rt_rw">RT/RW</label>
                            <input type="text" name="rt_rw" class="form-control" id="rt_rw" value="<?= set_value('rt_rw'); ?>" required>
                        </div>
                    </div>

                    <!-- Kolom Kriteria Klasifikasi -->
                    <div class="col-md-6">
                        <h5>Kriteria Klasifikasi Kemiskinan</h5>
                        <hr>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required><option value="1">Laki-laki</option><option value="2">Perempuan</option></select>
                        </div>
                        <div class="form-group">
                            <label>Pendidikan Terakhir</label>
                            <select name="pendidikan" class="form-control" required><option value="">-- Pilih --</option><option value="1">Perguruan Tinggi</option><option value="2">SLTA</option><option value="3">SLTP</option><option value="4">SD</option></select>
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <select name="pekerjaan" class="form-control" required><option value="">-- Pilih --</option><option value="1">Pegawai/Karyawan</option><option value="2">Dagang</option><option value="3">Tani</option><option value="4">Buruh</option><option value="5">Tidak Bekerja</option></select>
                        </div>
                        <div class="form-group">
                            <label>Status Perkawinan</label>
                            <select name="status_perkawinan" class="form-control" required><option value="">-- Pilih --</option><option value="1">Kawin</option><option value="2">Duda</option><option value="3">Janda</option></select>
                        </div>
                        <!-- PERBAIKAN FINAL: Nama input 'name' diselaraskan menjadi "tanggungan_anak" -->
                        <div class="form-group">
                             <label for="tanggungan_anak">Tanggungan Anak (Anak Sekolah)</label>
                             <input type="number" name="tanggungan_anak" class="form-control" id="tanggungan_anak" value="<?= set_value('tanggungan_anak', 0); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Lantai Rumah</label>
                            <select name="lantai_rumah" class="form-control" required><option value="">-- Pilih --</option><option value="1">Keramik</option><option value="2">Tembok</option><option value="3">Kayu/bambu</option></select>
                        </div>
                        <div class="form-group">
                            <label>Dinding Rumah</label>
                            <select name="dinding_rumah" class="form-control" required><option value="">-- Pilih --</option><option value="1">Tembok</option><option value="2">Semi-tembok</option><option value="3">Kayu/bambu</option></select>
                        </div>
                        <div class="form-group">
                            <label>Daya Listrik</label>
                            <select name="daya_listrik" class="form-control" required><option value="">-- Pilih --</option><option value="1">900</option><option value="2">450</option></select>
                        </div>
                        <div class="form-group">
                            <label>Sumber Air</label>
                            <select name="sumber_air" class="form-control" required><option value="">-- Pilih --</option><option value="1">PAM/berbayar</option><option value="2">Sumur</option><option value="3">Mata air/sungai</option></select>
                        </div>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary btn-lg">Simpan & Klasifikasi</button>
                <a href="<?= base_url('penduduk'); ?>" class="btn btn-secondary btn-lg">Batal</a>
            </form>
        </div>
    </div>
</div>
