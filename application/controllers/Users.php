<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('Auth_model');
    $this->load->library('form_validation');
    $this->load->library('session');
  }

  public function index()
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
      'title' => 'Data Users'
    );
    // $data['users'] = $this->session->userdata('users');

    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/layout/sidebar');
    $this->load->view('admin/users/index');
    $this->load->view('admin/layout/footer', $data);
  }

  public function datatables()
  {
    // Load the necessary model
    $this->load->model('Auth_model');

    // Get the data from the model
    $users = $this->Auth_model->get_users();
    // Modify the data to set custom IDs
    $modifiedUsers = array_map(function ($user, $index) {
      $user['no'] = $index + 1;
      return $user;
    }, $users, array_keys($users));


    // Prepare the response data in the format expected by DataTables
    $data = array(
      'recordsTotal' => count($users),
      'recordsFiltered' => count($users),
      'data' => $modifiedUsers,
    );

    // Send the JSON response back to DataTables
    header('Content-Type: application/json');
    echo json_encode($data);
  }

  // public function form_add()
  // {
  //   // Periksa apakah pengguna sudah login
  //   // Periksa apakah pengguna sudah login
  //   if (!$this->session->userdata('logged_in')) {
  //     // Pengguna belum login, redirect ke halaman login
  //     redirect('auth');
  //     return; // Ini untuk menghentikan eksekusi kode selanjutnya agar tampilan admin tidak dimuat
  //   }

  //   $data['title'] = 'Tambah User';

  //   // Load view for add user form
  //   $this->load->view('admin/layout/header', $data);
  //   $this->load->view('admin/layout/sidebar');
  //   $this->load->view('admin/users/form_add', $data);
  //   $this->load->view('admin/layout/footer');
  // }

  public function form_add()
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

    $id = $this->input->post('id');

    if ($id != '') {
      $this->load->library('encryption');
      $data['title'] = 'Ubah User';
      $user = $this->Auth_model->get_users_by_id($id);

      if ($user->role == 'admin') {
        $data['sel_admin'] = "selected";
        $data['sel_user'] = "";
      } else {
        $data['sel_admin'] = "";
        $data['sel_user'] = "selected";
      }

      // var_dump($user);die;
      $data['users'] = $user;
      $data['encId'] = $this->encryption->encrypt($id);

      $this->load->view('admin/users/form_edit', $data);
    } else {
      $data['title'] = 'Tambah User';
      $this->load->view('admin/users/form_add', $data);
    }

    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/layout/sidebar');

    $this->load->view('admin/layout/footer');
  }

  public function add()
  {
    $data = array(
      'nama' => $this->input->post('nama'),
      'username' => $this->input->post('username'),
      'email' => $this->input->post('email'),
      'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      'role' => $this->input->post('role'),
      'created_at' => date('Y-m-d H:i:s')
    );

    $result = $this->Auth_model->add_user($data);
    echo json_encode($result);
  }

  // public function form_edit($id)
  // {
  //   // Periksa apakah pengguna sudah login
  //   if ($this->session->userdata('logged_in')) {
  //     // Pengguna telah login, lakukan tindakan yang sesuai
  //     $user_id = $this->session->userdata('user_id');
  //     // Lakukan semua tindakan yang sesuai dengan pengguna yang sudah masuk di sini
  //   } else {
  //     // Pengguna belum login, lakukan tindakan lain
  //     redirect('auth'); // Redirect ke halaman login jika belum login
  //     return; // Ini untuk menghentikan eksekusi kode selanjutnya agar tampilan admin tidak dimuat
  //   }

  //   // Load the necessary model
  //   $this->load->model('Auth_model');

  //   // Get the user data based on the ID
  //   $user = $this->Auth_model->get_users($id);

  //   // Pass the user data to the view
  //   $data['users'] = $user;
  //   $data['roles'] = $this->Auth_model->get_all_roles();

  //   // Load the view for the form edit page
  //   $this->load->view('admin/layout/_header', $data);
  //   $this->load->view('admin/layout/_sidebar');
  //   $this->load->view('admin/user/form_edit');
  //   $this->load->view('admin/layout/_footer');
  // }

  public function update()
  {
    $this->load->library('encryption');
    $encId = $this->input->post('id');
    $id = $this->encryption->decrypt($encId);

    $data = array(
      'nama' => $this->input->post('nama'),
      'username' => $this->input->post('username'),
      'email' => $this->input->post('email'),
      'role' => $this->input->post('role'),
      'updated_at' => date('Y-m-d H:i:s')
    );

    $result = $this->Auth_model->update_user($id, $data);
    echo json_encode($result);
  }

  public function delete()
  {
    $id = $this->input->post('id');
    $result = $this->Auth_model->delete_user($id);
    echo json_encode($result);
  }

  // private function upload_photo()
  // {
  //   $config['upload_path'] = 'assets/cms/img/profile';
  //   $config['allowed_types'] = 'jpg|jpeg|png';
  //   $config['encrypt_name'] = TRUE;

  //   $this->load->library('upload', $config);

  //   if ($this->upload->do_upload('foto')) {
  //     $data = $this->upload->data();
  //     return $data['file_name'];
  //   } else {
  //     return '';
  //   }
  // }
  private function upload_photo()
  {
    $config['upload_path'] = 'assets/cms/img/profile';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    // Jika ada foto baru yang diunggah
    if ($this->upload->do_upload('foto')) {
      $data = $this->upload->data();
      return $data['file_name'];
    } else {
      // Jika tidak ada foto baru yang diunggah, cek apakah foto lama sudah ada
      $old_photo = $this->input->post('old_photo');
      if (!empty($old_photo)) {
        // Jika foto lama ada, kembalikan foto lama
        return $old_photo;
      } else {
        // Jika tidak ada foto lama, kembalikan string kosong
        return '';
      }
    }
  }
}
