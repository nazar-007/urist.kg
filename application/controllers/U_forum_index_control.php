<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class U_forum_index_control extends CI_Controller {
    
    public $_csrf = null;
    public function __construct() {
        parent::__construct();
//        
//        $this->load->model('themes_model');
//        $this->load->model('comments_model');
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
    public function forum(){
        $f_id = '1767351836634476';
        $f_secret = '2155fa9c40693e97f65e59a6e40bd40d';
        $f_url = 'http://urist.kg/U_forum_index_control/facebook_login';
        


        
        
        
        $g_url = 'http://urist.kg/U_forum_index_control/google_login';
        $client_id = '569959836120-5q6al7bsoa9jcni55e732u4peqd38a9i.apps.googleusercontent.com'; // Client ID
        $client_secret = '1xDyW31ynUTLVB3KPu8dVf-Y'; // Client secret
        //$redirect_uri = $full_url; // Redirect URI
        
        $for_google_url = 'https://accounts.google.com/o/oauth2/auth';
        $g_params = array(
            'redirect_uri'  => $g_url,
            'response_type' => 'code',
            'client_id'     => $client_id,
            'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
        );

        $for_facebook_url = 'https://www.facebook.com/dialog/oauth';
        $f_params = array(
            'client_id'     => $f_secret,
            'redirect_uri'  => $f_url,
            'response_type' => 'code',
            'scope'         => 'email,user_birthday'
        );


        
        
        
        
        echo $g_link = '<p><a href="' . $for_google_url . '?' . urldecode(http_build_query($g_params)) . '">Аутентификация через Google</a></p>';
        
        echo $f_link = '<p><a href="' . $for_facebook_url . '?' . urldecode(http_build_query($f_params)) . '">Аутентификация через Facebook</a></p>';
        
        $this->load->model('U_forum_model');
        $all_cats = $this->U_forum_model->getCategories()->result_array();
        $i=0;
        foreach($all_cats as $row){
            $id = $row['id'];
            $all_themes[$i] = $this->U_forum_model->getThemesById($id)->result_array();
            $i++;
        }
        $mass = array( 
//                     'cats'=>$all_cats,
//                     'themes'=>$all_themes,
//                     'f_id' => $f_id,
//                     'f_secret' => $secret,
//                     'f_url' => $url,
         );
        $this->load->view('u_forum_index',$mass);
    }
    public function google_login(){
        
        $full_url = 'http://urist.kg/U_forum_index_control/google_login';
        $client_id = '569959836120-5q6al7bsoa9jcni55e732u4peqd38a9i.apps.googleusercontent.com'; // Client ID
        $client_secret = '1xDyW31ynUTLVB3KPu8dVf-Y'; // Client secret
        $redirect_uri = $full_url; // Redirect URI
        
        
        if (isset($_GET['code'])) {
            $result = false;

            $params = array(
                'client_id'     => $client_id,
                'client_secret' => $client_secret,
                'redirect_uri'  => $redirect_uri,
                'grant_type'    => 'authorization_code',
                'code'          => $_GET['code']
            );

            $url = 'https://accounts.google.com/o/oauth2/token';
            
            
            
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);

            $tokenInfo = json_decode($result, true);
            
            
            if (isset($tokenInfo['access_token'])) {
                $params['access_token'] = $tokenInfo['access_token'];

                $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo['id'])) {
                    $userInfo = $userInfo;
                    $result = true;
                }
            }
            if ($result) {
                echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
                echo "Имя пользователя: " . $userInfo['name'] . '<br />';
                echo "Email: " . $userInfo['email'] . '<br />';
                echo "Ссылка на профиль пользователя: " . $userInfo['link'] . '<br />';
                echo '<img src="' . $userInfo['picture'] . '" />'; echo "<br />";
            }

        }
 
        echo 'zzz';
        
        
        $this->load->view('google_login');
    }
    public function facebook_login(){

        
        if (isset($_GET['code'])) {
            $result = false;

            $params = array(
                'client_id'     => $client_id,
                'redirect_uri'  => $redirect_uri,
                'client_secret' => $client_secret,
                'code'          => $_GET['code']
            );

            $url = 'https://graph.facebook.com/oauth/access_token';

            $tokenInfo = null;
            parse_str(file_get_contents($url . '?' . http_build_query($params)), $tokenInfo);

            if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
                $params = array('access_token' => $tokenInfo['access_token']);

                $userInfo = json_decode(file_get_contents('https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params))), true);

                if (isset($userInfo['id'])) {
                    $userInfo = $userInfo;
                    $result = true;
                }
            }
            if ($result) {
                echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
                echo "Имя пользователя: " . $userInfo['name'] . '<br />';
                echo "Email: " . $userInfo['email'] . '<br />';
                echo "Ссылка на профиль пользователя: " . $userInfo['link'] . '<br />';
                echo "Пол пользователя: " . $userInfo['gender'] . '<br />';
                echo "ДР: " . $userInfo['birthday'] . '<br />';
                echo '<img src="http://graph.facebook.com/' . $userInfo['id'] . '/picture?type=large" />'; echo "<br />";
            }
        }
        echo 'yyy';
        
        
        $this->load->view('facebook_login');
    }
    public function category($id){
        $this->load->model('U_forum_model');
        $all_cats = $this->U_forum_model->getOneCategory($id)->result_array();
        $all_themes = $this->U_forum_model->getAllThemes($id)->result_array();

        $mass = array('cats'=>$all_cats,'themes'=>$all_themes);
        $this->load->view('u_forum_category',$mass);
    }
    public function theme($id){
        $this->load->model('U_forum_model');
        $one_themes = $this->U_forum_model->getOneTheme($id)->result_array();
        $comments = $this->U_forum_model->getThemeComments($id)->result_array();
        $mass = array('theme'=>$one_themes,'comments'=>$comments);
        $this->load->view('u_forum_theme',$mass);
    }
}