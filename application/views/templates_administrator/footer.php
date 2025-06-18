            </div> <!-- End of Content -->

            <footer class="sticky-footer bg-white">
              <div class="container my-auto">
                <div class="copyright text-center my-auto">
                  <span>&copy; <?= date('Y') ?> Website Klasifikasi SVM</span>
                </div>
              </div>
            </footer>
          </div> <!-- End of Content Wrapper -->
        </div> <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Yakin ingin keluar?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Pilih <strong>Logout</strong> di bawah ini jika Anda siap mengakhiri sesi saat ini.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-primary">Logout</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Scripts -->
        <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/demo/datatables-demo.js') ?>"></script>

      </body>
    </html>
