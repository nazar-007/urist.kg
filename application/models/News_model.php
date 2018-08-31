<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    public function getNews() {
        $query = $this->db->get('news');
        return $query->result();
    }
    public function getOneNewById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('news');
        return $query->result();
    }
    public function getImgById($id) {
        $this->db->where('id', $id);
        $news = $this->db->get('news')->result();
        foreach ($news as $new) {
            $img = $new->img;
        }
        return $img;
    }
    public function insertNew($data) {
        $this->db->insert('news', $data);
    }
    public function deleteNewById($id) {
        $this->db->where('id', $id);
        $this->db->delete('news');
    }
    public function updateNewById($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('news', $data);
    }
}