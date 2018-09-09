<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    public function getPdfCategories() {
        $query = $this->db->get('pdf_category');
        return $query->result_array();
    }
    public function getOnePdfCategories($id) {
        $this->db->where('id',$id);
        $query = $this->db->get('pdf_category_files');
        return $query->result_array();
    }
    public function getParentPdfCategories($id) {
        $this->db->where('id',$id);
        $query = $this->db->get('pdf_category');
        return $query->result_array();
    }
    
    public function deleteCategoryById($id) {
        $this->db->where('id', $id);
        $this->db->delete('categories');
    }
    public function insert_category($data) {
        $this->db->insert('pdf_category', $data);
        $insert_id = $this->db->insert_id();

        $json = array(
            'id' => $insert_id,
            'category_name' => $data['name'],
            'category_dis' => $data['dis'],
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }
    public function insert_category_file($mass){
            $category_name = $mass['category_name'];
            $category_id = $mass['main_category_id'];
 
        
        
            $config['upload_path']          = "./pdf_files";
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 100000;
            $config['encrypt_name']             = TRUE;
            $this->load->library('upload', $config);
            $this->upload->do_upload('userfile');
            $photo_info = $this->upload->data();

            $data = array(
                'name' => $category_name,
                'route' => $photo_info['file_name'],
                'cats_id' => $category_id,
            );

            
            $this->db->insert('pdf_category_files', $data);
            $last_id =    $this->db->insert_id();
            $massiv['img'] = base_url().'pdf_files/'.$photo_info['file_name'];
            $massiv['name'] = $category_name;
            $massiv['token'] = $this->security->get_csrf_hash();
            $massiv['id'] = $last_id;
            $massiv_json = json_encode($massiv);
            return $massiv_json;
    }
    public function update_category($data) {
        $id = $data['id'];
        $dis = $data['dis'];
        $name = $data['name'];
        $mass = array(
            'dis' => $dis,
            'name' => $name,
        );
        $this->db->where('id',$id);
        $this->db->update('pdf_category', $mass);

        $json = array(
            'category_name' => $data['name'],
            'category_dis' => $data['dis'],
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }
}