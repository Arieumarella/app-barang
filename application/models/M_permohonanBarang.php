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


	public function getDetailbarang($id)
	{
		$qry = "SELECT a.*, b.nama_barang, stock_barangX FROM 
		(SELECT * FROM t_detail_permohonan_barang WHERE id_master='$id') AS a
		LEFT JOIN
		(SELECT id, nama_barang FROM t_barang) AS b ON a.id_jns_barang=b.id
		LEFT JOIN
		(SELECT id_kategori_barang, COUNT(*) AS stock_barangX FROM t_stok_barang WHERE terpakai='0' GROUP BY id_kategori_barang) AS c
		ON a.id_jns_barang=c.id_kategori_barang
		";

		return $this->db->query($qry)->result();

	}


	public function getStockBarang($id)
	{
		$qry = "SELECT COUNT(*) AS jml_stock FROM t_stok_barang WHERE terpakai='0' AND id_kategori_barang='$id'";

		return $this->db->query($qry)->row();
	}



	public function prosesAprrovelBarangKeluar($idMaster, $sts_aprroval, $jml_barang, $id_jns_barang, $catatan, $idDetail)
	{
		

		$this->db->trans_begin();

		foreach ($sts_aprroval as $key => $value) {

			
			// Proses Ketika Panding/Reject
			if ($sts_aprroval[$key] == '0' or $sts_aprroval[$key] == '2') {

				$dataArryDetail = array(
					'sts_approval' => $sts_aprroval[$key],
					'catatan' => $catatan[$key]
				);

				$this->db->where(['id' => $idDetail[$key]]);
				$this->db->update('t_detail_permohonan_barang', $dataArryDetail);


			}
			// End Proses Ketika Panding/Reject


			// Proses Ketika Approve
			if ($sts_aprroval[$key] == '1') {

				$data = $this->db->get_where('t_detail_permohonan_barang', ['id' => $idDetail[$key]])->row();

				if ($data->sts_approval != '1') {
					$data = $this->db->query("SELECT * FROM t_stok_barang WHERE id_kategori_barang='$id_jns_barang[$key]' AND terpakai='0' ORDER BY created_at ASC LIMIT $jml_barang[$key] ")->result();

					foreach ($data as $keyApprove => $valApprove) {

						$dataUpdateStockBarang = array(
							'terpakai' => '1',
							'tgl_terpakai' => date('Y-m-d H:i:s')
						);

						$this->db->where(['id' => $valApprove->id]);
						$this->db->update('t_stok_barang', $dataUpdateStockBarang);
					}



					$dataArryDetail = array(
						'sts_approval' => $sts_aprroval[$key],
						'jml_barang_approve' => $jml_barang[$key],
						'catatan' => $catatan[$key]
					);

					$this->db->where(['id' => $idDetail[$key]]);
					$this->db->update('t_detail_permohonan_barang', $dataArryDetail);
				}

			}
			// End Proses Ketika Approve

		}

		// Update Data Maseter
		$data = $this->db->get_where('t_detail_permohonan_barang', ['id_master' => $idMaster, 'sts_approval' => '0'])->row();

		if ($data == null) {
			
			$dataArryDetailX = array(
				'status_review' => '1'
			);

			$this->db->where(['id' => $idMaster]);
			$this->db->update('t_master_permohonan_barang', $dataArryDetailX);
		}
		// End Update Data Maseter

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return true;
		}


	}


	public function getStockBarangById($id)
	{
		$qry = "SELECT COUNT(*) AS jml_stock FROM t_stok_barang WHERE id_kategori_barang='$id' AND terpakai='0'";

		return $this->db->query($qry)->row();;
	}


}