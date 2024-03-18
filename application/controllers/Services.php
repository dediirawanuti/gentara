<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
  }

  public function index()
  {
    $data = array(
      'title' => 'Services',
      'active' => 'services'
    );

    $this->load->view('frontend/layout/header', $data);
    $this->load->view('frontend/services');
    $this->load->view('frontend/layout/footer');
  }
}
