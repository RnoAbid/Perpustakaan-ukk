<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_available_books()
    {
        $this->db->from('buku')->where('status', 'Tersedia');
        return $this->db->get()->result_array();
    }

    public function get_peminjaman_detail($id_user)
    {
        $this->db->from('peminjaman a');
        $this->db->join('buku b', 'a.id_buku=b.id_buku');
        $this->db->join('kategoribuku c', 'c.id_kategori=b.id_kategori');
        return $this->db->get()->result_array();
    }

    public function add_to_cart()
    {
        $user = $this->session->userdata('id_user');
        $buku = $this->input->post('id_buku');

        // Cek stok buku terlebih dahulu
        $this->db->select('stok');
        $this->db->from('buku');
        $this->db->where('id_buku', $buku);
        $stok_buku = $this->db->get()->row_array();

        if ($stok_buku['stok'] > 0) {
            $data = array(
                'id_user' => $user,
                'id_buku' => $buku,
            );
            $this->db->insert('temp', $data);
        }
    }

    public function get_cart()
    {
        $this->db->from('temp a');
        $this->db->join('buku b', 'a.id_buku=b.id_buku');
        $this->db->join('user c', 'a.id_user=c.id_user');
        $this->db->join('kategoribuku d', 'b.id_kategori=d.id_kategori');
        return $this->db->get()->result_array();
    }

    public function process_peminjaman()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m');
        $this->db->where("DATE_FORMAT(tanggal_awal,'%Y-%m')", $tanggal);
        $this->db->from('peminjaman');
        $jumlah = $this->db->count_all_results();
        $kode_peminjaman = date('ymd') . ($jumlah + 1);

        $temp = $this->db->join('buku', 'temp.id_buku = buku.id_buku')
                         ->where('id_user', $this->session->userdata('id_user'))
                         ->get('temp')->result_array();
        
        foreach ($temp as $value) {
            $data = [
                'kode' => $kode_peminjaman,
                'id_buku' => $value['id_buku'],
                'id_user' => $value['id_user'],
                'status_peminjaman' => 'dipinjam',
                'tanggal_peminjaman' => $this->input->post('tanggal_peminjaman'),
            ];
            $this->db->insert('detail_peminjaman', $data);

            $data2 = ['stok' => $value['stok'] - 1];
            $this->db->update('buku', $data2, ['id_buku' => $value['id_buku']]);
            $this->db->delete('temp', ['id_user' => $this->session->userdata('id_user')]);
        }

        $data3 = [
            'kode' => $kode_peminjaman,
            'tanggal_awal' => $this->input->post('tanggal_peminjaman'),
            'tanggal_akhir' => date('Y-m-d', strtotime('+14 days')),
            'id_user' => $this->session->userdata('id_user'),
        ];
        $this->db->insert('peminjaman', $data3);
    }

    public function add_to_koleksi()
    {
        $data = array(
            'id_user' => $this->input->post('id_user'),
            'id_buku' => $this->input->post('id_buku'),
        );
        $this->db->insert('koleksipribadi', $data);
    }

    public function get_koleksi()
    {
        $id_user = $this->session->userdata('id_user');
        $this->db->select('k.*, b.judul, b.deskripsi, b.foto, kb.kategori as nama_kategori');
        $this->db->from('koleksipribadi k');
        $this->db->join('buku b', 'k.id_buku = b.id_buku');
        $this->db->join('kategoribuku kb', 'b.id_kategori = kb.id_kategori');
        $this->db->where('k.id_user', $id_user);
        return $this->db->get()->result_array();
    }

    public function delete_from_koleksi($id_koleksi)
    {
        $this->db->where('id_koleksi', $id_koleksi);
        $this->db->delete('koleksipribadi');
    }
}
