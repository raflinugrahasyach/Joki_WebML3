<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penduduk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penduduk_model');
        $this->load->library('form_validation');
        // PERBAIKAN: Memuat library PDF di constructor agar bisa digunakan di semua method
        $this->load->library('pdf');
    }

    /**
     * FUNGSI BARU: Menampilkan halaman utama Data Penduduk
     * Ini akan memperbaiki error 404.
     */
    public function index()
    {
        $data['judul'] = 'Daftar Penduduk';
        $data['penduduk'] = $this->Penduduk_model->getAllPenduduk();
        $this->load->view('templates_administrator/header', $data);
        $this->load->view('templates_administrator/sidebar');
        $this->load->view('penduduk/index', $data);
        $this->load->view('templates_administrator/footer');
    }

    /**
     * FUNGSI BARU: Menampilkan form tambah data
     */
    public function tambah()
    {
        $data['judul'] = 'Form Tambah Data & Klasifikasi Penduduk';
        $this->load->view('templates_administrator/header', $data);
        $this->load->view('templates_administrator/sidebar');
        $this->load->view('penduduk/tambah', $data);
        $this->load->view('templates_administrator/footer');
    }

    /**
     * Memproses data dari form tambah, memanggil API, dan menyimpan ke database.
     */
    public function proses_tambah()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric|is_unique[tb_penduduk.nik]|max_length[16]|min_length[16]');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('tanggungan_anak', 'Tanggungan Anak', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $input_data = $this->input->post(NULL, TRUE);
            $prediction_result = $this->call_prediction_api($input_data);

            if ($prediction_result['status'] == 'success') {
                $this->Penduduk_model->simpan_penduduk_dan_klasifikasi($input_data, $prediction_result['prediction']);
                $this->session->set_flashdata('flash', 'Data penduduk berhasil ditambahkan dan diklasifikasi.');
                redirect('penduduk');
            } else {
                $this->session->set_flashdata('flash-error', $prediction_result['message']);
                redirect('penduduk/tambah');
            }
        }
    }

    private function call_prediction_api($input_data)
    {
        $api_url = 'http://127.0.0.1:5000/predict';
        $features = [
            'jenis_kelamin'     => (int)$input_data['jenis_kelamin'],
            'pendidikan'        => (int)$input_data['pendidikan'],
            'pekerjaan'         => (int)$input_data['pekerjaan'],
            'status_perkawinan' => (int)$input_data['status_perkawinan'],
            'tanggungan_anak'   => (int)$input_data['tanggungan_anak'],
            'lantai_rumah'      => (int)$input_data['lantai_rumah'],
            'dinding_rumah'     => (int)$input_data['dinding_rumah'],
            'daya_listrik'      => (int)$input_data['daya_listrik'],
            'sumber_air'        => (int)$input_data['sumber_air']
        ];

        $payload = json_encode(['data' => $features]);
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);
        
        if ($http_code == 200 && $response) {
            $result = json_decode($response, true);
            if (isset($result['prediction'])) {
                return ['status' => 'success', 'prediction' => $result['prediction']];
            }
        }
        
        $error_message = "Gagal terhubung ke service AI (HTTP Code: {$http_code}).";
        if ($curl_error) { $error_message .= " cURL Error: " . $curl_error; }
        return ['status' => 'error', 'message' => $error_message];
    }

    /**
     * Menampilkan halaman detail data penduduk
     */
    public function detail($nik)
    {
        $data['judul'] = 'Detail Data Penduduk';
        $data['penduduk'] = $this->Penduduk_model->getPendudukById($nik);
        $this->load->view('templates_administrator/header', $data);
        $this->load->view('templates_administrator/sidebar');
        $this->load->view('penduduk/detail', $data);
        $this->load->view('templates_administrator/footer');
    }

    /**
     * Menampilkan dan memproses form ubah data penduduk
     */
    public function ubah($nik)
    {
        $data['judul'] = 'Form Ubah Data Penduduk';
        $data['penduduk'] = $this->Penduduk_model->getPendudukById($nik);
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates_administrator/header', $data);
            $this->load->view('templates_administrator/sidebar');
            $this->load->view('penduduk/ubah', $data);
            $this->load->view('templates_administrator/footer');
        } else {
            $this->Penduduk_model->ubahDataPenduduk($nik);
            $this->session->set_flashdata('flash', 'Data penduduk berhasil diubah.');
            redirect('penduduk');
        }
    }

    /**
     * Menghapus data penduduk
     */
    public function hapus($nik)
    {
        if ($this->Penduduk_model->hapusDataPenduduk($nik) > 0) {
            $this->session->set_flashdata('flash', 'Data penduduk berhasil dihapus.');
        } else {
            $this->session->set_flashdata('flash-error', 'Gagal menghapus data penduduk.');
        }
        redirect('penduduk');
    }
    
    /**
     * Membuat laporan PDF
     */
    public function laporan()
    {
        $data['penduduk'] = $this->Penduduk_model->getAllPenduduk();
        $this->pdf->paper_size = 'A4';
        $this->pdf->orientation = 'landscape';
        $this->pdf->filename = "laporan_data_penduduk.pdf";
        $this->pdf->load_view('penduduk/laporan_semua', $data);
    }
}
