<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P4 extends CI_Controller {
    public function index() {
        $this->load->view('p4'); // load a view
    }

    public function pertemuan4() {  //basic url
        $data['title'] = "pertemuan 4";
        $this->load->view('p4data',$data); // load view with data
    }

    public function pertemuan4a($id) { // get parameter
        echo "data diterima: ".$id;
    }

    public function pertemuan4b() {
        $data = $this->input->get();
        echo "data diterima: ";
        echo var_dump($data);
    }
}