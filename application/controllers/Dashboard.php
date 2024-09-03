<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $data = array(
            'judul_halaman' => 'Dashboard',
            'icon' => "DIGITAL LIBRARY📚",


        );
        $this->template->load('template', 'dashboard', $data);
    }



    public function registrasi()
    {
        $data = array(
            'username'          => $this->input->post('username'),
            'nama'          => $this->input->post('nama'),
            'password'          => md5('password'),
            'email'          => $this->input->post('email'),
            'no_telepon'      => $this->input->post('no_telepon'),
            'alamat'         => $this->input->post('alamat'),
            'level'         => $this->input->post('level'),
        );
        $this->db->insert('user', $data);
        $this->session->set_flashdata('alert', '
  			<div class="alert alert-success" role="alert">
			Data Berhasil Ditambahkan.
			</div>
			');
        redirect('user');
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
        );
        $this->template->load('template', 'peminjaman_buku_admin', $data);
    }


    public function tampil_detail($id)
    {
        $detail = $this->db->from('detail_peminjaman a')->join('peminjaman b', 'a.kode=b.kode')
            ->join('buku c', 'a.id_buku=c.id_buku')->join('user d', 'a.id_user=d.id_user')
            ->where('a.kode', $id)->get()->result_array();
        $data = array(
            'detail' => $detail,
            'judul_halaman' => 'Detail Peminjaman',

        );
        $this->template->load('template', 'detail_peminjaman_admin', $data);
    }

    public function kembali($id)
    {
        // Update status peminjaman di tabel buku
        date_default_timezone_set('Asia/Jakarta');
        $this->db->set('status_peminjaman', 'kembali')->set('tanggal_pengembalian', date('Y-m-d'))->where('id_buku', $id)->where('kode', $this->input->post('kode'))->update('detail_peminjaman');
        $this->db->set('stok', 'stok + 1', FALSE)->where('id_buku', $id)->update('buku');
        $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa fa-exclamation-circle me-2"></i>Buku Berhasil Dikembalikan.
  </div>');

        // redirect('Admin/peminjaman');  
        redirect($_SERVER['HTTP_REFERER']);
    }
}
