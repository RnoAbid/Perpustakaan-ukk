<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if ($this->session->userdata('level') != 'admin') {
            redirect('auth');
        }
    }
    public function index()
    {
        $this->db->select('*')->from('siswa');
        $this->db->order_by('nama', 'ASC');
        $siswa = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Data Siswa',
            'siswa'         => $siswa
        );
        $this->template->load('template', 'siswa', $data);
    }



    public function tambah()
    {
        $config['upload_path'] = 'assets/siswa/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 500; // Kilobytes
        $config['file_name'] = date('YmdHis') . '.jpg';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $this->session->set_flashdata('alert', '
            <div class="alert alert-danger" role="alert">
            ' . $this->upload->display_errors() . '
            </div>
        ');
            redirect('siswa');
        } else {
            $upload_data = $this->upload->data();
            $foto = $upload_data['file_name'];
        }

        $data = array(
            'nama'          => $this->input->post('nama'),
            'nis'          => $this->input->post('nis'),
            'tanggal_lahir'      => $this->input->post('tanggal_lahir'),
            'alamat'         => $this->input->post('alamat'),
            'foto'         => $foto,
        );

        $this->db->insert('siswa', $data);
        $this->session->set_flashdata('alert', '
        <div class="alert alert-success" role="alert">
      Data Siswa Berhasil Ditambahkan.
      </div>
      ');
        redirect('siswa');
    }

    // public function tambah()
    // {

    //     $data = array(
    //         'nama'          => $this->input->post('nama'),
    //         'nis'          => $this->input->post('nis'),
    //         'tanggal_lahir'      => $this->input->post('tanggal_lahir'),
    //         'alamat'         => $this->input->post('alamat'),
    //     );
    //     $this->db->insert('siswa', $data);
    //     $this->session->set_flashdata('alert', '
    // 		<div class="alert alert-success" role="alert">
    // 		Data Siswa Berhasil Ditambahkan.
    // 		</div>
    // 		');
    //     redirect('siswa');
    // }

    public function hapus($id)
    {
        $where = array(
            'id_siswa'   => $id
        );
        $this->db->delete('siswa', $where);
        $this->session->set_flashdata('alert', '
		<div class="alert alert-success" role="alert">
		Berhasil Menghapus Data Siswa.
		</div>
		');
        redirect('siswa');
    }





    public function edit()
    {
        $foto =  $this->input->post('foto');
        $config['upload_path']          = 'assets/siswa/';
        $config['max_size']             = 2048 * 1024; //3 * 1024 * 1024; //3Mb; 0=unlimited
        $config['file_name']            = $foto;
        $config['overwrite']            = true;
        $config['allowed_types']        = '*';
        $this->load->library('upload', $config);
        if ($_FILES['foto']['size'] >= 2048 * 1024) {
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger alert-dismissible" role="alert">
                Ukuran foto terlalu besar, upload ulang foto dengan ukuran yang kurang dari 2 MB.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                    ');
            redirect('siswa');
        } elseif (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        $data = array(
            'nama'          => $this->input->post('nama'),
            'nis'          => $this->input->post('nis'),
            'tanggal_lahir'      => $this->input->post('tanggal_lahir'),
            'alamat'         => $this->input->post('alamat'),
            'foto'         => $this->input->post('foto'),
        );
        // var_dump($data,$where);
        $this->db->update('siswa', $data);
        // var_dump($data,$where);
        // die;
        $this->session->set_flashdata('alert', '
            <div class="alert alert-success" role="alert">
            Berhasil Memperbarui Data
            </div>
			');
        redirect('siswa');
    }



    // public function edit()
    // {
    //     $where = array(
    //         'id_user'   => $this->input->post('id_user')
    //     );

    //     $data = array(
    //         'nama'          => $this->input->post('nama'),
    //         'nis'          => $this->input->post('nis'),
    //         'tanggal_lahir'      => $this->input->post('tanggal_lahir'),
    //         'alamat'         => $this->input->post('alamat'),
    //     );
    //     $this->db->update('siswa', $data, $where);
    //     $this->session->set_flashdata('alert', '
    //         <div class="alert alert-success" role="alert">
    //         Berhasil memperbarui nama user!!
    //         </div>
    // 		');
    //     redirect('siswa');
    // }
}
