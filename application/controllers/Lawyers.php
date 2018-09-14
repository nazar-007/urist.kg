<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lawyers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('lawyers_model');
        $this->load->model('experiences_model');
    }
    public function Index() {
        $data = array(
            'lawyers' => $this->lawyers_model->getLawyers(),
            'csrf_hash' => $this->security->get_csrf_hash(),
        );
        $this->load->view('lawyers', $data);
    }
    public function One_lawyer($lawyer_id) {
        $one_lawyer = array (
            'one_lawyer' => $this->lawyers_model->getOneLawyerById($lawyer_id),
            'experiences' => $this->experiences_model->getExperiencesByLawyerId($lawyer_id),
            'csrf_hash' => $this->security->get_csrf_hash(),
            "lawyer_id" => $lawyer_id
        );
        $this->load->view('one_lawyer', $one_lawyer);
    }

    public function insert_lawyer() {
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
        $work = $this->input->post('work');
        $mail = $this->input->post('mail');
        $phone = $this->input->post('phone');

        $data = array(
            'name' => $name,
            'img' => $img,
            'work' => $work,
            'mail' => $mail,
            'phone' => $phone
        );
        $this->lawyers_model->insertLawyer($data);
        $insert_id = $this->db->insert_id();

        $json = array (
            'id' => $insert_id,
            'name' => $name,
            'img' => $img,
            'work' => $work,
            'mail' => $mail,
            'phone' => $phone,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }

    public function delete_lawyer() {
        $id = $this->input->post('id');
        $img = $this->lawyers_model->getImgById($id);

        if ($img != 'default.jpg') {
            unlink("./uploads/$img");
        }
        $this->lawyers_model->deleteLawyerById($id);
        $this->experiences_model->deleteExperiencesByLawyerId($id);

        $json = array(
            'id' => $id,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }

    public function update_lawyer($lawyer_id) {
        $data = array (
            'one_lawyer' => $this->lawyers_model->getOneLawyerById($lawyer_id),
            'experiences' => $this->experiences_model->getExperiencesByLawyerId($lawyer_id),
            'csrf_hash' => $this->security->get_csrf_hash(),
            "lawyer_id" => $lawyer_id
        );
        $this->load->view('update_lawyer', $data);
    }

    public function update_lawyer_process() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $work = $this->input->post('work');
        $mail = $this->input->post('mail');
        $phone = $this->input->post('phone');
        $current_img = $this->lawyers_model->getImgById($id);

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
            'img' => $img,
            'work' => $work,
            'mail' => $mail,
            'phone' => $phone
        );
        $this->lawyers_model->updateLawyerById($id, $data);

        redirect(base_url() . "lawyers");
    }
}