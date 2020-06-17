<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class P14 extends CI_Controller { 
    
    public function __construct() { 
        parent::__construct(); 
        $this->load->model('P14_model');
        $this->load->helper('form');
        $this->load->helper('url'); 
    }
    public function index() {
        $this->load->view('p14');
    }

    public function data14() { 
        $data14 = $this->P14_model->get();
        header('Content-Type: application/json');
        echo json_encode($data14);
    }    

    public function save($id = null) { 
        $data = $this->input->post();
        if (isset($id)) {   
            $data['id'] = $id; 
        }
        
        $saved = $this->P14_model->save($data); 
        $this->index();
    }
    
    public function delete($id) {
        $saved = $this->P14_model->delete($id);
        header('Content-Type: application/json'); 
        echo json_encode(['code' => 200]); 
    }
}