<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $judul; ?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            
            <form action="<?= base_url('penduduk/ubah/' . $penduduk['nik']) ?>" method="post">
                <input type="hidden" name="nik" value="<?= $penduduk['nik']; ?>">
                
                <h5 class="mt-4 mb-3">Data Diri Penduduk</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik_display">NIK</label>
                            <input type="text" class="form-control" id="nik_display" value="<?= $penduduk['nik']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="<?= $penduduk['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" value="<?= $penduduk['tgl_lahir']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control"><?= $penduduk['alamat']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="rt_rw">RT/RW</label>
                            <input type="text" name="rt_rw" class="form-control" id="rt_rw" value="<?= $penduduk['rt_rw']; ?>">
                        </div>
                    </div>
                </div>

                <hr>
                <h5 class="mt-4 mb-3">Variabel Klasifikasi</h5>
                <p class="text-muted">Ubah data berikut jika ada perubahan kondisi untuk memperbarui hasil klasifikasi.</p>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="j_kelamin">Jenis Kelamin</label>
                            <select name="j_kelamin" id="j_kelamin" class="form-control">
                                <option value="1" <?= $penduduk['j_kelamin'] == 1 ? 'selected' : ''; ?>>Laki-laki</option>
                                <option value="2" <?= $penduduk['j_kelamin'] == 2 ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pendidikan">Pendidikan Terakhir</label>
                            <select name="pendidikan" id="pendidikan" class="form-control">
                                <option value="1" <?= $penduduk['pendidikan'] == 1 ? 'selected' : ''; ?>>Perguruan Tinggi</option>
                                <option value="2" <?= $penduduk['pendidikan'] == 2 ? 'selected' : ''; ?>>SLTA</option>
                                <option value="3" <?= $penduduk['pendidikan'] == 3 ? 'selected' : ''; ?>>SLTP</option>
                                <option value="4" <?= $penduduk['pendidikan'] == 4 ? 'selected' : ''; ?>>SD</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sumber_air">Sumber Air</label>
                            <select name="sumber_air" id="sumber_air" class="form-control">
                                <option value="1" <?= $penduduk['sumber_air'] == 1 ? 'selected' : ''; ?>>PAM/Berbayar</option>
                                <option value="2" <?= $penduduk['sumber_air'] == 2 ? 'selected' : ''; ?>>Sumur</option>
                                <option value="3" <?= $penduduk['sumber_air'] == 3 ? 'selected' : ''; ?>>Mata Air/Sungai</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <select name="pekerjaan" id="pekerjaan" class="form-control">
                                <option value="1" <?= $penduduk['pekerjaan'] == 1 ? 'selected' : ''; ?>>Pegawai/Karyawan</option>
                                <option value="2" <?= $penduduk['pekerjaan'] == 2 ? 'selected' : ''; ?>>Dagang</option>
                                <option value="3" <?= $penduduk['pekerjaan'] == 3 ? 'selected' : ''; ?>>Tani</option>
                                <option value="4" <?= $penduduk['pekerjaan'] == 4 ? 'selected' : ''; ?>>Buruh</option>
                                <option value="5" <?= $penduduk['pekerjaan'] == 5 ? 'selected' : ''; ?>>Tidak Bekerja</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="s_kawin">Status Perkawinan</label>
                            <select name="s_kawin" id="s_kawin" class="form-control">
                                <option value="1" <?= $penduduk['s_kawin'] == 1 ? 'selected' : ''; ?>>Kawin</option>
                                <option value="2" <?= $penduduk['s_kawin'] == 2 ? 'selected' : ''; ?>>Duda</option>
                                <option value="3" <?= $penduduk['s_kawin'] == 3 ? 'selected' : ''; ?>>Janda</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="anak_sekolah">Jumlah Anak Sekolah (Tanggungan)</label>
                            <input type="number" name="anak_sekolah" class="form-control" id="anak_sekolah" value="<?= $penduduk['anak_sekolah']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lt_rumah">Lantai Rumah</label>
                            <select name="lt_rumah" id="lt_rumah" class="form-control">
                                <option value="1" <?= $penduduk['lt_rumah'] == 1 ? 'selected' : ''; ?>>Keramik</option>
                                <option value="2" <?= $penduduk['lt_rumah'] == 2 ? 'selected' : ''; ?>>Tembok</option>
                                <option value="3" <?= $penduduk['lt_rumah'] == 3 ? 'selected' : ''; ?>>Kayu/Bambu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="din_rumah">Dinding Rumah</label>
                            <select name="din_rumah" id="din_rumah" class="form-control">
                                <option value="1" <?= $penduduk['din_rumah'] == 1 ? 'selected' : ''; ?>>Tembok</option>
                                <option value="2" <?= $penduduk['din_rumah'] == 2 ? 'selected' : ''; ?>>Semi-Tembok</option>
                                <option value="3" <?= $penduduk['din_rumah'] == 3 ? 'selected' : ''; ?>>Kayu/Bambu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dy_listrik">Daya Listrik</label>
                            <select name="dy_listrik" id="dy_listrik" class="form-control">
                                <option value="1" <?= $penduduk['dy_listrik'] == 1 ? 'selected' : ''; ?>>900 VA</option>
                                <option value="2" <?= $penduduk['dy_listrik'] == 2 ? 'selected' : ''; ?>>450 VA</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="<?= base_url('penduduk') ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary float-right">Simpan Perubahan & Reklasifikasi</button>
                </div>

            </form>
        </div>
    </div>
</div>