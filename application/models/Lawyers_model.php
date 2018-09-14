<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lawyers_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    public function getLawyers() {
        $query = $this->db->get('lawyers');
        return $query->result();
    }
    public function getOneLawyerById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('lawyers');
        return $query->result();
    }
    public function getImgById($id) {
        $this->db->where('id', $id);
        $lawyers = $this->db->get('lawyers')->result();
        foreach ($lawyers as $lawyer) {
            $img = $lawyer->img;
        }
        return $img;
    }
    public function insertLawyer($data) {
        $this->db->insert('lawyers', $data);
    }
    public function deleteLawyerById($id) {
        $this->db->where('id', $id);
        $this->db->delete('lawyers');
    }
    public function updateLawyerById($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('lawyers', $data);
    }
}