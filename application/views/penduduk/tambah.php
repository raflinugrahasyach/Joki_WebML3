<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $judul; ?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            
            <?php if(validation_errors()): ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('flash-error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= $this->session->flashdata('flash-error'); ?>
            </div>
            <?php endif; ?>
            
            <form action="<?= base_url('penduduk/tambah') ?>" method="post">
                
                <h5 class="mt-4 mb-3">Data Diri Penduduk</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" class="form-control" id="nik" placeholder="16 digit NIK">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="rt_rw">RT/RW</label>
                            <input type="text" name="rt_rw" class="form-control" id="rt_rw" placeholder="Contoh: 001/002">
                        </div>
                    </div>
                </div>

                <hr>
                <h5 class="mt-4 mb-3">Variabel Klasifikasi</h5>
                <p class="text-muted">Isi data berikut sesuai dengan kondisi sebenarnya untuk proses klasifikasi.</p>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="j_kelamin">Jenis Kelamin</label>
                            <select name="j_kelamin" id="j_kelamin" class="form-control">
                                <option value="1">Laki-laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pendidikan">Pendidikan Terakhir</label>
                            <select name="pendidikan" id="pendidikan" class="form-control">
                                <option value="1">Perguruan Tinggi</option>
                                <option value="2">SLTA</option>
                                <option value="3">SLTP</option>
                                <option value="4">SD</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sumber_air">Sumber Air</label>
                            <select name="sumber_air" id="sumber_air" class="form-control">
                                <option value="1">PAM/Berbayar</option>
                                <option value="2">Sumur</option>
                                <option value="3">Mata Air/Sungai</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <select name="pekerjaan" id="pekerjaan" class="form-control">
                                <option value="1">Pegawai/Karyawan</option>
                                <option value="2">Dagang</option>
                                <option value="3">Tani</option>
                                <option value="4">Buruh</option>
                                <option value="5">Tidak Bekerja</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="s_kawin">Status Perkawinan</label>
                            <select name="s_kawin" id="s_kawin" class="form-control">
                                <option value="1">Kawin</option>
                                <option value="2">Duda</option>
                                <option value="3">Janda</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="anak_sekolah">Jumlah Anak Sekolah (Tanggungan)</label>
                            <input type="number" name="anak_sekolah" class="form-control" id="anak_sekolah" value="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lt_rumah">Lantai Rumah</label>
                            <select name="lt_rumah" id="lt_rumah" class="form-control">
                                <option value="1">Keramik</option>
                                <option value="2">Tembok</option>
                                <option value="3">Kayu/Bambu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="din_rumah">Dinding Rumah</label>
                            <select name="din_rumah" id="din_rumah" class="form-control">
                                <option value="1">Tembok</option>
                                <option value="2">Semi-Tembok</option>
                                <option value="3">Kayu/Bambu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dy_listrik">Daya Listrik</label>
                            <select name="dy_listrik" id="dy_listrik" class="form-control">
                                <option value="1">900 VA</option>
                                <option value="2">450 VA</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="<?= base_url('penduduk') ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Proses Klasifikasi</button>
                </div>

            </form>
        </div>
    </div>
</div>