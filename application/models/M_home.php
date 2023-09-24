<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

	public function getJmlBarang()
	{
		$qry = "SELECT COUNT(*) AS jml_barang FROM t_barang";

		return $this->db->query($qry)->row();
	}


	public function getJumlhBeluTeriview()
	{
		$qry = "SELECT COUNT(*) AS jml_permohonan FROM t_master_permohonan_barang WHERE status_review='0'";

		return $this->db->query($qry)->row();
	}

	public function getJumlhTeriview()
	{
		$qry = "SELECT COUNT(*) AS jml FROM t_master_permohonan_barang WHERE status_review='1'";

		return $this->db->query($qry)->row();
	}


	public function saldoSaatIni()
	{
		$qry = "SELECT SUM(harga_satuan) AS saldo FROM t_stok_barang WHERE terpakai='0'";

		return $this->db->query($qry)->row();
	}


	public function dataTabel()
	{
		$qry = "SELECT * FROM t_master_permohonan_barang ORDER BY tgl_pengajuan";

		return $this->db->query($qry)->result();

	}


}