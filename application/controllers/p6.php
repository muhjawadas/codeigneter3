<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P6 extends CI_Controller {

    public function index() {
        $this->load->model("p6_model");

        $this->load->helper('form');
        $search = $this->input->get();
        if (isset($search['keyword'])) {
            $data['keyword'] = $search['keyword'];
        }

        $data['title']="Home";
        $data['contacts'] = $this->p6_model->get($search, false);

        $this->load->view('p6home',$data);
        
    }

    public function save() {
        $this->load->model("p6_model");
        $data = $this->input->post();
        $data = $this->p6_model->save($data);

        $this->index();
    }

    public function form($id = "") { //form
        $this->load->model('p6_model');
        $this->load->helper('form');

        $data['title'] = "Form";
        
        if (!empty($id)){
            $data['id'] = $id;
            $data['contacts'] = $this->p6_model->get(false, $id);
        }
        // print_r($data);die; -> for debugging output
        $this->load->view('p6form', $data);
    }
}