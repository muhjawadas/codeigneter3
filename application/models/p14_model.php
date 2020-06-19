<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P14_model extends CI_Model {
    public function get($search = "", $id = "") {
        if (isset($search['keyword'])) {
            $this->db->like('name', $search['keyword']);
        }

        if (isset($id) && $id != "") {
            $this->db->where('id', $id);
        }

        $query = $this->db->get('data14');
        return $query->result();
    }

    public function save($val) {
        $this->load->model('P14_model');
        
        if (isset($val['id']) && $val['id'] != "") {
            $data_to_update = array(
                "name" => $val["name"],
                "address" => $val["address"],
                "phone" => $val["phone"],
            );
            $this->db->where('id', $val['id']);
            return $this->db->update('data14', $data_to_update);
        } else {
            //print_r($val);die; -> check data output
            $data_to_insert = array(
                "name" => $val["name"],
                "address" => $val["address"],
                "phone" => $val["phone"]
            );
        
        return $this->db->insert('data14', $data_to_insert);
        }
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('data14');
    }
}