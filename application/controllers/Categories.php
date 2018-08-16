<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
    
    public $_csrf = null;
    public function __construct() {
        parent::__construct();
        $this->load->model('categories_model');
        $this->load->model('themes_model');
        $this->load->database();
        $this->input->post(NULL, TRUE);
        $this->input->get(NULL, TRUE);
        $this->load->library('session');
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->helper('path'); 
         $this->_csrf  =  array( 
            'name' => $this->security->get_csrf_token_name(), 
            'hash' => $this->security->get_csrf_hash() 
        );
    }

    public function Index() {
        $cats = $this->categories_model->getCategories();
        $this->load->model('themes_model');
        $i = 0;
        foreach($cats as $cats_for_themes){
            $category_themes[$i] = $this->themes_model->getThreeLastThemesByCategoryId($cats_for_themes->id)->result_array();
            $i++;
        };
        $data = array(
            'categories' => $cats,
            'themes' => $this->themes_model->getThemes(),
            'cats_themes' => $category_themes,
            'csrf_hash' => $this->_csrf['hash'],
        );
        $this->load->view('categories', $data);
    }

    public function insert_category() {
        $category_name = $this->input->post('category_name');
        $data = array(
            'category_name' => $category_name
        );
        $this->categories_model->insertCategory($data);
        $insert_id = $this->db->insert_id();

        $json = array(
            'id' => $insert_id,
            'category_name' => $category_name,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }

    public function delete_category() {
        // при удалении категории удаляю сначала комменты всех тем этой категории, затем темы этой категории и саму категорию

        $id = $this->input->post('id');
        $themes = $this->themes_model->getThemesByCategoryId($id);
        foreach ($themes as $theme) {
            $theme_id = $theme->id;
            $this->comments_model->deleteCommentsByThemeId($theme_id);
        }
        $this->themes_model->deleteThemesByCategoryId($id);
        $this->categories_model->deleteCategoryById($id);

        $json = array(
            'id' => $id,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }

    public function update_category() {
        $id = $this->input->post('id');
        $category_name = $this->input->post('category_name');
        $data = array(
            'category_name' => $category_name
        );
        $this->categories_model->updateCategoryById($id, $data);

        $json = array(
            'id' => $id,
            'category_name' => $category_name,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }


}