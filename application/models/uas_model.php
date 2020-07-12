<?php
defined('BASEPATH') or exit('No direct script access allowed');

class uas_model extends CI_Model
{
	public function get_sales($start = false, $end = false)
	{
		if ($start && $start != 'undefined' && $end && $end != 'undefined') {
			$this->db->where('year >=', $start);
			$this->db->where('year <=', $end);
		}

		$query = $this->db->get('sales');

		return $query->result();
	}

	public function get_sales_filter($page, $rows, $keyword)
	{
		$offset = ($page - 1) * $rows;

		$pager = $this->db
			->select('count(id) as total')
			->from('sales')
			->where('year like', "%$keyword%")
			->or_where('sales like', "%$keyword%")
			->or_where('purchase like', "%$keyword%")
			->get()
			->row();

		$query = $this->db
			->select('*')
			->from('sales')
			->where('year like', "%$keyword%")
			->or_where('sales like', "%$keyword%")
			->or_where('purchase like', "%$keyword%")
			//->limit($rows, $offset)
			->get()
			->result_array();

		return [
			'total' => intval($pager->total),
			'rows'  => $query,
			'query' => $this->db->last_query()
		];
	}

	public function get_year()
	{
		$query = $this->db->select('year')->get('sales');

		return $query->result();
	}

	public function get_user($username, $password)
	{
		$query = $this->db->where('username', $username)->where('password', $password)->get('user');

		return $query->result();
	}

	public function save($val)
	{
		if (isset($val['id']) && $val['id'] != "") {
			$data_to_update = array(
				"year"     => $val["year"],
				"sales"    => $val["sales"],
				"purchase" => $val["purchase"],
			);
			$this->db->where('id', $val['id']);

			return $this->db->update('sales', $data_to_update);
		} else {
			$data_to_insert = array(
				"year"     => $val["year"],
				"sales"    => $val["sales"],
				"purchase" => $val["purchase"],
			);

			return $this->db->insert('sales', $data_to_insert);
		}
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('sales');
	}
}
