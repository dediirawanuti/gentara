<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CtaSosmed extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('cta_model');
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
      'title' => 'Data CTA Sosmed'
    );

    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/layout/sidebar');
    $this->load->view('admin/cta/index');
    $this->load->view('admin/layout/footer');
  }

  public function form()
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
      $data['title'] = 'Ubah CTA';
      $cta = $this->cta_model->get_cta_by_id($id);

      $data['cta'] = $cta;
      $data['encId'] = $this->encryption->encrypt($id);

      $this->load->view('admin/cta/form_edit', $data);
    } else {
      $data['title'] = 'Tambah CTA';
      $this->load->view('admin/cta/form_add', $data);
    }

    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/layout/sidebar');

    $this->load->view('admin/layout/footer');
  }

  // public function form_add()
  // {
  //   $data = array(
  //     'title' => 'Tambah CTA'
  //   );
  //   $this->load->view('admin/layout/header', $data);
  //   $this->load->view('admin/layout/sidebar',);
  //   $this->load->view('admin/cta/form_add');
  //   $this->load->view('admin/layout/footer');
  // }

  public function add()
  {
    $data = array(
      'nama' => $this->input->post('nama'),
      'link' => $this->input->post('link')
    );

    $result = $this->cta_model->create_cta($data);

    if ($result !== null) {
      if ($result) {
        $msg = array(
          'status' => 200,
          'message' => 'Tambah CTA berhasil!',
        );
      } else {
        $msg = array(
          'status' => 400,
          'message' => 'Gagal menyimpan CTA. Silahkan coba lagi!',
        );
      }
    } else {
      $msg = array(
        'status' => 500,
        'message' => 'Error Server!',
      );
    }

    echo json_encode($msg);
  }

  public function datatables()
  {
    $cta = $this->cta_model->get_cta();

    $modifiedCta = array();

    foreach ($cta as $index => $row) {
      $row['DT_RowId'] = 'row_' . ($index + 1);

      $modifiedCta[] = $row;
    }

    $data = array(
      'recordsTotal' => count($cta),
      'recordsFiltered' => count($cta),
      'data' => $modifiedCta,
      'draw' => 1,
    );

    header('Content-Type: application/json');
    echo json_encode($data);
  }

  public function form_edit($id)
  {

    $data = array(
      'title' => 'Ubah CTA',
    );;
    $cta = $this->cta_model->get_cta_by_id($id);
    $data['cta'] = $cta;

    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/layout/sidebar',);
    $this->load->view('admin/cta/form_edit', $data);
    $this->load->view('admin/layout/footer',);
  }

  // public function update()
  // {
  //   $this->load->library('encryption');
  //   $encId = $this->input->post('id');
  //   $id = $this->encryption->decrypt($encId);

  //   $data = array(
  //     'nama' => $this->input->post('nama'),
  //     'link' => $this->input->post('link'),
  //     // 'updated_at' => date('Y-m-d H:i:s')
  //   );
  //   // Data ditemukan, lakukan operasi update
  //   $result = $this->cta_model->update_cta($id, $data);

  //   if ($result !== null) {
  //     if ($result) {
  //       $msg = array(
  //         'status' => 200,
  //         'message' => 'Ubah CTA berhasil!',
  //       );
  //     } else {
  //       $msg = array(
  //         'status' => 400,
  //         'message' => 'Gagal menyimpan CTA. Silahkan coba lagi!',
  //       );
  //     }
  //   } else {
  //     $msg = array(
  //       'status' => 500,
  //       'message' => 'Error Server!',
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
      'link' => $this->input->post('link'),
      // 'updated_at' => date('Y-m-d H:i:s')
    );

    $result = $this->cta_model->update_cta($id, $data);
    echo json_encode($result);
  }
}
