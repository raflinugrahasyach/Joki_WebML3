<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penduduk_model extends CI_Model
{
    private $table_penduduk = 'tb_penduduk';
    private $table_klasifikasi = 'tb_klasifikasi';
    private $table_hasil = 'tb_hasil';

    /**
     * Mengambil semua data penduduk beserta hasil klasifikasinya.
     */
    public function getAllPenduduk()
    {
        // PERBAIKAN: Menambahkan 'k.jenis_kelamin' ke dalam SELECT
        $this->db->select('p.*, h.kelas as status_kemiskinan, k.jenis_kelamin');
        $this->db->from($this->table_penduduk . ' as p');
        $this->db->join($this->table_klasifikasi . ' as k', 'p.nik = k.nik', 'left');
        $this->db->join($this->table_hasil . ' as h', 'k.id_klasifikasi = h.id_klasifikasi', 'left');
        $this->db->order_by('p.nama', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Mengambil data satu penduduk secara lengkap untuk halaman detail.
     */
    public function getPendudukById($nik)
    {
        $this->db->select('p.*, k.*, h.kelas, h.tanggal_klasifikasi');
        $this->db->from($this->table_penduduk . ' as p');
        $this->db->join($this->table_klasifikasi . ' as k', 'p.nik = k.nik', 'left');
        $this->db->join($this->table_hasil . ' as h', 'k.id_klasifikasi = h.id_klasifikasi', 'left');
        $this->db->where('p.nik', $nik);
        return $this->db->get()->row_array();
    }
    
    /**
     * Menyimpan data penduduk baru beserta hasil klasifikasinya dalam satu transaksi.
     */
    public function simpan_penduduk_dan_klasifikasi($input_data, $hasil_prediksi)
    {
        $this->db->trans_start();

        // 1. Simpan data pokok ke tb_penduduk
        $data_penduduk = [
            'nik' => $input_data['nik'], 'nama' => $input_data['nama'],
            'tgl_lahir' => $input_data['tgl_lahir'], 'alamat' => $input_data['alamat'],
            'rt_rw' => $input_data['rt_rw'],
        ];
        $this->db->insert($this->table_penduduk, $data_penduduk);

        // 2. Simpan data kriteria ke tb_klasifikasi
        $data_klasifikasi = [
            'nik' => $input_data['nik'], 'jenis_kelamin' => $input_data['jenis_kelamin'],
            'pendidikan' => $input_data['pendidikan'], 'pekerjaan' => $input_data['pekerjaan'],
            'status_perkawinan' => $input_data['status_perkawinan'], 'tanggungan_anak' => $input_data['tanggungan_anak'],
            'lantai_rumah' => $input_data['lantai_rumah'], 'dinding_rumah' => $input_data['dinding_rumah'],
            'daya_listrik' => $input_data['daya_listrik'], 'sumber_air' => $input_data['sumber_air'],
        ];
        $this->db->insert($this->table_klasifikasi, $data_klasifikasi);
        $id_klasifikasi = $this->db->insert_id();

        // 3. Simpan hasil prediksi ke tb_hasil
        $data_hasil = [
            'id_klasifikasi' => $id_klasifikasi, 'nik' => $input_data['nik'],
            'kelas' => $hasil_prediksi, 'akurasi' => null,
        ];
        $this->db->insert($this->table_hasil, $data_hasil);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * FUNGSI BARU: Mengubah data pokok penduduk di tb_penduduk.
     */
    public function ubahDataPenduduk($nik)
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "tgl_lahir" => $this->input->post('tgl_lahir', true),
            "alamat" => $this->input->post('alamat', true),
            "rt_rw" => $this->input->post('rt_rw', true),
        ];
        $this->db->where('nik', $nik);
        $this->db->update($this->table_penduduk, $data);
    }

    /**
     * FUNGSI BARU: Menghapus data penduduk.
     */
    public function hapusDataPenduduk($nik)
    {
        $this->db->where('nik', $nik);
        $this->db->delete($this->table_penduduk);
        return $this->db->affected_rows();
    }

    /**
     * FUNGSI BARU UNTUK DASHBOARD: Menghitung semua data penduduk.
     */
    public function count_all_penduduk()
    {
        return $this->db->count_all($this->table_penduduk);
    }

    /**
     * FUNGSI BARU UNTUK DASHBOARD: Menghitung penduduk berdasarkan status.
     */
    public function count_by_status($status)
    {
        $this->db->where('kelas', $status);
        return $this->db->count_all_results($this->table_hasil);
    }
}
