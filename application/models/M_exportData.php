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

	public function getDataTabel($id, $bulan)
	{
		$qry = "SELECT a.id, a.id_satuan, jns_barang, a.nama_barang, b.jml_barang_masuk, harga_satuan_barang_masuk, total_harga_barang, jml_barang_keluar, harga_satuan_barang_keluar,  total_harga_barang_keluar, tanggal, jml_stok_sekarang, total_saldo_sekarang  FROM (
			SELECT * FROM t_barang WHERE id='$id'
			) AS a
		LEFT JOIN
		(
			SELECT x.id_kategori_barang, jns_barang, id_faktur, jml_barang_masuk, total_harga_barang, harga_satuan_barang_masuk,tanggal, jml_stok_sekarang, total_saldo_sekarang, '' AS jml_barang_keluar, '' AS total_harga_barang_keluar, '' AS harga_satuan_barang_keluar  FROM
			(SELECT 'Barang Masuk' AS jns_barang, id_kategori_barang, id_faktur, COUNT(*) AS jml_barang_masuk, SUM(harga_satuan) AS total_harga_barang,  harga_satuan AS harga_satuan_barang_masuk, DATE(created_at) AS tanggal FROM t_stok_barang 
				WHERE id_kategori_barang='$id' AND MONTH(created_at) = $bulan GROUP BY id_faktur) AS X
			LEFT JOIN
			(SELECT id_kategori_barang, COUNT(*) AS jml_stok_sekarang, SUM(harga_satuan) AS total_saldo_sekarang FROM t_stok_barang WHERE id_kategori_barang='$id' AND terpakai='0' AND MONTH(created_at) < $bulan GROUP BY id_kategori_barang) AS Y
			ON x.id_kategori_barang=y.id_kategori_barang
			UNION
			SELECT x.id_kategori_barang, jns_barang, id_faktur, '' AS jml_barang_masuk, '' AS total_harga_barang, '' AS harga_satuan_barang_masuk,tanggal, jml_stok_sekarang, total_saldo_sekarang, jml_barang_keluar, total_harga_barang_keluar, harga_satuan_barang_keluar  FROM
			(SELECT 'Barang Keluar' AS jns_barang, id_kategori_barang, id_faktur, COUNT(*) AS jml_barang_keluar, SUM(harga_satuan) AS total_harga_barang_keluar,  harga_satuan AS harga_satuan_barang_keluar, DATE(created_at) AS tanggal FROM t_stok_barang 
				WHERE id_kategori_barang='$id' AND MONTH(created_at) = $bulan AND terpakai='1' GROUP BY tgl_terpakai) AS X
			LEFT JOIN
			(SELECT id_kategori_barang, COUNT(*) AS jml_stok_sekarang, SUM(harga_satuan) AS total_saldo_sekarang FROM t_stok_barang WHERE id_kategori_barang='$id' AND terpakai='0' GROUP BY id_kategori_barang) AS Y
			ON x.id_kategori_barang=y.id_kategori_barang
			) AS b ON a.id=b.id_kategori_barang
		ORDER BY tanggal";

		return $this->db->query($qry)->result();
	}


	public function getDataAwal($id, $bulan)
	{
		$qry = "SELECT COUNT(*) AS jml_stok_barang, IF(SUM(harga_satuan)IS NULL,0,SUM(harga_satuan)) AS total_saldo_awal FROM t_stok_barang WHERE terpakai='0' AND id_kategori_barang='$id' AND MONTH(created_at) < '$bulan'";

		return $this->db->query($qry)->row();
	}


	public function getDataBarang($id)
	{
		$qry = "SELECT CONCAT(a.id,a.id_satuan) AS id_barang_custom, nama_barang, nama_satuan FROM t_barang AS a
		LEFT JOIN
		t_satuan AS b ON a.id_satuan=b.id
		WHERE a.id='$id'";

		return $this->db->query($qry)->row();
	}



}