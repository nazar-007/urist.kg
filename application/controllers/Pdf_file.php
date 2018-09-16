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
        $data = array(
            'categories' => $cats,
            'csrf_hash' => $this->_csrf['hash'],
        );
        $this->load->view('pdf_cats', $data);
    }
    public function pdf_one_cats() {
        $cats = $this->pdf_model->getOnePdfCategories();
        //$main_cats = $this->pdf_model->getParentPdfCategories($id);
        $data = array(
            'categories' => $cats,
            'csrf_hash' => $this->_csrf['hash'],
        );
        $this->load->view('pdf_one_cats', $data);
    }
    public function insert_category(){
        $category_name = $this->input->post('category_name');
        $category_dis = $this->input->post('category_dis');
        $data = array(
            'name' => $category_name,
            'dis' => $category_dis
        );
        echo $this->pdf_model->insert_category($data);
    }
    public function insert_category_file(){
        $category_name = $this->input->post('category_name');
        $data = array(
            'category_name' => $category_name,
        );
//        echo "<pre>";
//            print_r($_FILES['userfile']);
//        echo "<pre>";
        echo $this->pdf_model->insert_category_file($data);
    }
    public function download_file(){
            $file = 'pdf_files/f0024a629862a4c15e6ec64bf4a6484d.jpg';
            echo $file;

//             if (ob_get_level()) {
//                  ob_end_clean();
//                }
//                // заставляем браузер показать окно сохранения файла
//                header('Content-Description: File Transfer');
//                header('Content-Type: application/octet-stream');
//                header('Content-Disposition: attachment; filename=' . basename($file));
//                header('Content-Transfer-Encoding: binary');
//                header('Expires: 0');
//                header('Cache-Control: must-revalidate');
//                header('Pragma: public');
//                header('Content-Length: ' . filesize($file));
//                // читаем файл и отправляем его пользователю
//                if ($fd = fopen($file, 'rb')) {
//                  while (!feof($fd)) {
//                    print fread($fd, 1024);
//              }
              fclose($fd);
                  
    }
    
    public function delete_category() {

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
    public function update_category(){
        $category_name = $this->input->post('category_name');
        $category_dis = $this->input->post('category_dis');
        $category_id = $this->input->post('category_id');
        $data = array(
            'name' => $category_name,
            'dis' => $category_dis,
            'id' => $category_id
        );
        echo $this->pdf_model->update_category($data);

    }
}