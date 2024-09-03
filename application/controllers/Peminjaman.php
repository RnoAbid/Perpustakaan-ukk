<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        if ($this->session->userdata('level') == NULL) {
            redirect('auth');
        }
    }


    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        // Mengambil data buku dari database
        $this->db->from('buku')->where('status', 'Tersedia');
        $buku = $this->db->get()->result_array();

        $this->db->from('peminjaman a');
        $this->db->join('buku b', 'a.id_buku=b.id_buku')->join('kategoribuku c','c.id_kategori=b.id_kategori');
        $detail = $this->db->get()->result_array();

        // Data yang akan dikirim ke view
        $data = array(
            'judul_halaman' => 'Peminjaman',
            'icon'    => "DIGITAL LIBRARY📚",
            'buku' => $buku,
            'id_user' => $id_user,
            'detail' => $detail,

        );

        // Memuat view dengan data
        $this->template->load('template_user', 'pinjaman_buku', $data);
    }

        
    public function addcart()
        {
            date_default_timezone_set('Asia/Jakarta');
            $user = $this->session->userdata('id_user');
            $buku = $this->input->post('id_buku');
            $data = array(
                'id_user'    => $user,
                'id_buku'   => $buku,
            );
            $this->db->insert('temp', $data);
    
            $this->session->set_flashdata('alert', '
            <div class="alert alert-success" role="alert">
            Berhasil Memasukkan buku ke Cart.
            </div>
            ');
            redirect($_SERVER['HTTP_REFERER']);
        }           
            
     

     public function keranjang(){
            $cart = $this->db->from('temp a')->join('buku b','a.id_buku=b.id_buku')->join('user c','a.id_user=c.id_user')->join('kategoribuku d','b.id_kategori=d.id_kategori')->get()->result_array();
            $data = array(
                'cart'  => $cart,
                'judul_halaman'  => 'Cart',
            'icon'  => "DIGITAL LIBRARY📚",
            );
            $this->template->load('template_user','cart',$data);
        }

    public function tambah_pinjam(){
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m');
            $this->db->where("DATE_FORMAT(tanggal_awal,'%Y-%m')", $tanggal)->from('peminjaman');
            $jumlah = $this->db->count_all_results();
            $kode_peminjaman = date('ymd') . $jumlah + 1;
        
                $temp = $this->db->join('buku', 'temp.id_buku = buku.id_buku')->where('id_user', $this->session->userdata('id_user'))->get('temp')->result_array();
                foreach ($temp as $value) {
                // input Table peminjaman
                $data = [
                    'kode' => $kode_peminjaman,
                    'id_buku'         => $value['id_buku'],
                    'id_user'         => $value['id_user'],
                    'status_peminjaman'         => 'dipinjam',
                    'tanggal_peminjaman' => $this->input->post('tanggal_peminjaman'),
                    // 'tanggal_pengembalian' =>  date('Y-m-d', strtotime('+14 days')),
                ];
                $this->db->insert('detail_peminjaman', $data);
        
                // Update Stok Buku
                $data2  = ['stok' => $value['stok'] - 1];
                $where1 = ['id_buku' => $value['id_buku']];
                $this->db->update('buku', $data2, $where1);
                // hapus table temp
                $where2 = ['id_user' => $this->session->userdata('id_user')];
                $this->db->delete('temp', $where2);
            }
                $data3 = [
                    'kode' => $kode_peminjaman,
                    'tanggal_awal' => $this->input->post('tanggal_peminjaman'),
                    'tanggal_akhir' => date('Y-m-d', strtotime('+14 days')),
                    'id_user' => $this->session->userdata('id_user'),
                ];
                $this->db->insert('peminjaman', $data3);
        
                $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>Berhasil Pinjam Buku
          </div>');
          redirect('dashboard_user');
    }
 


    public function tambah_koleksi()
    {
        $data = array(
            'id_user' => $this->input->post('id_user'),
            'id_buku' => $this->input->post('id_buku'),
        );

        $this->db->insert('koleksipribadi', $data); // Assuming you have a 'koleksi' table
        $this->session->set_flashdata('alert', '
        <div class="alert alert-success" role="alert">
        Buku berhasil ditamkan ke koleksi pribadi.
        </div>
    ');
        redirect($_SERVER["HTTP_REFERER"]);
    }
    public function lihat_koleksi()
    {
        $id_user = $this->session->userdata('id_user');

        // Mengambil data koleksi dari database
        $this->db->select('k.*, b.judul, b.deskripsi, b.foto, kb.kategori as nama_kategori');
        $this->db->from('koleksipribadi k');
        $this->db->join('buku b', 'k.id_buku = b.id_buku');
        $this->db->join('kategoribuku kb', 'b.id_kategori = kb.id_kategori'); // Make sure this join matches your schema
        $this->db->where('k.id_user', $id_user);
        $koleksi = $this->db->get()->result_array();

        // Data yang akan dikirim ke view
        $data = array(
            'judul_halaman' => 'Koleksi Buku Saya',
            'koleksi' => $koleksi,
            'icon' => "DIGITAL LIBRARY📚",
        );

        // Memuat view dengan data
        $this->template->load('template_user', 'lihat_koleksi', $data);
    }
    public function hapus_dari_koleksi($id_koleksi)
    {
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }

        // Delete the entry from the koleksi table
        $this->db->where('id_koleksi', $id_koleksi);
        $this->db->delete('koleksipribadi');

        // Set a flash message
        $this->session->set_flashdata('alert', '
        <div class="alert alert-success" role="alert">
        Buku berhasil dihapus dari koleksi pribadi.
        </div>
    ');

        // Redirect back to the koleksi page
        redirect('peminjaman/lihat_koleksi');
    }
}
