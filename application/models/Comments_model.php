<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function getCommentsByThemeId($theme_id) {
        $this->db->where('theme_id', $theme_id);
        $query = $this->db->get('comments');
        return $query->result();
    }

    public function insertComment($data) {
        $this->db->insert('comments', $data);
    }

    public function deleteCommentById($id) {
        $this->db->where('id', $id);
        $this->db->delete('comments');
    }

    public function deleteCommentsByThemeId($theme_id) {
        $this->db->where('theme_id', $theme_id);
        $this->db->delete('comments');
    }

    public function updateCommentById($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('comments', $data);
    }
}