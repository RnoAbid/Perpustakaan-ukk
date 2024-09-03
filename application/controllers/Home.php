<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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

        );
        $this->template->load('template','dashboard', $data);
	}
}
