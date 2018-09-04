<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_file extends CI_Controller {
    
    public $_csrf = null;
    public function __construct() {
        parent::__construct();
        $this->load->model('pdf_model');
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

    public function pdf_cats() {
        $cats = $this->pdf_model->getPdfCategories();
//        foreach($cats as $cats_for_themes){
//            $category_themes[$i] = $this->themes_model->getThreeLastThemesByCategoryId($cats_for_themes->id)->result_array();
//            $i++;
//        };
        $data = array(
            'categories' => $cats,
            'csrf_hash' => $this->_csrf['hash'],
        );
        $this->load->view('pdf_cats', $data);
    }
}