<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penduduk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penduduk_model'); // 
        $this->load->library('form_validation'); // 
        
        // Cek jika belum login
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['judul'] = 'Daftar Penduduk'; // 
        $data['penduduk'] = $this->Penduduk_model->getAllPendudukWithHasil(); // 
        
        if( $this->input->post('keyword') ) {
            $data['penduduk'] = $this->Penduduk_model->cariDataPenduduk(); // 
        }

        $this->load->view('templates_administrator/header', $data); // 
        $this->load->view('templates_administrator/sidebar'); // 
        $this->load->view('penduduk/index', $data); // 
        $this->load->view('templates_administrator/footer'); // 
    }

    public function tambah()
    {
        $data['judul'] = 'Form Tambah Data Penduduk'; // 

        // Aturan validasi
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|numeric|min_length[16]|max_length[16]|is_unique[tb_penduduk.nik]'); // 
        $this->form_validation->set_rules('nama', 'Nama', 'required'); // 
        $this->form_validation->set_rules('alamat', 'Alamat', 'required'); // 
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required'); // 
        $this->form_validation->set_rules('rt_rw', 'RT/RW', 'required'); // 
        $this->form_validation->set_rules('anak_sekolah', 'Jumlah anak sekolah', 'required|numeric'); // 

        if ($this->form_validation->run() == FALSE) { // 
            $this->load->view('templates_administrator/header', $data); // 
            $this->load->view('templates_administrator/sidebar'); // 
            $this->load->view('penduduk/tambah'); // 
            $this->load->view('templates_administrator/footer'); // 
        } else {
            $this->hasil();
        }
    }
    
    public function hasil()
    {
        // Data yang dikirim ke Python API HARUS dalam bentuk numerik
        $data_to_predict = [
            'j_kelamin' => (int)$this->input->post('j_kelamin', true),
            'pendidikan' => (int)$this->input->post('pendidikan', true),
            'pekerjaan' => (int)$this->input->post('pekerjaan', true),
            's_kawin' => (int)$this->input->post('s_kawin', true),
            'anak_sekolah' => (int)$this->input->post('anak_sekolah', true),
            'lt_rumah' => (int)$this->input->post('lt_rumah', true),
            'din_rumah' => (int)$this->input->post('din_rumah', true),
            'dy_listrik' => (int)$this->input->post('dy_listrik', true),
            'sumber_air' => (int)$this->input->post('sumber_air', true),
        ];

        // Memanggil API Python menggunakan cURL
        $api_url = 'http://127.0.0.1:5000/predict';
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_to_predict));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $prediksi = json_decode($response, true);

        if ($httpcode == 200 && isset($prediksi['hasil'])) {
            // Simpan semua data ke database
            $this->Penduduk_model->simpanDataKlasifikasi($data_to_predict, $prediksi);
            $this->session->set_flashdata('flash', 'Ditambahkan dan Berhasil Diklasifikasi'); // 
            
            // Siapkan data untuk ditampilkan di halaman hasil
            $data['nik'] = $this->input->post('nik', true); // 
            $data['nama'] = $this->input->post('nama', true); // 
            $data['alamat'] = $this->input->post('alamat', true); // 
            $data['tgl_lahir'] = $this->input->post('tgl_lahir', true); // 
            $data['rt_rw'] = $this->input->post('rt_rw', true); // 
            $data['kelas'] = $prediksi['hasil']; // 
            $data['akurasi'] = "N/A";

            $data1['judul'] = 'Hasil Klasifikasi Penduduk'; // 
            $this->load->view('templates_administrator/header', $data1); // 
            $this->load->view('templates_administrator/sidebar'); // 
            $this->load->view('penduduk/hasil', $data); // 
            $this->load->view('templates_administrator/footer'); // 

        } else {
            // Handle error jika API tidak merespon
            $this->session->set_flashdata('flash-error', 'Gagal melakukan klasifikasi. Service prediksi tidak merespon.');
            redirect('penduduk/tambah');
        }
    }

    public function ubah($nik)
    {
        $data['judul'] = 'Form Ubah Data Penduduk'; // 
        $data['penduduk'] = $this->Penduduk_model->getPendudukDetailById($nik); // 

        $this->form_validation->set_rules('nama', 'Nama', 'required'); // 
        $this->form_validation->set_rules('alamat', 'Alamat', 'required'); // 
        
        if ($this->form_validation->run() == FALSE) { // 
            $this->load->view('templates_administrator/header', $data); // 
            $this->load->view('templates_administrator/sidebar'); // 
            $this->load->view('penduduk/ubah', $data); // 
            $this->load->view('templates_administrator/footer'); // 
        } else {
            $this->Penduduk_model->updateDataPenduduk($nik);
            $this->session->set_flashdata('flash', 'Diubah'); // 
            redirect('penduduk'); // 
        }
    }

    public function hapus($nik)
    {
        $this->Penduduk_model->hapusDataPenduduk($nik); // 
        $this->session->set_flashdata('flash', 'Dihapus'); // 
        redirect('penduduk'); // 
    }

    public function detail($nik)
    {
        $data['judul'] = 'Detail Data Penduduk'; // 
        $data['penduduk'] = $this->Penduduk_model->getPendudukDetailById($nik); // 
        $this->load->view('templates_administrator/header', $data); // 
        $this->load->view('templates_administrator/sidebar'); // 
        $this->load->view('penduduk/detail', $data); // 
        $this->load->view('templates_administrator/footer');
    }

    public function laporan()
    {
        $this->load->library('pdf'); // 
        $data['penduduk'] = $this->Penduduk_model->getAllPendudukWithHasil(); // 
        
        $this->pdf->filename = "Daftar_Penduduk.pdf"; // 
        $this->pdf->load_view('penduduk/daftar_penduduk_pdf', $data); // 
    }

    public function laporanhasil($nik)
    {
        $this->load->library('pdf'); // 
        $data['penduduk'] = $this->Penduduk_model->getPendudukDetailById($nik); // 

        $this->pdf->filename = "Hasil_Klasifikasi_" . $nik . ".pdf"; // 
        $this->pdf->load_view('penduduk/lap_hasil_pdf', $data); // 
    }
}