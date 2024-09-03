<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        $data = array(
            'judul_halaman' => 'Login',
            'icon'    => "DIGITAL LIBRARY📚",
        );
        $this->load->view('login', $data);
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        
        $this->db->from('user')->where('username', $username);
        $cekk = $this->db->get()->row();

        if ($cekk == NULL) {
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger" role="alert">
                Username tidak ada!!
                </div>
            ');
            redirect('auth');
        } elseif ($cekk->password == $password) {
            $data = array(
                'id_user'    => $cekk->id_user,
                'nama'       => $cekk->nama,
                'username'   => $cekk->username,
                'level'      => $cekk->level
            );
            $this->session->set_userdata($data);

            if ($cekk->level == 'admin' || $cekk->level == 'petugas') {
                redirect('dashboard');
            } elseif ($cekk->level == 'peminjam') {
                redirect('dashboard_user');
            } else {
                $this->session->set_flashdata('alert', '
                    <div class="alert alert-danger" role="alert">
                    Level pengguna tidak dikenali!
                    </div>
                ');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger" role="alert">
                Password Salah!!
                </div>
            ');
            redirect('auth');
        }
    }

    public function logout()    
    {
        $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Log Out Berhasil</div>');
        session_destroy();
        redirect('auth');
    }

    public function regis()
    {
        $data = array(
            'judul_halaman' => 'Registrasi',
            'icon'    => "DIGITAL LIBRARY📚",
        );
        $this->load->view('registrasi', $data);
    }

    public function registrasi()
    {
        $data = array(
            'username'      => $this->input->post('username'),
            'nama'          => $this->input->post('nama'),
            'password'      => md5($this->input->post('password')),
            'email'         => $this->input->post('email'),
            'no_telepon'    => $this->input->post('no_telepon'),
            'alamat'        => $this->input->post('alamat'),
            'level'         => 'peminjam'
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
