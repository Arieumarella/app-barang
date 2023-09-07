<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

	public function simpanBarang($dataInsert, $jml_barang, $jns_barang)
	{
		$this->db->trans_begin();

		$data = $this->db->get_where('t_barang', ['id' => $jns_barang])->row();

		$this->db->where(['id' => $jns_barang]);
		$this->db->update('t_barang', ['stok_barang' => $data->stok_barang+$jml_barang]);

		$this->db->insert('t_stok_barang', $dataInsert);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	public function get_filtered_data($start, $length, $search, $orderColumn, $orderDirection) {
		$this->db->select('t_stok_barang.*, t_barang.nama_barang as jns_barang');
		$this->db->from('t_stok_barang');
		$this->db->join('t_barang', 't_stok_barang.id_kategori_barang = t_barang.id', 'left');

		if (!empty($search)) {
			$this->db->like('t_stok_barang.nama_barang', $search);
			$this->db->or_like('t_stok_barang.harga_satuan', $search);
			$this->db->or_like('t_stok_barang.stok_barang_masuk', $search);
			$this->db->or_like('t_stok_barang.tgl_bukti', $search);
			$this->db->or_like('t_stok_barang.keterangan', $search);
			$this->db->or_like('t_barang.nama_barang', $search);
		}

		if (!empty($orderColumn) && !empty($orderDirection)) {
			$this->db->order_by($orderColumn, $orderDirection);
		}

		$this->db->limit($length, $start);

		$query = $this->db->get();
		return $query->result();
	}

	public function get_total_data() {
		return $this->db->count_all('t_stok_barang');
	}

	public function get_filtered_total($search) {
		$this->db->from('t_stok_barang');
		$this->db->join('t_barang', 't_stok_barang.id_kategori_barang = t_barang.id', 'left');

		if (!empty($search)) {
			$this->db->like('t_stok_barang.nama_barang', $search);
			$this->db->or_like('t_stok_barang.harga_satuan', $search);
			$this->db->or_like('t_stok_barang.stok_barang_masuk', $search);
			$this->db->or_like('t_stok_barang.tgl_bukti', $search);
			$this->db->or_like('t_stok_barang.keterangan', $search);
			$this->db->or_like('t_barang.nama_barang', $search);
		}

		return $this->db->count_all_results();
	}

}