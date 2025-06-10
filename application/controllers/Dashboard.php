<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek jika belum login
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        $this->load->model('Penduduk_model');
    }

    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['total_penduduk'] = $this->Penduduk_model->countAllPenduduk();
        $data['total_miskin'] = $this->Penduduk_model->countByKelas('Miskin');
        $data['total_tidak_miskin'] = $this->Penduduk_model->countByKelas('Tidak Miskin');
        
        $this->load->view('templates_administrator/header', $data);
        $this->load->view('templates_administrator/sidebar');
        // Nama view yang benar adalah 'dashboard/index', bukan 'v_dashboard' agar konsisten
        $this->load->view('dashboard/index', $data); 
        $this->load->view('templates_administrator/footer');
    }
}