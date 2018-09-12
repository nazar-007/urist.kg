<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class U_forum_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    public function getCategories() {
        $query = $this->db->get('categories');
        return $query;
    }
    public function getOneCategory($id){
        $this->db->where('id',$id);
        $query = $this->db->get('categories');
        return $query;
    }
    public function getAllThemes($id){
        $this->db->where('category_id',$id);
        $query = $this->db->get('themes');
        return $query;
    }
    public function getOneTheme($id){
        $this->db->where('id',$id);
        $query = $this->db->get('themes');
        return $query;
    }
    public function getThemesById($id){
        $this->db->where('category_id',$id);
        $this->db->order_by('id DESC');
        $this->db->limit(3);
        $query = $this->db->get('themes');
        return $query;
    }
    public function getThemeComments($id){
        $this->db->where('theme_id',$id);
        $query = $this->db->get('comments');
        return $query;
    }
}