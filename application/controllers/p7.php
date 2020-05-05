<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P7 extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        
        $username = $this->session->userdata('username');
        if ($username == ""){
            $this->load->view('p7login');
        } else {
            redirect("p6");
        }
    }

    public function login(){
        $data = $this->input->post();
        if ($data['username'] == 'admin' && $data['password'] == '123') {
            $this->session->set_userdata('username', $data['username']);
            redirect("p6");
        }else{
            $msg = array('msg' => "login error, wrong username or password");
            $this->load->view('p7login', $msg);
        }
    }    

    public function logout(){
        //destroy  session
        $this->session->unset_userdata('username');
        //back to home
        $this->index();
    } 

    public function delete($id){
        //deleting data
        $this->load->model('p6_model');
        $saved  = $this->p6_model->delete($id);
        //back to home
        $this->index();
    }
}