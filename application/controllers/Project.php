<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
  }

  public function index()
  {
    $data['title'] = 'Project';
    $data['active'] = 'project';

    $this->load->view('frontend/layout/header', $data);
    $this->load->view('frontend/project');
    $this->load->view('frontend/layout/footer');
  }
}
