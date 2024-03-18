<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    // Load database
    $this->load->database();
  }

  public function get_news()
  {
    // Ambil semua berita dari database
    $query = $this->db->get('news');
    return $query->result_array();
  }

  public function create_news($data)
  {
    $this->db->insert('news', $data);
    return $this->db->insert_id();
  }

  public function update_news($data, $id)
  {
    // Logika untuk memperbarui berita di dalam database
  }

  public function delete_news($id)
  {
    // Logika untuk menghapus berita dari database
  }
}
