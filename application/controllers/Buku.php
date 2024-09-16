<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Buku_model');
        $this->load->library('session');
        $this->load->helper('url');

        if ($this->session->userdata('level') == NULL || $this->session->userdata('level') == 'peminjam') {
            redirect('auth');
        }
    }

    public function index()
    {
        $buku = $this->Buku_model->get_all_buku();
        $kategori = $this->Buku_model->get_all_kategori();
        $ulasan = $this->Buku_model->get_avg_ratings();

        $avg_ratings = [];
        foreach ($ulasan as $row) {
            $avg_ratings[$row['id_buku']] = $row['avg_rating'];
        }

        $data = array(
            'kategori' => $kategori,
            'judul_halaman' => 'Halaman Depan',
            'buku' => $buku,
            'avg_ratings' => $avg_ratings,
        );

        $this->template->load('template', 'buku', $data);
    }

    public function ulasan($id)
    {
        $buku = $this->Buku_model->get_buku_by_id($id);
        $ulasan = $this->Buku_model->get_ulasan_by_buku($id);

        $data = array(
            'buku' => $buku,
            'ulasan' => $ulasan,
            'judul_halaman' => 'Halaman Ulasan dari User'
        );

        $this->template->load('template', 'ulasan_admin', $data);
    }

    public function tambah()
    {
        $config['upload_path'] = './assets/upload/buku/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 500; // Kilobytes
        $config['file_name'] = date('YmdHis') . '.jpg';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect('buku');
        } else {
            $upload_data = $this->upload->data();
            $foto = $upload_data['file_name'];
        }

        $data = array(
            'judul' => $this->input->post('judul'),
            'penulis' => $this->input->post('penulis'),
            'penerbit' => $this->input->post('penerbit'),
            'tahunterbit' => $this->input->post('tahunterbit'),
            'deskripsi' => $this->input->post('deskripsi'),
            'foto' => $foto,
            'stok' => $this->input->post('stok'),
            'id_kategori' => $this->input->post('id_kategori')
        );

        $this->Buku_model->insert_buku($data);
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan.</div>');
        redirect('buku');
    }

    public function hapus($id)
    {
        $this->Buku_model->delete_buku($id);
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">Berhasil Menghapus Data.</div>');
        redirect('buku');
    }

    public function edit()
{
    $id_buku = $this->input->post('id_buku');
    $judul = $this->input->post('judul');
    $penulis = $this->input->post('penulis');
    $penerbit = $this->input->post('penerbit');
    $tahunterbit = $this->input->post('tahunterbit');
    $deskripsi = $this->input->post('deskripsi');
    $stok = $this->input->post('stok');
    $id_kategori = $this->input->post('id_kategori');
    $foto_lama = $this->input->post('foto_lama');

    $data = array(
        'judul' => $judul,
        'penulis' => $penulis,
        'penerbit' => $penerbit,
        'tahunterbit' => $tahunterbit,
        'deskripsi' => $deskripsi,
        'stok' => $stok,
        'id_kategori' => $id_kategori
    );

    $result = $this->Buku_model->update_buku($id_buku, $data, $foto_lama);

    if ($result['status'] == 'error') {
        $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Upload Gagal: ' . $result['message'] . '</div>');
    } else {
        $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">' . $result['message'] . '</div>');
    }

    redirect('buku');

    }
}
