<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ServiceAdmin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('service_model');
    $this->load->library('session');
    $this->load->helper('url');
  }

  public function index()
  {
    $data = array(
      'title' => 'Manajemen Service'
    );

    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/layout/sidebar');
    $this->load->view('admin/service/index');
    $this->load->view('admin/layout/footer');
  }

  public function datatables()
  {
    $service = $this->service_model->get_service();

    $modifiedService = array();
    foreach ($service as $index => $row) {
      $row['DT_RowId'] = 'row_' . ($index + 1);
      $modifiedService[] = $row;
    }
    $data = array(
      'draw' => 1,
      'recordTotal' => count($service),
      'recordFiltered' => count($service),
      'data' => $modifiedService
    );

    header('Content-Type: application/json');
    echo json_encode($data);
  }

  public function form_add()
  {
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
      'title' => 'Tambah Service'
    );

    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/layout/sidebar');
    $this->load->view('admin/service/form_add');
    $this->load->view('admin/layout/footer');
  }

  public function add()
  {
    $data = array(
      'judul' => $this->input->post('judul'),
      'isi' => $this->input->post('isi')
    );

    $config['upload_path'] = FCPATH . '/assets/uploads/cms/image/service/';
    $config['allowed_types'] = 'gift|jpg|png|jpeg';
    $config['max_size'] = 2048;
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('gambar')) {
      $upload_data = $this->upload->data();
      $data['gambar'] = $upload_data['file_name'];

      $result = $this->service_model->create_service($data);

      if ($result !== null) {
        if ($result) {
          $msg = array(
            'status' => 200,
            'message' => 'Tambah Service berhasil!'
          );
        } else {
          $msg = array(
            'status' => 400,
            'message' => 'Gagal menyimpan service. Silahkan coba lagi!'
          );
        }
      } else {
        $msg = array(
          'status' => 500,
          'message' => 'Error menyimpan foto!'
        );
      } 
    } else {
      $msg = array(
        'status' => 400,
        'message' => $this->upload->display_errors()
      );
    }
    echo json_encode($msg);
  }


}
