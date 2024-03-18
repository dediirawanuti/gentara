<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->database();
    $this->load->model('auth_model');
    $this->load->library('session');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data = array(
      'title' => 'Login Page'
    );
    $this->load->view('admin/layout/_header', $data);
    $this->load->view('auth/login');
    $this->load->view('admin/layout/_footer');
  }

  public function login()
  {

    if ($this->input->is_ajax_request()) {
      $email_username = $this->input->post('email_username');
      $password = $this->input->post('password');

      $data = $this->auth_model->get_user_by_username_or_email($email_username);

      if ($data) {
        $pass = $data->password;
        $verify_pass = password_verify($password, $pass);

        if ($verify_pass) {
          $session_data = array(
            'id'       => $data->id,
            'nama'     => $data->nama,
            'username' => $data->username,
            'email'    => $data->email,
            'role' => $data->role,
            'logged_in' => TRUE
          );
          $this->session->set_userdata($session_data);

          $response = array(
            'status' => 200,
            'message' => 'Berhasil login!',
            // 'redirect' => ($data->role == 'admin') ? site_url('admin/dashboard') : site_url()
          );
        } else {
          $response = array(
            'status' => 401,
            'message' => 'Password Anda salah!'
          );
        }
      } else {
        $response = array(
          'status' => 401,
          'message' => 'Email atau username tidak ditemukan!'
        );
      }

      echo json_encode($response);
    }
  }

  public function form_registrasi()
  {
    $data['title'] = 'Registrasi';

    $this->load->view('admin/layout/_header', $data);
    $this->load->view('auth/registrasi');
    $this->load->view('admin/layout/_footer');
  }

  public function register()
  {
    if ($this->input->is_ajax_request()) {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|is_unique[users.username]');
      $this->form_validation->set_rules('nama', 'Nama', 'required|alpha_numeric|is_unique[users.nama]');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if ($this->form_validation->run() == FALSE) {
        $msg = array(
          'error' => array(
            'nama' => form_error('nama'),
            'username' => form_error('username'),
            'email' => form_error('email'),
            'password' => form_error('password'),
            'role' => form_error('role'),
          )
        );
      } else {
        $data = array(
          'nama' => $this->input->post('nama'),
          'username' => $this->input->post('username'),
          'email' => $this->input->post('email'),
          'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
          'role' => $this->input->post('role')
        );

        $user_id = $this->auth_model->create_user($data);

        if ($user_id !== null) {
          if ($user_id) {
            $msg = array(
              'status' => 200,
              'message' => 'Registrasi berhasil! Silakan masuk menggunakan akun baru Anda.',
            );
          } else {
            $msg = array(
              'status' => 400,
              'message' => 'Gagal menyimpan pengguna. Silakan coba lagi.'
            );
          }
        } else {
          $msg = array(
            'status' => 500,
            'message' => 'Gagal menyimpan pengguna. Silakan coba lagi.'
          );
        }
      }

      echo json_encode($msg);
    }
  }

  public function form_edit($id)
  {

    $users = $this->auth_model->get_users($id);

    $data['title'] = 'Edit';
    $data['users'] = $users;

    $this->load->view('admin/layout/_header', $data);
    $this->load->view('auth/edit', $data);
    $this->load->view('admin/layout/_footer');
  }

  public function edit($user_id)
  {
    // Periksa apakah pengguna telah masuk
    if ($this->input->is_ajax_request()) {
      // Load library form_validation
      $this->load->library('form_validation');

      // Tetapkan aturan validasi untuk kolom-kolom yang ingin diubah
      $this->form_validation->set_rules('nama', 'Nama', 'required|alpha_numeric');
      $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

      if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal, kirimkan pesan error
        $msg = array(
          'error' => array(
            'nama' => form_error('nama'),
            'username' => form_error('username'),
            'email' => form_error('email'),
          )
        );
      } else {
        // Buat array data berdasarkan input yang diterima
        $data = array(
          'nama' => $this->input->post('nama'),
          'username' => $this->input->post('username'),
          'email' => $this->input->post('email'),
        );

        // Panggil model untuk memperbarui pengguna
        $success = $this->auth_model->update_user($user_id, $data);

        if ($success) {
          // Jika pembaruan berhasil
          $msg = array(
            'status' => 200,
            'message' => 'Informasi pengguna berhasil diperbarui!'
          );
        } else {
          // Jika gagal memperbarui pengguna
          $msg = array(
            'status' => 400,
            'message' => 'Gagal memperbarui informasi pengguna. Silakan coba lagi.'
          );
        }
      }

      // Mengirimkan respons dalam format JSON
      echo json_encode($msg);
    }
  }



  public function logout()
  {
    // Menghapus data sesi
    $this->session->unset_userdata('logged_in');
    $this->session->unset_userdata('user_id');

    // Redirect ke halaman login
    redirect(base_url('auth'));
  }
}
