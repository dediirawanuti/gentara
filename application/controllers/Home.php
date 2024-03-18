<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
  }

  public function index()
  {
    $data['title'] = 'Homepage';
    $data['active'] = 'homepage';

    $this->load->view('frontend/layout/header', $data);
    $this->load->view('frontend/homepage');
    $this->load->view('frontend/layout/footer');
  }
}