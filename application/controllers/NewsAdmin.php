<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class NewsAdmin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper('url', 'session');
    $this->load->model('news_model');
  }

  public function index()
  {
    $data = array(
      'title' => 'Manajemen News'
    );

    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/layout/sidebar');
    $this->load->view('admin/news/index');
    $this->load->view('admin/layout/footer');
  }

  public function datatables()
  {
    // Get the data from the model
    $news = $this->news_model->get_news();

    // Modify the data to set custom IDs
    $modifiedNews = array();
    foreach ($news as $index => $row) {
      $row['DT_RowId'] = 'row_' . ($index + 1); // Set unique row ID for DataTables
      $modifiedNews[] = $row;
    }

    // Prepare the response data in the format expected by DataTables
    $data = array(
      'draw' => 1, // Required for DataTables to know how many times data has been redrawn
      'recordsTotal' => count($news),
      'recordsFiltered' => count($news),
      'data' => $modifiedNews,
    );

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
  }

  public function form_add()
  {
    $data = array(
      'title' => 'Tambah News'
    );

    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/layout/sidebar');
    $this->load->view('admin/news/form_add');
    $this->load->view('admin/layout/footer');
  }

  public function add()
  {
    $data = array(
      'judul' => $this->input->post('judul'),
      'isi' => $this->input->post('isi'),
      'penulis' => $this->input->post('penulis'),
      'tanggal_posting' => $this->input->post('tanggal_posting')
    );

    // Upload gambar
    $config['upload_path'] = FCPATH . '/assets/uploads/cms/image/news/';
    // $config['upload_path'] = APPPATH . '/uploads';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = 2048; // 2MB
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('gambar')) {
      $upload_data = $this->upload->data();
      $data['gambar'] = $upload_data['file_name'];

      // Panggil method pada model untuk menambah berita ke database
      $result = $this->news_model->create_news($data);

      if ($result !== null) {
        // Jika berhasil tambah berita, kirim response berhasil
        if ($result) {
          $msg = array(
            'status' => 200,
            'message' => 'Tambah News berhasil!',
          );
        } else {
          $msg = array(
            'status' => 400,
            'message' => 'Gagal menyimpan news. Silahkan coba lagi!',
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

  public function edit($id)
  {
    // Logika untuk menampilkan form edit berita dan menangani perubahan berita ke database
  }

  public function delete($id)
  {
    // Logika untuk menghapus berita dari database
  }
}
