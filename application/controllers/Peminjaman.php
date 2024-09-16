<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Peminjaman_model');
        $this->load->library('session');
        $this->load->helper('url');
        if ($this->session->userdata('level') == NULL) {
            redirect('auth');
        }
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        // Mengambil data buku dan peminjaman
        $buku = $this->Peminjaman_model->get_available_books();
        $detail = $this->Peminjaman_model->get_peminjaman_detail($id_user);

        // Data yang akan dikirim ke view
        $data = array(
            'judul_halaman' => 'Peminjaman',
            'icon' => "DIGITAL LIBRARY📚",
            'buku' => $buku,
            'id_user' => $id_user,
            'detail' => $detail
        );

        // Memuat view dengan data
        $this->template->load('template_user', 'pinjaman_buku', $data);
    }

    public function addcart()
    {
        $this->Peminjaman_model->add_to_cart();
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function keranjang()
    {
        $cart = $this->Peminjaman_model->get_cart();
        $data = array(
            'cart' => $cart,
            'judul_halaman' => 'Cart',
            'icon' => "DIGITAL LIBRARY📚"
        );
        $this->template->load('template_user', 'cart', $data);
    }

    public function tambah_pinjam()
    {
        $this->Peminjaman_model->process_peminjaman();
        $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>Berhasil Pinjam Buku
        </div>');
        redirect('dashboard_user');
    }

    public function tambah_koleksi()
    {
        $this->Peminjaman_model->add_to_koleksi();
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
            Buku berhasil ditambahkan ke koleksi pribadi.
        </div>');
        redirect($_SERVER["HTTP_REFERER"]);
    }

    public function lihat_koleksi()
    {
        $koleksi = $this->Peminjaman_model->get_koleksi();
        $data = array(
            'judul_halaman' => 'Koleksi Buku Saya',
            'icon' => "DIGITAL LIBRARY📚",
            'koleksi' => $koleksi
        );
        $this->template->load('template_user', 'lihat_koleksi', $data);
    }

    public function hapus_dari_koleksi($id_koleksi)
    {
        $this->Peminjaman_model->delete_from_koleksi($id_koleksi);
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
            Buku berhasil dihapus dari koleksi pribadi.
        </div>');
        redirect('peminjaman/lihat_koleksi');
    }
}
