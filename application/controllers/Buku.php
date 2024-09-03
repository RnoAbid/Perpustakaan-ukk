<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
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
        $this->db->from('buku a')->join('kategoribuku b', 'a.id_kategori=b.id_kategori', 'left');
        $buku = $this->db->get()->result_array();
        $this->db->from('kategoribuku');
        $kategori = $this->db->get()->result_array();
        $this->db->select('id_buku, AVG(rating) as avg_rating');
        $this->db->from('ulasan');
        $this->db->group_by('id_buku');
        $ulasan = $this->db->get()->result_array();

        // Buat array asosiasi untuk rata-rata rating per id_buku
        $avg_ratings = [];
        foreach ($ulasan as $row) {
            $avg_ratings[$row['id_buku']] = $row['avg_rating'];
        }

        $data = array(
            'kategori' => $kategori,
            'judul_halaman' => 'Halaman Depan',
            'buku'  => $buku,
            'avg_ratings' => $avg_ratings,
        );
        $this->template->load('template', 'buku', $data);
    }

    public function ulasan($id)
    {
        $buku = $this->db->from('buku')->where('id_buku', $id)->get()->row();
        $this->db->from('ulasan a')->join('user b', 'a.id_user=b.id_user')->where('id_buku', $id);
        $ulasan = $this->db->get()->result_array();
        $data = array(
            'buku' => $buku,
            'ulasan' => $ulasan,
            'judul_halaman' => 'Halaman Ulasan dari User'
        );
        $this->template->load('template', 'ulasan_admin', $data);
    }

    public function tambah()
    {
        $config['upload_path'] = 'assets/upload/buku/';
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
            'stok'           => $this->input->post('stok'),
            'id_kategori' => $this->input->post('id_kategori')
        );

        $this->db->insert('buku', $data);
        $this->session->set_flashdata('alert', '
        <div class="alert alert-success" role="alert">
        Data Berhasil Ditambahkan.
        </div>
    ');
        redirect('buku');
    }



    public function hapus($id)
    {
        $where = array(
            'id_buku' => $id // Ganti 'id_kategori' menjadi 'id_buku'
        );
        $this->db->delete('buku', $where); // Hapus dari tabel buku, bukan kategoribuku
        $this->session->set_flashdata('alert', '
        <div class="alert alert-success" role="alert">
        Berhasil Menghapus Data.
        </div>
        ');
        redirect('buku'); // Redirect ke 'buku', bukan 'kategori'
    }

    public function edit()
    {
        $judul = $this->input->post('judul');
        $penulis = $this->input->post('penulis');
        $penerbit = $this->input->post('penerbit');
        $tahunterbit = $this->input->post('tahunterbit');
        $deskripsi = $this->input->post('deskripsi');
        $stok = $this->input->post('stok');
        $id_kategori = $this->input->post('id_kategori');
        $foto_lama = $this->input->post('foto_lama');  // Pastikan foto_lama diterima

        $foto = $_FILES['foto']['name'];
        if ($foto) {
            $config['upload_path'] = './assets/upload/buku';
            $config['allowed_types'] = 'jpg|png|jpeg';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $foto_baru = $this->upload->data('file_name');
                if (file_exists(FCPATH . 'assets/upload/buku/' . $foto_lama)) {
                    unlink(FCPATH . 'assets/upload/buku/' . $foto_lama);
                }
            } else {
                echo "Upload Gagal";
                die();
            }
        } else {
            $foto_baru = $foto_lama;  // Gunakan foto lama jika tidak ada foto baru
        }

        $data = array(
            'judul' => $judul,
            'penulis' => $penulis,
            'penerbit' => $penerbit,
            'tahunterbit' => $tahunterbit,
            'deskripsi' => $deskripsi,
            'foto' =>  $foto_baru,  // Pastikan foto yang digunakan benar
            'stok' => $stok,
            'id_kategori' => $id_kategori
        );

        $where = array(
            'id_buku' => $this->input->post('id_buku')
        );

        $this->db->update('buku', $data, $where);

        $this->session->set_flashdata('alert', '
            <div class="alert alert-success" role="alert">
            Berhasil Memperbarui Data
            </div>
        ');

        redirect('buku');
    }
}
