<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends CI_Model
{
    public function get_all_buku()
    {
        $this->db->from('buku a');
        $this->db->join('kategoribuku b', 'a.id_kategori = b.id_kategori', 'left');
        $this->db->select('a.*, b.kategori');  // Pastikan nama kolom sesuai
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_all_kategori()
    {
        return $this->db->get('kategoribuku')->result_array();
    }

    public function get_avg_ratings()
    {
        $this->db->select('id_buku, AVG(rating) as avg_rating');
        $this->db->from('ulasan');
        $this->db->group_by('id_buku');
        return $this->db->get()->result_array();
    }

    public function get_buku_by_id($id)
    {
        return $this->db->from('buku')->where('id_buku', $id)->get()->row();
    }

    public function get_ulasan_by_buku($id)
    {
        $this->db->from('ulasan a');
        $this->db->join('user b', 'a.id_user=b.id_user');
        $this->db->where('a.id_buku', $id);
        return $this->db->get()->result_array();
    }

    public function insert_buku($data)
    {
        return $this->db->insert('buku', $data);
    }

    public function delete_buku($id)
    {
        $buku = $this->db->select('foto')->from('buku')->where('id_buku', $id)->get()->row();
        if ($buku && file_exists(FCPATH . 'assets/upload/buku/' . $buku->foto)) {
            unlink(FCPATH . 'assets/upload/buku/' . $buku->foto);
        }
        return $this->db->delete('buku', array('id_buku' => $id));
    }

    public function update_buku($id_buku, $data, $foto_lama)
    {
        // Memproses upload foto jika ada
        $foto = $_FILES['foto']['name'];
        if ($foto) {
            $config['upload_path'] = './assets/upload/buku/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = date('YmdHis') . '_' . $foto;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $foto_baru = $this->upload->data('file_name');

                // Hapus foto lama jika ada
                if (file_exists(FCPATH . 'assets/upload/buku/' . $foto_lama)) {
                    unlink(FCPATH . 'assets/upload/buku/' . $foto_lama);
                }
            } else {
                // Mengembalikan error jika upload gagal
                return ['status' => 'error', 'message' => $this->upload->display_errors()];
            }
        } else {
            // Jika tidak ada foto baru, gunakan foto lama
            $foto_baru = $foto_lama;
        }

        $data['foto'] = $foto_baru;

        // Update data buku di database
        $this->db->where('id_buku', $id_buku);
        $this->db->update('buku', $data);

        return ['status' => 'success', 'message' => 'Data berhasil diperbarui.'];
    }
}
