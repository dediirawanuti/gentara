<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logo extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('logo_model');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->database();
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
      'title' => 'Data Logo'
    );

    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/layout/sidebar');
    $this->load->view('admin/logo/index');
    $this->load->view('admin/layout/footer');
  }

  public function datatables()
  {
    // Load the necessary model
    $this->load->model('logo_model');

    // Get the data from the model
    $logo = $this->logo_model->get_logo();

    // Modify the data to set custom IDs
    $modifiedLogo = array();
    foreach ($logo as $index => $row) {
      $row['DT_RowId'] = 'row_' . ($index + 1); // Set unique row ID for DataTables
      $modifiedLogo[] = $row;
    }

    // Prepare the response data in the format expected by DataTables
    $data = array(
      'draw' => 1, // Required for DataTables to know how many times data has been redrawn
      'recordsTotal' => count($logo),
      'recordsFiltered' => count($logo),
      'data' => $modifiedLogo,
    );

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
  }

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
      $logo = $this->logo_model->get_logo_by_id($id);

      $data['logo'] = $logo;
      $data['encId'] = $this->encryption->encrypt($id);

      $this->load->view('admin/logo/form_edit', $data);
    } else {
      $data['title'] = 'Tambah User';
      $this->load->view('admin/logo/form_add',  $data);
    }

    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/layout/sidebar');

    $this->load->view('admin/layout/footer');
  }

  public function add()
  {
    $data = array(
      'nama' => $this->input->post('nama'),
      'deskripsi' => $this->input->post('deskripsi'),
      'alt_text' => $this->input->post('alt_text')
    );

    // Upload gambar
    $config['upload_path'] = FCPATH . '/assets/uploads/cms/image/logo/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = 2048; // 2MB
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('gambar')) {
      $upload_data = $this->upload->data();
      $data['gambar'] = $upload_data['file_name'];

      // Panggil method pada model untuk menambah berita ke database
      $result = $this->logo_model->create_logo($data);

      if ($result !== null) {
        // Jika berhasil tambah berita, kirim response berhasil
        if ($result) {
          $msg = array(
            'status' => 200,
            'message' => 'Tambah Logo berhasil!',
          );
        } else {
          $msg = array(
            'status' => 400,
            'message' => 'Gagal menyimpan logo. Silahkan coba lagi!',
          );
        }
      } else {
        // Jika gagal tambah berita, kirim response gagal
        $msg = array(
          'status' => 500,
          'message' => 'Error menyimpan foto',
        );
      }
    } else {
      // Jika gagal upload gambar, kirim response gagal
      $msg = array(
        'status' => 400,
        'message' => $this->upload->display_errors()
      );
    }
    echo json_encode($msg);
  }

  // public function form_edit($id)
  // {
  //   $logos = $this->logo_model->get_logo($id);

  //   $data = array(
  //     'title' => 'Edit Logo',
  //     'logo' => $logos,
  //   );

  //   $this->load->library('encryption');
  //   $encId = $this->input->post('id');
  //   $data['encId'] = $encId;

  //   $this->load->view('admin/layout/header', $data);
  //   $this->load->view('admin/layout/sidebar');
  //   $this->load->view('admin/logo/form_edit');
  //   $this->load->view('admin/layout/footer');
  // }

  // public function update()
  // {
  //   $this->load->library('encryption');
  //   $encId = $this->input->post('id');
  //   $id = $this->encryption->decrypt($encId);

  //   $data = array(
  //     'nama' => $this->input->post('nama'),
  //     'deskripsi' => $this->input->post('deskripsi'),
  //     'alt_text' => $this->input->post('alt_text'),
  //     'updated_at' => date('Y-m-d H:i:s')
  //   );

  //   // Upload gambar
  //   $config['upload_path'] = FCPATH . '/assets/uploads/cms/image/logo/';
  //   $config['allowed_types'] = 'gif|jpg|png|jpeg';
  //   $config['max_size'] = 2048; // 2MB
  //   $config['encrypt_name'] = TRUE;

  //   $this->load->library('upload', $config);

  //   if ($this->upload->do_upload('gambar')) {
  //     $upload_data = $this->upload->data();
  //     $data['gambar'] = $upload_data['file_name'];

  //     // Panggil method pada model untuk menambah berita ke database
  //     $result = $this->logo_model->update_logo($id, $data);

  //     if ($result !== null) {
  //       // Jika berhasil tambah berita, kirim response berhasil
  //       if ($result) {
  //         $msg = array(
  //           'status' => 200,
  //           'message' => 'Ubah Logo berhasil!',
  //         );
  //       } else {
  //         $msg = array(
  //           'status' => 400,
  //           'message' => 'Gagal menyimpan logo. Silahkan coba lagi!',
  //         );
  //       }
  //     } else {
  //       // Jika gagal tambah berita, kirim response gagal
  //       $msg = array(
  //         'status' => 500,
  //         'message' => 'Error menyimpan foto',
  //       );
  //     }
  //   } else {
  //     // Jika gagal upload gambar, kirim response gagal
  //     $msg = array(
  //       'status' => 400,
  //       'message' => $this->upload->display_errors()
  //     );
  //   }
  //   echo json_encode($msg);
  // }

  public function update()
  {
    $this->load->library('encryption');
    $encId = $this->input->post('id');
    $id = $this->encryption->decrypt($encId);

    $data = array(
      'nama' => $this->input->post('nama'),
      'deskripsi' => $this->input->post('deskripsi'),
      'alt_text' => $this->input->post('alt_text')
    );

    // Upload gambar
    $config['upload_path'] = FCPATH . '/assets/uploads/cms/image/logo/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = 2048; // 2MB
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('gambar')) {
      $upload_data = $this->upload->data();
      $data['gambar'] = $upload_data['file_name'];
    }

    // Panggil method pada model untuk update logo di database
    $result = $this->logo_model->update_logo($id, $data);

    if ($result !== null) {
      // Jika berhasil update logo, kirim response berhasil
      if ($result) {
        $msg = array(
          'status' => 200,
          'message' => 'Ubah Logo berhasil!',
        );
      } else {
        $msg = array(
          'status' => 400,
          'message' => 'Gagal menyimpan logo. Silahkan coba lagi!',
        );
      }
    } else {
      // Jika gagal update logo, kirim response gagal
      $msg = array(
        'status' => 500,
        'message' => 'Error menyimpan foto',
      );
    }

    echo json_encode($msg);
  }

  public function delete()
  {
    $id = $this->input->post('id');
    $result = $this->logo_model->delete_logo($id);
    echo json_encode($result);
  }
}
