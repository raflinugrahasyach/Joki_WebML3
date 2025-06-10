<?php
class Penduduk_model extends CI_Model {

    // ========== FUNGSI UNTUK PENDUDUK (CRUD) ==========

    public function getAllPendudukWithHasil()
    {
        $this->db->select('p.nik, p.nama, p.alamat, p.rt_rw, h.kelas, h.tanggal_klasifikasi');
        $this->db->from('tb_penduduk p');
        $this->db->join('tb_hasil h', 'p.nik = h.nik', 'left');
        $this->db->order_by('h.tanggal_klasifikasi', 'DESC');
        return $this->db->get()->result_array();
    }
    
    public function getPendudukDetailById($nik)
    {
        $this->db->select('*');
        $this->db->from('tb_penduduk p');
        $this->db->join('tb_klasifikasi k', 'p.nik = k.nik', 'left');
        $this->db->join('tb_hasil h', 'k.id_klasifikasi = h.id_klasifikasi', 'left');
        $this->db->where('p.nik', $nik);
        return $this->db->get()->row_array();
    }

    public function simpanDataKlasifikasi($data_klasifikasi, $prediksi)
    {
        // 1. Simpan ke tb_penduduk
        $data_penduduk = [
            'nik' => $this->input->post('nik', true),
            'nama' => $this->input->post('nama', true),
            'tgl_lahir' => $this->input->post('tgl_lahir', true),
            'alamat' => $this->input->post('alamat', true),
            'rt_rw' => $this->input->post('rt_rw', true),
        ];
        $this->db->insert('tb_penduduk', $data_penduduk);

        // 2. Simpan ke tb_klasifikasi
        $data_klasifikasi['nik'] = $this->input->post('nik', true);
        $this->db->insert('tb_klasifikasi', $data_klasifikasi);
        $id_klasifikasi = $this->db->insert_id();

        // 3. Simpan ke tb_hasil
        $data_hasil = [
            'id_klasifikasi' => $id_klasifikasi,
            'nik' => $this->input->post('nik', true),
            'kelas' => $prediksi['hasil'] ?? 'Error',
            'akurasi' => NULL
        ];
        $this->db->insert('tb_hasil', $data_hasil);

        return $id_klasifikasi;
    }

    public function updateDataPenduduk($nik)
    {
        // 1. Update tb_penduduk
        $data_penduduk = [
            'nama' => $this->input->post('nama', true),
            'tgl_lahir' => $this->input->post('tgl_lahir', true),
            'alamat' => $this->input->post('alamat', true),
            'rt_rw' => $this->input->post('rt_rw', true),
        ];
        $this->db->where('nik', $nik);
        $this->db->update('tb_penduduk', $data_penduduk);

        // 2. Update tb_klasifikasi
        $data_klasifikasi = [
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
        $this->db->where('nik', $nik);
        $this->db->update('tb_klasifikasi', $data_klasifikasi);
        
        // 3. Reklasifikasi dan update tb_hasil
        // Memanggil API Python menggunakan cURL
        $api_url = 'http://127.0.0.1:5000/predict';
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_klasifikasi));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec($ch);
        curl_close($ch);
        $prediksi = json_decode($response, true);

        $data_hasil = [
            'kelas' => $prediksi['hasil'] ?? 'Error',
            'tanggal_klasifikasi' => date('Y-m-d H:i:s')
        ];
        $this->db->where('nik', $nik);
        $this->db->update('tb_hasil', $data_hasil);

        return true;
    }

    public function hapusDataPenduduk($nik)
    {
        // Karena di DB sudah di-set ON DELETE CASCADE, cukup hapus dari tabel induk
        $this->db->where('nik', $nik);
        $this->db->delete('tb_penduduk');
    }

    public function cariDataPenduduk()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('p.nik', $keyword);
        $this->db->or_like('alamat', $keyword);
        return $this->getAllPendudukWithHasil();
    }

    // ========== FUNGSI UNTUK AUTH & DASHBOARD ==========

    public function getUserByName($username)
    {
        return $this->db->get_where('tb_user', ['username' => $username])->row_array();
    }

    public function countAllPenduduk()
    {
        return $this->db->count_all('tb_penduduk');
    }

    public function countByKelas($kelas)
    {
        return $this->db->where('kelas', $kelas)->from('tb_hasil')->count_all_results();
    }
}