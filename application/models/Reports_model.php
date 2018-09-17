<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    public function getReports() {
        $query = $this->db->get('reports');
        return $query->result();
    }
    public function getOneReportById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('reports');
        return $query->result();
    }
    public function insertReport($data) {
        $this->db->insert('reports', $data);
    }
    public function deleteReportById($id) {
        $this->db->where('id', $id);
        $this->db->delete('reports');
    }
    public function updateReportById($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('reports', $data);
    }
}