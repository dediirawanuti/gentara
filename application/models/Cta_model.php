<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cta_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function create_cta($data)
  {
    $this->db->insert('cta', $data);
    return $this->db->insert_id();
  }

  public function get_cta()
  {
    $query = $this->db->get('cta');

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array();
    }
  }

  public function get_cta_by_id($id)
  {
    $this->db->select('id, nama, link, updated_at');
    $this->db->where('id', $id);
    return $this->db->get('cta')->row();
  }

  public function update_cta($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update('cta', $data);
  }
}
