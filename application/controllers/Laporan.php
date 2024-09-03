<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
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
            'judul_halaman' => 'Laporan',

        );
        $this->template->load('template', 'laporan', $data);
    }


    public function tanggal()
    {
        $awal = $this->input->post('tanggal_peminjaman');
        $akhir = $this->input->post('tanggal_pengembalian');
        $laporan = $this->db
            ->from('detail_peminjaman a')
            ->join('user b', 'a.id_user=b.id_user')
            ->join('buku c', 'a.id_buku=c.id_buku')
            ->where('a.tanggal_peminjaman >=', $awal)
            ->where('a.tanggal_pengembalian <=', $akhir)
            ->get()
            ->result_array();

        $data = array(
            'laporan' => $laporan,
            'judul_halaman' => 'Laporan Data Peminjaman',
            'awal' => $this->input->post('tanggal_peminjaman'),
            'akhir' => $this->input->post('tanggal_pengembalian'),
        );

        $this->load->view('laporan', $data);
    }

    public function nama()
    {
        $awal = $this->input->post('tanggal_peminjaman');
        $akhir = $this->input->post('tanggal_pengembalian');
        $nama = $this->input->post('nama');
        $laporan = $this->db
            ->from('detail_peminjaman a')
            ->join('user b', 'a.id_user=b.id_user')
            ->join('buku c', 'a.id_buku=c.id_buku')
            ->where('a.tanggal_peminjaman >=', $awal)
            ->where('a.tanggal_peminjaman <=', $akhir)
            ->get()
            ->result_array();

        $data = array(
            'laporan' => $laporan,
            'judul_halaman' => 'Laporan Data Peminjaman',
            'awal' => $this->input->post('tanggal_peminjaman'),
            'akhir' => $this->input->post('tanggal_pengembalian'),
            'nama' => $this->input->post('nama'),
        );

        $this->load->view('laporan', $data);
    }
}
