<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if ($this->session->userdata('level') == NULL || $this->session->userdata('level') == 'peminjam') {
            redirect('auth');
        }
    }
    
    public function index()
    {
        $this->db->select('*')->from('kategoribuku');
        $this->db->order_by('id_kategori', 'ASC');
        $kategori = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Kategori',
            'kategori' => $kategori
        );
        $this->template->load('template', 'kategoribuku', $data);
    }

    public function tambah()
    {
        $data = array(
            'kategori' => $this->input->post('kategori'),
        );
        $this->db->insert('kategoribuku', $data);
        $this->session->set_flashdata('alert', '
            <div class="alert alert-success" role="alert">
                Data Berhasil Ditambahkan.
            </div>
        ');
        redirect('kategori');
    }

    public function hapus($id)
    {
        $where = array(
            'id_kategori' => $id 
        );
        $this->db->delete('kategoribuku', $where);
        $this->session->set_flashdata('alert', '
            <div class="alert alert-success" role="alert">
                Berhasil Menghapus Data.
            </div>
        ');
        redirect('kategori');
    }

    public function edit($id)
    {
        $this->db->select('*')->from('kategoribuku')->where('id_kategori', $id);
        $kategori = $this->db->get()->row_array();

        if ($kategori) {
            $data = array(
                'judul_halaman' => 'Edit Kategori',
                'kategori' => $kategori
            );
            $this->template->load('template', 'edit_kategoribuku', $data);
        } else {
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger" role="alert">
                    Data tidak ditemukan.
                </div>
            ');
            redirect('kategori');
        }
    }

    public function update()
    {
        $id = $this->input->post('id_kategori');
        $data = array(
            'kategori' => $this->input->post('kategori'),
        );

        $this->db->where('id_kategori', $id);
        $this->db->update('kategoribuku', $data);

        $this->session->set_flashdata('alert', '
            <div class="alert alert-success" role="alert">
                Data Berhasil Diupdate.
            </div>
        ');
        redirect('kategori');
    }
}
