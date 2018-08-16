<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function getAdmins() {
        $query = $this->db->get('admins');
        return $query->result();
    }

    public function getAdminIdByLoginAndPassword($login, $password) {
        $this->db->where('login', $login);
        $this->db->where('password', $password);
        $query = $this->db->get('admins');
        $admins = $query->result();
        foreach ($admins as $admin) {
            $admin_id = $admin->id;
            return $admin_id;
        }
    }

    public function getAdminNumRowsByLoginAndPassword($login, $password) {
        $this->db->where('login', $login);
        $this->db->where('password', $password);
        $query = $this->db->get('admins');
        return $query->num_rows();
    }
    public function insertAdmin($data) {
        $this->db->insert('admins', $data);
    }

    public function deleteAdminById($id) {
        $this->db->where('id', $id);
        $this->db->delete('admins');
    }

    public function updateAdminById($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('admins', $data);
    }
}