<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P11 extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('P11_model');
        $this->load->helper('form');
        $this->load->helper('url');
    }
    
    public function index() {
        $username = $this->session->userdata('username');
        if ($username == "") {
            $this->load->view('p11login');
        } else {
            $data['title'] = "Home";
            $this->load->view('p11home');
        }
    }
    
    public function contacts() {
        $search = $this->input->get();
        $contacts = $this->P11_model->get($search, false);
        header('Content-Type: application/json');
        echo json_encode($contacts);
    }
    
    public function save() {
        $data = $this->input->post();
        $saved = $this->P11_model->save($data);
        header('Content-Type: application/json');
        echo json_encode(['code' => 200]);
    }
    
    public function delete($id) {
        $saved = $this->P11_model->delete($id);
        header('Content-Type: application/json');
        echo json_encode(['code' => 200]);
    }

    public function login() {
        $data = $this->input->post();
        if ($data['username'] == "admin" && $data['password'] == "123") {
            $this->session->set_userdata('username', $data['username']);
            redirect('p11');
        } else {
            $msg = array('msg' => "login error, wrong username or password");
            $this->load->view('p11login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('username');
        $this->index();
    }
}