<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function getCategories() {
        $query = $this->db->get('categories');
        return $query->result();
    }

    public function insertCategory($data) {
        $this->db->insert('categories', $data);
    }

    public function deleteCategoryById($id) {
        $this->db->where('id', $id);
        $this->db->delete('categories');
    }

    public function updateCategoryById($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('categories', $data);
    }
}