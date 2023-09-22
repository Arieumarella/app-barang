<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_exportData extends CI_Model {

	public function BarangPerSediaan($bulan)
	{
		$qry = "SELECT id_satuan, id_kondisi_barang, id_kategori_barang, t_stok_barang.nama_barang, SUM(harga_satuan) AS total_harga FROM t_stok_barang 
		LEFT JOIN t_barang ON t_stok_barang.id_kategori_barang=t_barang.id
		WHERE terpakai='0' AND MONTH(t_stok_barang.created_at) <= '$bulan' GROUP BY id_kategori_barang";
		
		return $this->db->query($qry)->result();

	}


	public function getDataAwalBarang()
	{
		$qry = "SELECT t_barang.*, t_satuan.nama_satuan FROM t_barang
		LEFT JOIN
		t_satuan ON t_barang.id_satuan=t_satuan.id";

		return $this->db->query($qry)->result();
	}



}