<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_satuan extends CI_Model {

	public function get_filtered_data($start, $length, $search, $orderColumn, $orderDirection) {
		$this->db->select('*');
		$this->db->from('t_satuan');

		if (!empty($search)) {
			$this->db->where('nama_satuan LIKE', "%$search%");
		}

		if (!empty($orderColumn) && !empty($orderDirection)) {
			$this->db->order_by($orderColumn, $orderDirection);
		}

		$this->db->limit($length, $start);

		$query = $this->db->get();
		return $query->result();
	}

	public function get_total_data() {
		return $this->db->count_all('t_satuan');
	}

	public function get_filtered_total($search) {
		$this->db->from('t_satuan');

		if (!empty($search)) {
			$this->db->where('nama_satuan LIKE', "%$search%");
		}

		return $this->db->count_all_results();
	}


}