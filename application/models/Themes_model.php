<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Themes_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    public function getThemes() {
        $this->db->order_by('id DESC');
        $query = $this->db->get('themes');
        return $query->result();
    }
    public function getThemesByCategoryId($category_id) {
        $this->db->where('category_id', $category_id);
        $this->db->order_by('id DESC');
        $query = $this->db->get('themes');
        return $query->result();
    }
    public function getThreeLastThemesByCategoryId($forum_id) {
        $this->db->where('category_id', $forum_id);
        $this->db->order_by('id DESC');
        $this->db->limit(3);
        $query = $this->db->get('themes');
        return $query;
    }
    public function getOneThemeById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('themes');
        return $query->result();
    }
    public function getViewsById($id) {
        $this->db->where('id', $id);
        $themes = $this->db->get('themes')->result();
        foreach ($themes as $theme) {
            $views = $theme->views;
        }
        return $views;
    }
    public function getCommentsById($id) {
        $this->db->where('id', $id);
        $themes = $this->db->get('themes')->result();
        foreach ($themes as $theme) {
            $comments = $theme->comments;
        }
        return $comments;
    }

    public function searchThemesByThemeName($theme_name) {
        $this->db->like('theme_name', $theme_name);
        $query = $this->db->get('themes');
        return $query->result();
    }

    public function sortThemes($order_by) {
        $this->db->order_by($order_by);
        $query = $this->db->get('themes');
        return $query->result();
    }

    public function sortThemesByCategoryId($order_by, $category_id) {
        $this->db->where('category_id', $category_id);
        $this->db->order_by($order_by);
        $query = $this->db->get('themes');
        return $query->result();
    }

    public function insertTheme($data) {
        $this->db->insert('themes', $data);
    }

    public function deleteThemeById($id) {
        $this->db->where('id', $id);
        $this->db->delete('themes');
    }
    public function deleteThemesByCategoryId($category_id) {
        $this->db->where('category_id', $category_id);
        $this->db->delete('themes');
    }

    public function updateThemeById($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('themes', $data);
    }
}