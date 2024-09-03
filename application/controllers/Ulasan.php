<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ulasan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if ($this->session->userdata('level') != 'peminjam') {
            redirect('auth');
        }
    }
    public function index($id_buku = null)
    {
        if ($id_buku) {
            $this->db->from('buku a')->join('kategoribuku b', 'a.id_kategori=b.id_kategori', 'left');
            $this->db->where('a.id_buku', $id_buku);
            $buku = $this->db->get()->row_array(); // Fetch only the selected book
            
            if (!$buku) {
                show_404(); // Book not found
            }
            
            // Fetch related data
            $this->db->from('kategoribuku');
            $kategori = $this->db->get()->result_array();
    
            $this->db->select('AVG(rating) as avg_rating');
            $this->db->from('ulasan');
            $this->db->where('id_buku', $id_buku);
            $ulasan = $this->db->get()->row_array();
    
            $avg_rating = $ulasan ? $ulasan['avg_rating'] : null;
            $data = array(
                'buku' => [$buku],
                'kategori' => $kategori,
                'avg_ratings' => [$id_buku => $avg_rating],
                'judul_halaman' => 'Tambah Ulasan',
                'icon'    => "DIGITAL LIBRARY📚",
            );
            $this->template->load('template_user', 'ulasan', $data);
        } else {
            show_404(); // ID not provided
        }
    }
    




    public function AddUlasan()
    {
        $data = array(
            'ulasan' => $this->input->post('ulasan'),
            'id_buku' => $this->input->post('id_buku'),
            'id_user' => $this->input->post('id_user'),
            'rating' => $this->input->post('rating'),
        );
        $this->db->insert('ulasan', $data);
        $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa fa-exclamation-circle me-2"></i>Berhasil Tambah Ulasan Buku
  </div>');
  redirect($_SERVER['HTTP_REFERER']);
}

    public function ulasan($id)
    {
        $buku = $this->db->from('buku')->where('id_buku', $id)->get()->row();
        $this->db->from('ulasan a')->join('user b', 'a.id_user=b.id_user')->where('id_buku', $id);
        $ulasan = $this->db->get()->result_array();
        $data = array(
            'buku' => $buku,
            'ulasan' => $ulasan,
        );
        $this->template->load('template', 'ulasan_admin', $data);
    }
}
