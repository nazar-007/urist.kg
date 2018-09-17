<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_images extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('news_model');
    }
    public function One_report_image($report_image_id) {
        $one_report_image = array (
            'one_report_image' => $this->report_images_model->getOneReportImageById($report_image_id),
            'csrf_hash' => $this->security->get_csrf_hash(),
            "report_image_id" => $report_image_id
        );
        $this->load->view('one_report_image', $one_report_image);
    }

    public function insert_new() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = true;
        $config['max_size'] = 1000;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('img')) {
            $upload_image = $this->upload->data();
            $img = $upload_image['file_name'];
        } else {
            $img = "default.jpg";
        }

        $name = $this->input->post('name');
        $text = $this->input->post('text');
        $time = date("H:i:s");

        $data = array(
            'name' => $name,
            'text' => $text,
            'time' => $time,
            'img' => $img
        );
        $this->news_model->insertNew($data);
        $insert_id = $this->db->insert_id();

        $json = array (
            'id' => $insert_id,
            'name' => $name,
            'text' => $text,
            'img' => $img,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }

    public function delete_new() {
        $id = $this->input->post('id');
        $img = $this->news_model->getImgById($id);

        if ($img != 'default.jpg') {
            unlink("./uploads/$img");
        }
        $this->news_model->deleteNewById($id);

        $json = array(
            'id' => $id,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }

    public function update_new() {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $text = $this->input->post('text');
        $time = date("H:i:s");
        $current_img = $this->news_model->getImgById($id);

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = true;
        $config['max_size'] = 1000;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('img')) {
            $upload_image = $this->upload->data();
            $img = $upload_image['file_name'];
            if ($current_img != 'default.jpg') {
                unlink("./uploads/$current_img");
            }
        } else {
            $img = $current_img;
        }

        $data = array(
            'name' => $name,
            'text' => $text,
            'time' => $time,
            'img' => $img
        );
        $this->news_model->updateNewById($id, $data);

        $json = array (
            'id' => $id,
            'name' => $name,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }
}