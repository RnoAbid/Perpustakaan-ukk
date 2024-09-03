<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if ($this->session->userdata('level') != 'peminjam') {
            redirect('auth');
        }
    }


    public function index()
    {
        // Ambil data kategori
        $this->db->from('kategoribuku');
        $this->db->order_by('kategori', 'ASC');
        $kategori = $this->db->get()->result_array();

        // Ambil data buku dengan join ke tabel kategoribuku
        $this->db->select('a.*, b.kategori');
        $this->db->from('buku a');
        $this->db->join('kategoribuku b', 'a.id_kategori=b.id_kategori', 'left');
        $buku = $this->db->get()->result_array();

        $data = array(
            'judul_halaman' => 'Dashboard ',
            'icon'    => "DIGITAL LIBRARY📚",
            'buku'          => $buku,
            'kategori'      => $kategori
        );


        $this->template->load('template_user', 'beranda', $data);
    }



    public function detail_buku($id_buku)
    {
        $this->db->from('buku a')->join('kategoribuku b', 'a.id_kategori=b.id_kategori', 'left')->where('id_buku', $id_buku);
        $buku = $this->db->get()->result_array();
        $this->db->from('kategoribuku');
        $kategori = $this->db->get()->result_array();

        $this->db->select('id_buku, AVG(rating) as avg_rating');
        $this->db->from('ulasan');
        $this->db->group_by('id_buku');
        $ulasan = $this->db->get()->result_array();

        // Buat array asosiasi untuk rata-rata rating per id_buku
        $avg_ratings = [];
        foreach ($ulasan as $row) {
            $avg_ratings[$row['id_buku']] = $row['avg_rating'];
        }
        $data = array(
            'buku' => $buku,
            'kategori' => $kategori,
            'avg_ratings' => $avg_ratings,
            'judul_halaman' => 'Dashboard ',
            'icon'    => "DIGITAL LIBRARY📚",
        );

        $this->template->load('template_user', 'detail_buku', $data);
    }


    public function tampil_peminjaman($id)
    {
        $pinjam = $this->db->from('kategoribuku a')->join('buku b', 'a.id_kategori=b.id_kategori')->where('id_buku', $id)->get()->result_array();
        $data = array(
            'pinjam' => $pinjam,
            'icon' => "DIGITAL LIBRARY📚",

        );
        // var_dump($data);die;
        $this->template->load('template_user', 'pinjaman_buku', $data);
    }



    public function search()
    {
        $keyword = $this->input->get('keyword');
        $category = $this->input->get('category');

        // Ambil data kategori
        $this->db->from('kategoribuku');
        $this->db->order_by('kategori', 'ASC');
        $kategori = $this->db->get()->result_array();

        // Ambil data buku dengan join ke tabel kategoribuku
        $this->db->select('a.*, b.kategori');
        $this->db->from('buku a');
        $this->db->join('kategoribuku b', 'a.id_kategori=b.id_kategori', 'left');

        if ($keyword) {
            $this->db->like('a.judul', $keyword);
            $this->db->or_like('a.deskripsi', $keyword);
        }

        if ($category) {
            $this->db->where('b.kategori', $category);
        }

        $buku = $this->db->get()->result_array();

        $data = array(
            'judul_halaman' => 'Hasil Pencarian',
            'icon'    => "DIGITAL LIBRARY📚",
            'buku'          => $buku,
            'kategori'      => $kategori,
            'query'          => $keyword // Menambahkan query ke data view
        );

        // Gunakan view secara langsung untuk debugging
        $this->load->view('search_results', $data);
    }

    public function peminjaman()
    {
        $user = $this->db->from('user')->where('level =', 'peminjam')->get()->result_array();
        $pinjam = $this->db->from('peminjaman a')->join('user b', 'a.id_user=b.id_user')->get()->result_array();
        foreach ($pinjam as &$p) {
            $status = $this->db->from('detail_peminjaman')
                ->where('kode', $p['kode'])
                ->where('status_peminjaman', 'dipinjam')
                ->get()
                ->row_array();
            $p['status'] = $status ? 'Belum Selesai' : 'Selesai';
        }
        $data = array(
            'user' => $user,
            'pinjam' => $pinjam,
            'judul_halaman' => 'Peminjaman',
            'icon'  => "DIGITAL LIBRARY📚",

        );
        $this->template->load('template_user', 'peminjaman_buku_user', $data);
    }
}
