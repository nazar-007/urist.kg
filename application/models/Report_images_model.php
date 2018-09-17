<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_images_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    public function getReportImages() {
        $query = $this->db->get('report_images');
        return $query->result();
    }
    public function getReportImagesByReportId($report_id) {
        $this->db->where('report_id', $report_id);
        $query = $this->db->get('report_images');
        return $query->result();
    }
    public function getOneReportImageById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('report_images');
        return $query->result();
    }
    public function insertReportImage($data) {
        $this->db->insert('report_images', $data);
    }
    public function deleteReportImageById($id) {
        $this->db->where('id', $id);
        $this->db->delete('report_images');
    }
    public function updateReportImageById($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('report_images', $data);
    }
}