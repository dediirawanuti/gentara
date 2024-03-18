<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logo_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function get_logo()
  {
    $query = $this->db->get('logo');

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      // Jika tidak ada data pengguna, kembalikan array kosong
      return array();
    }
  }

  public function create_logo($data)
  {
    $this->db->insert('logo', $data);
    return $this->db->insert_id();
  }

  public function update_logo($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update('logo', $data);
  }

  public function get_logo_by_id($id)
  {
    $query = $this->db->get_where('logo', array('id' => $id));
    return $query->row_array();
  }

  public function delete_logo($id) {
    return $this->db->delete('logo', array('id' => $id));
  }
}
