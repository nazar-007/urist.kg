<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('categories_model');
        $this->load->model('comments_model');
        $this->load->model('themes_model');
    }

    public function insert_comment() {
        $comment_text = $this->input->post('comment_text');
        $user_name = $this->input->post('user_name');
        $user_email = $this->input->post('user_email');
        $theme_id = $this->input->post('theme_id');
        $data = array(
            'comment_text' => $comment_text,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'theme_id' => $theme_id
        );
        $this->comments_model->insertComment($data);
        $insert_id = $this->db->insert_id();

        // $comments - беру количество текущих коиментов и прибавляю единицу.

        $comments = $this->themes_model->getCommentsById($theme_id);
        $data_themes = array(
            'comments' => $comments + 1
        );
        $this->themes_model->updateThemeById($theme_id, $data_themes);

        $json = array (
            'id' => $insert_id,
            'comment_text' => $comment_text,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }

    public function delete_comment() {
        $id = $this->input->post('id');
        $this->comments_model->deleteCommentById($id);

        $json = array(
            'id' => $id,
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        echo json_encode($json);
    }

}