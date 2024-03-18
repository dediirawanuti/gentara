<?php
defined('BASEPATH') or exit('No direct script access allowed');

class E_404 extends CI_Controller
{
  public function index() {
    $this->load->view('frontend/e404');
  }
}