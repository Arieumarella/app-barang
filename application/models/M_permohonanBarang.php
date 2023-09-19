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


	public function simpanData($inputDataMaster, $jns_barang, $jml_barang)
	{
		$this->db->trans_begin();

		$this->db->insert('t_master_permohonan_barang', $inputDataMaster);

		$last_id = $this->db->insert_id();

		foreach ($jns_barang as $key => $value) {
			
			$dataInsert = array(
				'id_master' => $last_id,
				'id_jns_barang' => $jns_barang[$key],
				'jml_barang' => $jml_barang[$key],
				'created_at' => date('Y-m-d H:i:s')
			);

			$this->db->insert('t_detail_permohonan_barang', $dataInsert);

		}


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

		$this->db->select('*');
		$this->db->from('t_master_permohonan_barang');

		if (!empty($search)) {
			$this->db->like('username_pemohon', $search);
			$this->db->or_like('tgl_pengajuan', $search);
			$this->db->or_like('status_review', $search);
		}

		if ($prive == '2') {
			$this->db->where('t_master_permohonan_barang.username_pemohon', $this->session->userdata('username'));
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
			$this->db->where('t_master_permohonan_barang.username_pemohon', $this->session->userdata('username'));
		}

		return $this->db->count_all('t_master_permohonan_barang');
	}

	public function get_filtered_total($search) {

		$prive = $this->session->userdata('roll');

		$this->db->select('*');
		$this->db->from('t_master_permohonan_barang');

		if (!empty($search)) {
			$this->db->like('username_pemohon', $search);
			$this->db->or_like('tgl_pengajuan', $search);
			$this->db->or_like('status_review', $search);
		}

		if ($prive == '2') {
			$this->db->where('t_master_permohonan_barang.username_pemohon', $this->session->userdata('username'));
		}

		return $this->db->count_all_results();
	}


}