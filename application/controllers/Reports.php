<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('reports_model');
        $this->load->model('report_images_model');
    }
    public function Index() {
        $data = array(
            'reports' => $this->reports_model->getReports(),
            'csrf_hash' => $this->security->get_csrf_hash(),
        );
        $this->load->view('reports', $data);
    }
    public function One_report($report_id) {
        $one_report = array (
            'one_report' => $this->reports_model->getOneReportById($report_id),
            'csrf_hash' => $this->security->get_csrf_hash(),
            "report_id" => $report_id
        );
        $this->load->view('one_report', $one_report);
    }

    public function insert_report() {
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
        $date = date("Y-m-d");

        $data = array(
            'name' => $name,
            'text' => $text,
            'date' => $date,
            'img' => $img
        );
        $this->reports_model->insertReport($data);
        $insert_id = $this->db->insert_id();

        $json = array (
            'id' => $insert_id,
            'name' => $name,
            'text' => $text,
            'date' => $date,
            'img' => $img,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }

    public function delete_report() {
        $id = $this->input->post('id');
        $imgs = $this->report_images_model->getReportImagesByReportId($id);

        foreach ($imgs as $img) {
            $img_id = $img->id;
            if ($img != 'default.jpg') {
                unlink("./uploads/$img");
            }
            $this->report_images_model->deleteReportImageById($img_id);
        }

        $current_img = $this->reports_model->getImgById($id);
        if ($current_img != 'default.jpg') {
            unlink("./uploads/$current_img");
        }

        $this->reports_model->deleteReportById($id);

        $json = array(
            'id' => $id,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }

    public function update_report() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $text = $this->input->post('text');
        $date = date("Y-m-d");
        $current_img = $this->reports_model->getImgById($id);

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
            'date' => $date,
            'img' => $img
        );
        $this->reports_model->updateReportById($id, $data);

        $json = array (
            'id' => $id,
            'name' => $name,
            'text' => $text,
            'date' => $date,
            'img' => $img,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }
}