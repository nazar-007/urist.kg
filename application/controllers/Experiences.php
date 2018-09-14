<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Experiences extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('lawyers_model');
        $this->load->model('experiences_model');
    }

    public function Index() {
        $data = array(
            'experiences' => $this->experiences_model->getExperiences(),
            'csrf_hash' => $this->security->get_csrf_hash(),
        );
        $this->load->view('experiences', $data);
    }
    public function One_experience($experience_id) {
        $one_new = array (
            'one_experience' => $this->experiences_model->getOneExperienceById($experience_id),
            'csrf_hash' => $this->security->get_csrf_hash(),
            "experience_id" => $experience_id
        );
        $this->load->view('one_experience', $one_new);
    }

    public function insert_experience() {
        $work_place = $this->input->post('work_place');
        $work_date = $this->input->post('work_date');
        $work_desc = $this->input->post('work_desc');
        $lawyer_id = $this->input->post('lawyer_id');

        $data = array(
            'work_place' => $work_place,
            'work_date' => $work_date,
            'work_desc' => $work_desc,
            'lawyer_id' => $lawyer_id
        );
        $this->experiences_model->insertExperience($data);
        $insert_id = $this->db->insert_id();

        $json = array (
            'id' => $insert_id,
            'work_place' => $work_place,
            'work_date' => $work_date,
            'work_desc' => $work_desc,
            'lawyer_id' => $lawyer_id,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }

    public function delete_experience() {
        $id = $this->input->post('id');
        $this->experiences_model->deleteExperienceById($id);

        $json = array(
            'id' => $id,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }

    public function update_experience() {

        $id = $this->input->post('id');
        $work_place = $this->input->post('work_place');
        $work_date = $this->input->post('work_date');
        $work_desc = $this->input->post('work_desc');
        $lawyer_id = $this->input->post('lawyer_id');

        $data = array(
            'work_place' => $work_place,
            'work_date' => $work_date,
            'work_desc' => $work_desc,
            'lawyer_id' => $lawyer_id
        );
        $this->experiences_model->updateExperienceById($id, $data);

        $json = array (
            'id' => $id,
            'name' => $work_place,
            'work_place' => $work_place,
            'work_date' => $work_date,
            'work_desc' => $work_desc,
            'csrf_hash' => $this->security->get_csrf_hash()
        );

        redirect(base_url() . "lawyers");
    }
}