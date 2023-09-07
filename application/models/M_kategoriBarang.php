<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategoriBarang extends CI_Model {

	public function get_filtered_data($start, $length, $search, $orderColumn, $orderDirection) {
		$this->db->select('t_barang.*, t_satuan.nama_satuan');
		$this->db->from('t_barang');
		$this->db->join('t_satuan', 't_barang.id_satuan = t_satuan.id', 'left');

		if (!empty($search)) {
			$this->db->like('t_barang.nama_barang', $search);
			$this->db->or_like('t_barang.stok_barang', $search);
			$this->db->or_like('t_satuan.nama_satuan', $search);
		}

		if (!empty($orderColumn) && !empty($orderDirection)) {
			$this->db->order_by($orderColumn, $orderDirection);
		}

		$this->db->limit($length, $start);

		$query = $this->db->get();
		return $query->result();
	}

	public function get_total_data() {
		return $this->db->count_all('t_barang');
	}

	public function get_filtered_total($search) {
		$this->db->from('t_barang');
		$this->db->join('t_satuan', 't_barang.id_satuan = t_satuan.id', 'left');

		if (!empty($search)) {
			$this->db->like('t_barang.nama_barang', $search);
			$this->db->or_like('t_barang.stok_barang', $search);
			$this->db->or_like('t_satuan.nama_satuan', $search);
		}

		return $this->db->count_all_results();
	}

}

