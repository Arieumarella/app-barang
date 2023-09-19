<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

	public function simpanBarang($dataInsertFaktur, $jns_barang, $namaKategoriBarang, $kon_barang, $jml_barang, $hrg_satuan)
	{
		$this->db->trans_begin();

		$this->db->insert('t_faktur', $dataInsertFaktur);

		$last_id = $this->db->insert_id();

		foreach ($jns_barang as $key => $value) {


			$jumlah_iterasi = (int)$jml_barang[$key];

			for ($i = 0; $i < $jumlah_iterasi; $i++) {

				$dataInsert = array(
					'id_kategori_barang' => $jns_barang[$key], 
					'id_kondisi_barang' => $kon_barang[$key],
					'id_faktur' => $last_id,
					'nama_barang' =>  $namaKategoriBarang[$key],
					'harga_satuan' => $hrg_satuan[$key],
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->db->insert('t_stok_barang', $dataInsert);

			}
		}


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	public function getDataDetail($id)
	{
		$qry = "SELECT a.*, b.nama_barang AS jns_barang FROM 
		(
			SELECT id_kategori_barang, id_kondisi_barang, nama_barang, harga_satuan, COUNT(*) AS jml_barang FROM t_stok_barang WHERE id_faktur='$id' GROUP BY id_kategori_barang
			) AS a
		LEFT JOIN
		(
			SELECT id, nama_barang FROM t_barang
		) AS b ON a.id_kategori_barang=b.id";

		return $this->db->query($qry)->result();
	}

	public function get_filtered_data($start, $length, $search, $orderColumn, $orderDirection) {
		$this->db->select('t_faktur.*, a.total_hargaX');
		$this->db->from('t_faktur');
		$this->db->join("(SELECT id_faktur, SUM(harga_satuan) AS total_hargaX FROM t_stok_barang WHERE terpakai='0' GROUP BY id_faktur) as a", 't_faktur.id = a.id_faktur', 'left');

		if (!empty($search)) {
			$this->db->like('t_faktur.no_faktur', $search);
			$this->db->or_like('t_faktur.tgl_faktur', $search);
			$this->db->or_like('a.total_hargaX', $search);
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
		$this->db->from('t_faktur');
		$this->db->join("(SELECT id_faktur, SUM(harga_satuan) AS total_hargaX FROM t_stok_barang WHERE terpakai='0' GROUP BY id_faktur) as a", 't_faktur.id = a.id_faktur', 'left');

		if (!empty($search)) {
			$this->db->like('t_faktur.no_faktur', $search);
			$this->db->or_like('t_faktur.tgl_faktur', $search);
		}

		return $this->db->count_all_results();
	}

}