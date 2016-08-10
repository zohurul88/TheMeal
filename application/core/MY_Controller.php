<?php

class AdminController extends CI_Controller
{
    protected $login      = false;
    protected $login_user = 0;
    public function __construct()
    {
        parent::__construct();
        $this->auth_redirect();
        $this->load->helper("form");
        $this->load->library("form_validation");
        $this->load->model('User_model', 'user');
        $this->load->model('Market_model', 'market');
    }
    public function auth()
    {
        $session = $this->session->userdata('ci_session');
        if (!empty($session) && $session['USER_LOGIN']) {
            $this->login_user = $session['USER_ID'];
            $this->login      = true;
        }
        return $this->login;
    }

    public function auth_redirect()
    {
        if($this->router->fetch_method()=="login" || $this->router->fetch_method()=="attempet")
            return false; 
        $this->auth();
        var_dump($this->login);
        if (!$this->login) {
            redirect('admin/login');
        }
    }
    protected function is_ajax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_SERVER['HTTP_AUTHORITY']) && $_SERVER['HTTP_AUTHORITY']==md5(session_id()));
    }
}

class API_Contorller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        //$this->oAuth(); 
        $this->load->model('User_model', 'user');
        $this->load->model('Market_model', 'market');
    }

    private function oAuth($key)
    {
        if($key==$key)
        {
            return true;
        }
    }
}