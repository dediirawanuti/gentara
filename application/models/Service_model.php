<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function get_service()
  {
    $query = $this->db->get("service");

    if ($query) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function create_service($data)
  {
    $this->db->insert('service', $data);
    return $this->db->insert_id();
  }
}
