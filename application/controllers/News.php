<?php

// linux torrent скачать
// unetbootin скачать
// выбрать ios
// установочный диск UEFI general,
// start linux mint,
// install linux mint (desktop),
// установить стороннее программное обеспечение
// установить linux рядом с виндовс
// распределение диска
// имя пользователя
// установка install linux mint on desktop
// перезагрузить

// менеджер обновлений - установить обновления
// linux php 7 apache mysql
// 4 commands sudo
// apache2 1 command
// mysql 1 command
// менеджер пакетов - gedit
//

defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('news_model');
    }
    public function Index() {
        $data = array(
            'news' => $this->news_model->getNews(),
            'csrf_hash' => $this->security->get_csrf_hash(),
        );
        $this->load->view('news', $data);
    }
    public function One_new($new_id) {
        $one_new = array (
            'one_new' => $this->news_model->getOneNewById($new_id),
            'csrf_hash' => $this->security->get_csrf_hash(),
            "new_id" => $new_id
        );
        $this->load->view('one_new', $one_new);
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