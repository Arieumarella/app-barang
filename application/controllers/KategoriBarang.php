<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriBarang extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		if ($this->session->userdata('sts_login') != true) {

			$this->session->set_flashdata('psn', '
				<div class="alert alert-important alert-danger alert-dismissible" role="alert">
				<div class="d-flex">
				<div>
				<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
				</div>
				<div>
				Anda Belum Login/Sessi Login Anda Telah Berakhir.!
				</div>
				</div>
				<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
				</div>
				');

			redirect('/Login', 'refresh');
			return;
		}

		$this->load->model('M_dinamis');
		$this->load->model('M_kategoriBarang');
	}


	public function index()
	{
		$tmp = array(
			'tittle' => 'Kategori Barang',
			'header_content' => 'header2',
			'footer_content' => 'footer',
			'sidebar' => 'sidebar-left',
			'content' => 'kategoriBarang',
			'dataSatuan' => $this->M_dinamis->add_all('t_satuan', '*', 'id', 'asc')
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}

	public function simpanBarang()
	{
		$jnsBarang = $this->input->post('namaKategoriBarang');
		$idSatuan = $this->input->post('satuan');

		$dataInsert = array(
			'nama_barang' => $jnsBarang,
			'id_satuan' => $idSatuan,
			'stok_barang' => 0,
			'created_at' => date('Y-m-d H:i:s')
		);

		$pros = $this->M_dinamis->save('t_barang', $dataInsert);

		if ($pros) {
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Berhasil.!</strong> Data berhasil Disimpan.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
		}else{
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Berhasil.!</strong> Data Gagal Disimpan.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
		}

		redirect('/KategoriBarang', 'refresh');
	}


	public function getById()
	{
		$id = $this->input->post('id');

		$data = $this->M_dinamis->getById('t_barang', ['id' => $id]);

		echo json_encode(['data' => $data]);
	}


	public function deleteData()
	{
		$id = $this->input->post('id');

		$pros = $this->M_dinamis->delete('t_barang', ['id' => $id]);

		if ($pros) {
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Berhasil.!</strong> Data berhasil DiHapus.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
		}else{
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Berhasil.!</strong> Data Gagal DiHapus.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
		}

		echo json_encode(['code' => 200]);
	}


	public function simpanEditSatuan()
	{
		$namaKategoriBarangEdit = $this->input->post('namaKategoriBarangEdit');
		$idEdit = $this->input->post('idEdit');
		$satuanEdit = $this->input->post('satuanEdit');

		$pros = $this->M_dinamis->update('t_barang', ['id_satuan' => $satuanEdit, 'nama_barang' => $namaKategoriBarangEdit, 'updated_at' => date('Y-m-d H:i:s')], ['id' => $idEdit]);

		if ($pros) {
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Berhasil.!</strong> Data berhasil DiUbah.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
		}else{
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Berhasil.!</strong> Data Gagal DiUbah.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
		}

		redirect('/KategoriBarang', 'refresh');

	}


	public function get_data() {

		$draw = $this->input->post('draw');
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = @$this->input->post('search')['value'];

		$orderColumnIndex = $this->input->post('order')[0]['column'];
		$orderDirection = $this->input->post('order')[0]['dir'];


		$sortableColumns = array(
			0 => 'nama_barang',   
			1 => 'stok_barang',
			2 => 'nama_satuan' 
		);

		$orderColumn = $sortableColumns[$orderColumnIndex];

		$data = $this->M_kategoriBarang->get_filtered_data($start, $length, $search, $orderColumn, $orderDirection);
		$total = $this->M_kategoriBarang->get_total_data();
		$filtered_total = $this->M_kategoriBarang->get_filtered_total($search);

        // Format data sebagai JSON
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total,
			"recordsFiltered" => $filtered_total,
			"data" => $data
		);

		echo json_encode($output);
	}

}