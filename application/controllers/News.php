<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
  }

  public function index()
  {
    $data['title'] = 'News';
    $data['active'] = 'news';

    $this->load->view('frontend/layout/header', $data);
    $this->load->view('frontend/news');
    $this->load->view('frontend/layout/footer');
  }

  public function _news()
  {
    $json_data = file_get_contents('http://localhost/gentara/news/26/gentara/');

    $data = json_decode($json_data, true);

    $data['title'] = 'News';
    $data['active'] = 'News';

    $this->load->view('frontend/layout/header', $data);
    $this->load->view('frontend/_news');
    $this->load->view('frontend/layout/footer');
  }
}
