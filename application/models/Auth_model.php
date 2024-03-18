<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function create_user($data)
  {
    $this->db->insert('users', $data);
    return $this->db->insert_id();
  }

  public function get_user_by_username_or_email($email_username)
  {
    $this->db->where('username', $email_username);
    $this->db->or_where('email', $email_username);
    return $this->db->get('users')->row();
  }

  public function get_users()
  {
    $query = $this->db->get('users');

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      // Jika tidak ada data pengguna, kembalikan array kosong
      return array();
    }
  }

  public function get_users_by_id($id)
  {
    $query = $this->db->get_where('users', array('id' => $id));
    return $query->row_array();
  }

  public function add_user($data)
  {
    $this->db->insert('users', $data);
    return ($this->db->affected_rows() != 1) ? false : true;
  }

  public function update_user($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update('users', $data);
  }

  public function delete_user($id)
  {
    return $this->db->delete('users', array('id' => $id));
  }

  public function get_all_roles()
  {
    $this->db->select('role');
    $this->db->distinct();
    $query = $this->db->get('users');
    return $query->result_array();
  }

  public function get_username($user_id)
  {
    $query = $this->db->get_where('users', array('id' => $user_id));
    return $query->row()->nama;
  }
}
