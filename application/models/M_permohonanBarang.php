<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_permohonanBarang extends CI_Model {


	public function prosesApprove($dataUbahPermintaan, $idMaster, $jmlStokKurang, $id_barang)
	{
		$this->db->trans_begin();

		$this->db->where('id', $id_barang);
		$this->db->update('t_barang', ['stok_barang' => $jmlStokKurang, 'updated_at' => date('Y-m-d H:i:s')]);


		$this->db->where('id', $idMaster);
		$this->db->update('t_permintaan_barang', $dataUbahPermintaan);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	public function get_filtered_data($start, $length, $search, $orderColumn, $orderDirection) {

		$prive = $this->session->userdata('roll');

		$this->db->select('t_permintaan_barang.*, t_barang.nama_barang, t_sts_approval.nama_status');
		$this->db->from('t_permintaan_barang');
		$this->db->join('t_barang', 't_permintaan_barang.id_barang = t_barang.id', 'left');
		$this->db->join('t_sts_approval', 't_permintaan_barang.status_approval = t_sts_approval.id', 'left');

		if (!empty($search)) {
			$this->db->like('t_permintaan_barang.username_pemohon', $search);
			$this->db->or_like('t_permintaan_barang.jml_barang', $search);
			$this->db->or_like('t_permintaan_barang.jml_approval', $search);
			$this->db->or_like('t_barang.nama_barang', $search);
			$this->db->or_like('t_sts_approval.nama_status', $search);
		}

		if ($prive == '2') {
			$this->db->where('t_permintaan_barang.username_pemohon', $this->session->userdata('username'));
		}

		if (!empty($orderColumn) && !empty($orderDirection)) {
			$this->db->order_by($orderColumn, $orderDirection);
		}

		$this->db->limit($length, $start);

		$query = $this->db->get();
		return $query->result();
	}

	public function get_total_data() {
		$prive = $this->session->userdata('roll');

		if ($prive == '2') {
			$this->db->where('t_permintaan_barang.username_pemohon', $this->session->userdata('username'));
		}

		return $this->db->count_all('t_permintaan_barang');
	}

	public function get_filtered_total($search) {

		$prive = $this->session->userdata('roll');

		$this->db->select('t_permintaan_barang,  t_barang.nama_barang, t_sts_approval.nama_status');
		$this->db->from('t_permintaan_barang');
		$this->db->join('t_barang', 't_permintaan_barang.id_barang = t_barang.id', 'left');
		$this->db->join('t_sts_approval', 't_permintaan_barang.status_approval = t_sts_approval.id', 'left');

		if (!empty($search)) {
			$this->db->like('t_permintaan_barang.username_pemohon', $search);
			$this->db->or_like('t_permintaan_barang.jml_barang', $search);
			$this->db->or_like('t_permintaan_barang.jml_approval', $search);
			$this->db->or_like('t_barang.nama_barang', $search);
			$this->db->or_like('t_sts_approval.nama_status', $search);
		}

		if ($prive == '2') {
			$this->db->where('t_permintaan_barang.username_pemohon', $this->session->userdata('username'));
		}

		return $this->db->count_all_results();
	}


}