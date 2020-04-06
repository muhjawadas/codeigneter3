<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P5 extends CI_Controller {

public function index() { //Basic Url
    $data['title'] = "Home";
    $this->load->view('p5a',$data); // load view 1
}       
public function form() { //form
    $data['title'] = "Form";
    $this->load->helper('form');
    $this->load->view('p5form',$data);
} 
}
