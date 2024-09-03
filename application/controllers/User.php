<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $this->db->select('*')->from('user');
        $this->db->order_by('nama', 'ASC');
        $user = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Add User',
            'user'         => $user
        );
        $this->template->load('template','user', $data);
    }



    public function tambah()
    {
      
        $data = array(
            'username'          => $this->input->post('username'),
            'nama'          => $this->input->post('nama'),
            'password'          => md5('password'),
            'email'          => $this->input->post('email'),
            'no_telepon'      => $this->input->post('no_telepon'),
            'alamat'         => $this->input->post('alamat'),
        );
        $this->db->insert('user', $data);
        $this->session->set_flashdata('alert', '
  			<div class="alert alert-success" role="alert">
			Data Berhasil Ditambahkan.
			</div>
			');
        redirect('user');
    }

    public function hapus($id)
    {
        $where = array(
            'id_user'   => $id
        );
        $this->db->delete('user', $where);
        $this->session->set_flashdata('alert', '
		<div class="alert alert-success" role="alert">
		Berhasil Menghapus Data Produk.
		</div>
		');
        redirect('user');
    }

    public function edit()
    {
        $where = array(
            'id_user'   => $this->input->post('id_user')
        );

        $data = array(
            'nama'          => $this->input->post('nama'),
            'email'          => $this->input->post('email'),
            'no_telepon'      => $this->input->post('no_telepon'),
            'alamat'         => $this->input->post('alamat'),
        );
        $this->db->update('user', $data, $where);
        $this->session->set_flashdata('alert', '
            <div class="alert alert-success" role="alert">
            Berhasil memperbarui nama user!!
            </div>
			');
        redirect('user');
    }
}
