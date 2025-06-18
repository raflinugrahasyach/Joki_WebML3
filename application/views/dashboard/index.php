<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
    </div>

    <?php if($this->session->flashdata('pesan')): ?>
        <?php echo $this->session->flashdata('pesan'); ?>
    <?php endif; ?>
    <?php if($this->session->flashdata('message')): ?>
        <?php echo $this->session->flashdata('message'); ?>
    <?php endif; ?>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Data Penduduk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jumlah_penduduk, 0, ',', '.'); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Jumlah Penduduk Miskin (Hasil Klasifikasi)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jumlah_miskin, 0, ',', '.'); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sad-tear fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Selamat Datang!</h4>
        <p>Anda berhasil login sebagai <strong>admin</strong>. Melalui sistem ini, Anda dapat mengelola data penduduk dan melakukan klasifikasi status ekonomi menggunakan metode Support Vector Machine (SVM) untuk menentukan kelayakan penerimaan bantuan sosial.</p>
        <hr>
        <p class="mb-0">Silakan gunakan menu di sebelah kiri untuk menavigasi halaman.</p>
    </div>

</div>