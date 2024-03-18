<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->database();
    $this->load->model('Auth_model');
    $this->load->library('session');
  }

  public function dashboard()
  {
    // Periksa apakah pengguna sudah login
    if ($this->session->userdata('logged_in')) {
      // Pengguna telah login, lakukan tindakan yang sesuai
      $data['users'] = $this->session->userdata('user_id');
      // Lakukan semua tindakan yang sesuai dengan pengguna yang sudah masuk di sini
    } else {
      // Pengguna belum login, lakukan tindakan lain
      redirect('auth'); // Redirect ke halaman login jika belum login
      return; // Ini untuk menghentikan eksekusi kode selanjutnya agar tampilan admin tidak dimuat
    }

    $data = array(
      'title' => 'Dashboard',
    );
    $data['users'] = $this->session->userdata('user_id');

    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/layout/sidebar');
    $this->load->view('admin/dashboard');
    $this->load->view('admin/layout/footer', $data);
  }
}
