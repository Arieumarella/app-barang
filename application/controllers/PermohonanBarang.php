<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermohonanBarang extends CI_Controller {

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
		$this->load->model('M_permohonanBarang');
	}

	public function index()
	{
		$tmp = array(
			'tittle' => 'Permohonan Barang',
			'header_content' => 'header2',
			'footer_content' => 'footer',
			'sidebar' => 'sidebar-left',
			'content' => 'permohonanBarang',
			'datakondisi' => $this->M_dinamis->add_all('t_kondisi_barang', '*', 'id', 'asc'),
			'dataJnsBarang' => $this->M_dinamis->add_all('t_barang', '*', 'id', 'asc'),
			'dataStatus' => $this->M_dinamis->add_all('t_sts_approval', '*', 'id', 'asc')
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function simpanPermintaan()
	{
		$jns_barang = $this->input->post('jns_barang');
		$jml_barang = $this->input->post('jml_barang');
		$username = $this->session->userdata('username');
		$nmFileGagalUpload = '';

		$inputDataMaster = array(
			'username_pemohon' => $username,
			'tgl_pengajuan' => date('Y-m-d H:i:s'),
			'created_at' => date('Y-m-d H:i:s')
		);

		if (!file_exists('./assets/upload Dokumen Permintaan Barang')) {
			mkdir('./assets/upload Dokumen Permintaan Barang');
		}


		if (!file_exists("./assets/upload Dokumen Permintaan Barang/$username")) {
			mkdir("./assets/upload Dokumen Permintaan Barang/$username");
		}


		$path = "./assets/upload Dokumen Permintaan Barang/$username/";

		$pathX = $_FILES['permohonanBarang']['name'];
		$ext = pathinfo($pathX, PATHINFO_EXTENSION);


		$config['upload_path'] = $path;
		$config['allowed_types'] = 'pdf';
		$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.'.$ext;
		$config['max_size'] = 100000;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('permohonanBarang')){

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Berhasil.!</strong> Data Gagal Disimpan dengan alasan '.$this->upload->display_errors().'
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');

			redirect('/PermohonanBarang', 'refresh');

		}else{

			$upload_data = $this->upload->data();
			$namaFile = $upload_data['file_name'];
			$fullPath = $upload_data['full_path'];
			$inputDataMaster["path_permohonanBarang"] = $fullPath;

			$pros = $this->M_permohonanBarang->simpanData($inputDataMaster, $jns_barang, $jml_barang);

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

			redirect('/PermohonanBarang', 'refresh');

		}

	}

	public function deleteData()
	{
		$id = $this->input->post('id');


		$pros = $this->M_dinamis->delete('t_permintaan_barang', ['id' => $id]);

		if ($pros) {
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Berhasil.!</strong> Data berhasil Dihapus.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
		}

		echo json_encode(['code' => ($pros) ? 200 : 401, 'msg' => ($pros) ? '' : 'Gagal Dihapus.!']);

	}


	public function simpanApproval()
	{
		$dataStatus = $this->input->post('dataStatus');
		$jml_barangApprove = $this->input->post('jml_barangApprove');
		$catatan = $this->input->post('catatan');
		$idMaster = $this->input->post('idEditX');


		if ($dataStatus == '2') {
			$dataPermintaan = $this->M_dinamis->getById('t_permintaan_barang', ['id' => $idMaster]);
			$dataStokBarang = $this->M_dinamis->getById('t_barang', ['id' => $dataPermintaan->id_barang]);

			

			if ($jml_barangApprove > $dataStokBarang->stok_barang) {
				$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Gagal.!</strong> Jumlah Stok Barang Tidak Mencukupi.!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>');
				redirect('/PermohonanBarang', 'refresh');
				return;
			}

			$jmlStokKurang = $dataStokBarang->stok_barang-$jml_barangApprove;

			$dataUbahPermintaan = array(
				'status_approval' => $dataStatus,
				'ctatan_subag' => $catatan,
				'jml_approval' => $jml_barangApprove,
				'updated_at' => date('Y-m-d H:i:s')
			);

			
			$pros = $this->M_permohonanBarang->prosesApprove($dataUbahPermintaan, $idMaster, $jmlStokKurang, $dataPermintaan->id_barang);

		}else{
			$dataTidakApprove = array(
				'status_approval' => $dataStatus,
				'ctatan_subag' => $catatan,
				'updated_at' => date('Y-m-d H:i:s')
			);

			$pros = $this->M_dinamis->update('t_permintaan_barang', $dataTidakApprove, ['id' => $idMaster]);
		}

		if ($pros) {
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Berhasil.!</strong> Data berhasil Disimpan.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
		}else{
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Gagal.!</strong> Data Gagal Disimpan.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
		}

		redirect('/PermohonanBarang', 'refresh');

	}


	public function get_data() {

		$draw = $this->input->post('draw');
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = @$this->input->post('search')['value'];

		$orderColumnIndex = $this->input->post('order')[0]['column'];
		$orderDirection = $this->input->post('order')[0]['dir'];


		$sortableColumns = array(
			0 => 'username_pemohon',   
			1 => 'tgl_pengajuan',
			2 => 'status_review'
		);

		$orderColumn = $sortableColumns[$orderColumnIndex];

		$data = $this->M_permohonanBarang->get_filtered_data($start, $length, $search, $orderColumn, $orderDirection);
		$total = $this->M_permohonanBarang->get_total_data();
		$filtered_total = $this->M_permohonanBarang->get_filtered_total($search);

        // Format data sebagai JSON
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total,
			"recordsFiltered" => $filtered_total,
			"data" => $data
		);

		echo json_encode($output);
	}


	public function detailPermohonan($id=NULL)
	{
		if ($id==null) {
			
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Invalid Parameter.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');

			redirect('/PermohonanBarang', 'refresh');
		}

		$tmp = array(
			'tittle' => 'Permohonan Barang',
			'header_content' => 'header2',
			'footer_content' => 'footer',
			'sidebar' => 'sidebar-left',
			'content' => 'detailPermohonanBarang',
			'dataRekap' => $this->M_permohonanBarang->getDetailbarang($id),
			'idMaster' => $id,
			'dataMaster' => $this->M_dinamis->getById('t_master_permohonan_barang', ['id' => $id])
		);

		$this->load->view('tamplate/baseTamplate', $tmp);

	}


	public function getDataStockBarang()
	{
		$id = $this->input->post('id_jns_barangX');

		$data = $this->M_permohonanBarang->getStockBarang($id);

		echo json_encode($data); 

	}


	public function simpanApprove()
	{
		$idMaster = $this->input->post('idMaster');
		$sts_aprroval = $this->input->post('sts_aprroval');
		$jml_barang = $this->input->post('jml_barang');
		$id_jns_barang = $this->input->post('id_jns_barang');
		$catatan = $this->input->post('catatan');
		$idDetail = $this->input->post('idDetail');

		$pros = $this->M_permohonanBarang->prosesAprrovelBarangKeluar($idMaster, $sts_aprroval, $jml_barang, $id_jns_barang, $catatan, $idDetail);

		if ($pros) {
			$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Berhasil.!</strong> Data berhasil Disimpan.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
		}else{
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Gagal.!</strong> Data Gagal Disimpan.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
		}

		redirect("/PermohonanBarang/detailPermohonan/$idMaster", 'refresh');

	}


	public function getSockBarangById()
	{
		$id = $this->input->post('id');

		$data = $this->M_permohonanBarang->getStockBarangById($id);

		echo json_encode($data);
	}

	public function uploadBast()
	{
		$id = $this->input->post('idBarangBAST');


		if (!file_exists('./assets/upload Dokumen BAST')) {
			mkdir('./assets/upload Dokumen BAST');
		}


		$path = "./assets/upload Dokumen BAST/";

		$pathX = $_FILES['bast']['name'];
		$ext = pathinfo($pathX, PATHINFO_EXTENSION);


		$config['upload_path'] = $path;
		$config['allowed_types'] = 'pdf';
		$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.'.$ext;
		$config['max_size'] = 100000;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('bast')){

			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Berhasil.!</strong> Data Gagal Disimpan dengan alasan '.$this->upload->display_errors().'
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');

			redirect('/PermohonanBarang', 'refresh');

		}else{

			$upload_data = $this->upload->data();
			$namaFile = $upload_data['file_name'];
			$fullPath = $upload_data['full_path'];
			$inputDataMaster["path_permohonanBarang"] = $fullPath;

			$pros = $this->M_dinamis->update('t_master_permohonan_barang', ['path_bast' => $fullPath], ['id' => $id]);

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

			redirect('/PermohonanBarang', 'refresh');

		}

	}


}