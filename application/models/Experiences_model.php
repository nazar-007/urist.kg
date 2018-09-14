<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Experiences_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    public function getExperiences() {
        $query = $this->db->get('experiences');
        return $query->result();
    }
    public function getExperiencesByLawyerId($lawyer_id) {
        $this->db->where('lawyer_id', $lawyer_id);
        $query = $this->db->get('experiences');
        return $query->result();
    }
    public function getOneExperienceById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('experiences');
        return $query->result();
    }
    public function getOneExperienceByLawyerId($lawyer_id) {
        $this->db->where('lawyer_id', $lawyer_id);
        $query = $this->db->get('experiences');
        return $query->result();
    }
    public function insertExperience($data) {
        $this->db->insert('experiences', $data);
    }
    public function deleteExperienceById($id) {
        $this->db->where('id', $id);
        $this->db->delete('experiences');
    }
    public function deleteExperiencesByLawyerId($lawyer_id) {
        $this->db->where('lawyer_id', $lawyer_id);
        $this->db->delete('experiences');
    }

    public function updateExperienceById($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('experiences', $data);
    }
}