<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {
    
    public $_csrf = null;
    public function __construct() {
        parent::__construct();
        $this->load->model('admins_model');
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
        $data = array(
            'csrf_hash' => $this->_csrf['hash']
        );
        $this->load->view('admins', $data);
    }

    public function login() {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $md5_password = md5($password);
        $salt_password = $password . $md5_password;
        $ready_password = hash('sha256', $salt_password);

        $admin_id = $this->admins_model->getAdminIdByLoginAndPassword($login, $ready_password);
        $num_rows = $this->admins_model->getAdminNumRowsByLoginAndPassword($login, $ready_password);

        if ($num_rows > 0) {
            $_SESSION['admin_id'] = $admin_id;
            $data = array(
                'admin_success' => "Вы успешно вошли!"
            );
            echo json_encode($data);
        } else {
            $data = array(
                'admin_error' => "Неправильный логин или пароль!",
                'csrf_hash' => $this->_csrf['hash']
            );
            echo json_encode($data);
        }
    }

    public function insert_admin() {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $md5_password = md5($password);
        $salt_password = $password . $md5_password;
        $ready_password = hash('sha256', $salt_password);

        $data = array(
            'login' => $login,
            'password' => $ready_password
        );

        $this->admins_model->insertAdmin($data);

    }

    public function delete_admin() {

    }

    public function update_admin() {

    }


}