<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P6_model extends CI_Model {
    public function get($search) {
        if (isset($search['keyword'])) {
            $this->db->like('name', $search['keyword']);
        }
        $query = $this->db->get('contacts');
        return $query->result();
    }

    public function save($val) {
        $data_to_insert = array(
            "name" => $val["name"],
            "address" => $val["address"],
            "phone" => $val["phone"]
        );
        return $this->db->insert('contacts', $data_to_insert);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('contacts');
    }
}
?>