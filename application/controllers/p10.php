<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class p10 extends CI_Controller {

    public function index(){
        $this->load->model("P10_model");
        $tmp = $this->P10_model->get();
        $pie = $this->P10_model->lol();
        //print_r($pie);die;
        $data["data"] = json_encode($tmp);
        $data["pie"] = json_encode([
            [
               "label" => "Sales",
                "value" => $pie->total_sales
            ],
            [
                "label" => "Purchase",
                "value" => $pie->total_purchase
            ]
        ]);
        
        $data['title']="Graph";
        $this->load->view('p10', $data);
        //print_r($data);die;
    }
}
?>