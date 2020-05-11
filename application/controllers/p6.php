<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P6 extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url','html'));
        $username = $this->session->userdata('username');
        if ($username == ""){
            redirect("p7");
        }
    }
    
    public function index() {            
        $this->load->model("p6_model");
            
        $this->load->helper('form');
        $search = $this->input->get();
        if (isset($search['keyword'])) {
            $data['keyword'] = $search['keyword'];
        }
            
            
        $data['title']="Home";
        $data['contacts'] = $this->p6_model->get($search, false);
            
            //print_r($data);die;
            
        $this->load->view('p6home',$data); 
    }

    public function save() {
        $this->load->model("p6_model");
        $data = $this->input->post();

        if (!empty($_FILES['userfile']['name'])) {
            $customName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $_FILES['userfile']['name']);
            $config['upload_path'] = './assets/';
            $config['allowed_types'] = 'gif|png|jpg';
            $config['max_size'] = 1000;
            $config['file_name'] = $customName;

            $data['picture'] =  $customName;
    
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

        }

        $data = $this->p6_model->save($data);

        return header('location:/p6/');
    }

    public function form($id = "") { //form
        $this->load->model('p6_model');
        $this->load->helper('form');

        $data['title'] = "Form";
        
        if (!empty($id)){
            $data['id'] = $id;
            $data['contacts'] = $this->p6_model->get(false, $id);
        }
        $this->load->view('p6form', $data);
    }
}