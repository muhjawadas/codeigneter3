<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P6_model extends CI_Model {
    public function get($search = "", $id = "") {
        if (isset($search['keyword'])) {
            $this->db->like('name', $search['keyword']);
        }

        if (isset($id) && $id != "") {
            $this->db->where('id', $id);
        }

        $query = $this->db->get('contacts');
        return $query->result();
    }

    public function save($val) {
        $this->load->model('P6_model');

        if (isset($val['id']) && $val['id'] != "") {
            $data_to_update = array(
                "name" => $val["name"],
                "address" => $val["address"],
                "phone" => $val["phone"],
            );
            $this->db->where('id', $val['id']);
            return $this->db->update('contacts', $data_to_update);
        } else {
            $data_to_insert = array(
                "name" => $val["name"],
                "address" => $val["address"],
                "phone" => $val["phone"]
            );
        return $this->db->insert('contacts', $data_to_insert);
        }
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('contacts');
    }
}
?>