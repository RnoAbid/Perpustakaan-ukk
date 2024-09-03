<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  
    public function registrasi()
    {
        $data = array(
            'username'      => $this->input->post('username'),
            'nama'          => $this->input->post('nama'),
            'password'      => md5($this->input->post('password')),
            'email'         => $this->input->post('email'),
            'no_telepon'    => $this->input->post('no_telepon'),
            'alamat'        => $this->input->post('alamat'),
            'level'         => $this->input->post('level')
        );
        $this->db->insert('user', $data);
        $this->session->set_flashdata('alert', '
            <div class="alert alert-success" role="alert">
            Data Berhasil Ditambahkan.
            </div>
        ');
        redirect('Auth');
    }
}
?>
