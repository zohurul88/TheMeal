<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends AdminController
{
    public $dayList = array(
    "su" => "Sunday",
    "mo" => "Monday",
    "tu" => "tuesday",
    "we" => "Wednesday",
    "th" => "Thursday",
    "fr" => "Friday",
    "sa" => "saturday");

    public function install()
    {
        $this->load->library("migration");
        $this->migration->current();
    }

    public function index()
    {
        var_dump($this->session->userdata('ci_session'));
        $this->load->view('welcome_message');
    }

    public function register()
    {
        $this->load->view('user/create');
    }

    public function login()
    {
        $this->load->view('user/login');
    }

    public function attempet()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == false) {
            redirect('admin/login');
        }
        $user=$this->user->can_login($_POST['email'], md5($_POST['password']));
        if ($user) { 
            $this->session->set_userdata('ci_session',array('USER_LOGIN'=>true,"USER_ID"=>$user));
        }
    }

    public function newuser()
    {
        $request  = (object) $_REQUEST;
        $response = $this->user->ajax_insert($request);
        $this->output->set_status_header(200)->set_content_type('application/json', 'utf-8')->set_output(json_encode($response))->_display();
        exit;
    }

    public function alluser()
    {
        $users = $this->user->all();
        $this->load->view('user/all', compact('users'));
    }

    public function delete($id)
    {
        $response = $this->user->delete($id);
        $this->output->set_status_header(200)->set_content_type('application/json', 'utf-8')->set_output(json_encode($response))->_display();
        exit;
    }

    public function market()
    {
        $markets=$this->market->all();
        $users = $this->user->allID();
        $dayList=$this->dayList;
        $this->load->view('user/market',compact('markets','users','dayList'));
    }
}
