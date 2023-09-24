<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockBarang extends CI_Controller {

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
		$this->load->model('M_barang');
	}


	public function index()
	{
		$tmp = array(
			'tittle' => 'Input Stock Barang',
			'header_content' => 'header2',
			'footer_content' => 'footer',
			'sidebar' => 'sidebar-left',
			'content' => 'inputBarang',
			'datakondisi' => $this->M_dinamis->add_all('t_kondisi_barang', '*', 'id', 'asc'),
			'dataJnsBarang' => $this->M_dinamis->add_all('t_barang', '*', 'id', 'asc')
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function detail($id=null)
	{
		if ($id == null) {
			
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Invalid parameter.!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');

			redirect('/StockBarang', 'refresh');
		}


		$tmp = array(
			'tittle' => 'Input Stock Barang',
			'header_content' => 'header2',
			'footer_content' => 'footer',
			'sidebar' => 'sidebar-left',
			'content' => 'detailBarang',
			'idContent' => $id,
			'datakondisi' => $this->M_barang->getDataDetail($id),
			'dataFaktur' => $this->M_dinamis->getById('t_faktur', ['id' => $id]),
			'listBarang' => $this->M_dinamis->add_all('t_barang', '*', 'id', 'asc')
		);

		$this->load->view('tamplate/baseTamplate', $tmp);

	}


	public function simpanInputBarang()
	{

		

		$noFaktur = $this->input->post('noFaktur');
		$tglFaktur = $this->input->post('tglFaktur');
		$arrayDate = explode('/',$tglFaktur);
		$nmFileGagalUpload ='';
		$username = $this->session->userdata('username');
		$jns_barang = $this->input->post('jns_barang');
		$namaKategoriBarang = $this->input->post('namaKategoriBarang');
		$kon_barang = $this->input->post('kon_barang');
		$jml_barang = $this->input->post('jml_barang');
		$hrg_satuan = $this->input->post('hrg_satuan');
		$tanggalFakturFormat = $arrayDate[2].'-'.$arrayDate[0].'-'.$arrayDate[1];



		$dataInsertFaktur = array(
			'no_faktur' => $noFaktur,
			'tgl_faktur' => $arrayDate[2].'-'.$arrayDate[0].'-'.$arrayDate[1],
			'created_at' => date('Y-m-d H:i:s')
		);


		$arrayFile = array(
			'faktur' => 'Dokumen Faktru',
			'SPM' => 'Dokumen SPM',
		);

		$arrayTypKolom = array(
			'faktur' => 'dok_faktur',
			'SPM' => 'dok_spm',
		);

		$config['allowed_types'] = 'pdf';
		$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.pdf';
		$config['max_size'] = 100000;
		$this->load->library('upload', $config);


		foreach ($arrayFile as $key => $value) {

			if (!empty($_FILES[$key]['name'])) {

				if (!file_exists('./assets/upload Dokumen Input Barang')) {
					mkdir('./assets/upload Dokumen Input Barang');
				}


				if (!file_exists("./assets/upload Dokumen Input Barang/$username")) {
					mkdir("./assets/upload Dokumen Input Barang/$username");
				}

				if (!file_exists("./assets/upload Dokumen Input Barang/$username/$value")) {
					mkdir("./assets/upload Dokumen Input Barang/$username/$value");
				}


				$path = "./assets/upload Dokumen Input Barang/$username/$value";

				$pathX = $_FILES[$key]['name'];
				$ext = pathinfo($pathX, PATHINFO_EXTENSION);


				$config['upload_path'] = $path;
				$config['allowed_types'] = 'pdf';
				$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.'.$ext;
				$config['max_size'] = 100000;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload($key)){

					$nmFileGagalUpload .= '   File'.$value.',';
					
				}else{

					$upload_data = $this->upload->data();
					$namaFile = $upload_data['file_name'];
					$fullPath = $upload_data['full_path'];

					$dataInsertFaktur["$arrayTypKolom[$key]"] = $fullPath;
					
				}
			}
		}

		$pros = $this->M_barang->simpanBarang($dataInsertFaktur, $jns_barang, $namaKategoriBarang, $kon_barang, $jml_barang, $hrg_satuan, $tanggalFakturFormat);

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

		redirect('/StockBarang', 'refresh');
	}


	public function deleteData()
	{
		
		$id = $this->input->post('id');

		$dataMaster = $this->M_dinamis->getById('t_stok_barang', ['id_faktur' => $id, 'terpakai' => '1']);

		if ($dataMaster != null) {
			echo json_encode(['code' => '401', 'msg' => 'Ada barang yang telah Digunakan.!']);
			return;
		}

		$this->M_dinamis->delete('t_stok_barang', ['id_faktur' => $id]);
		$this->M_dinamis->delete('t_faktur', ['id' => $id]);

		$this->session->set_flashdata('psn', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Berhasil.!</strong> Data berhasil Dihapus.!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');

		echo json_encode(['code' => '200']);

	}


	public function get_data() {

		$draw = $this->input->post('draw');
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = @$this->input->post('search')['value'];

		$orderColumnIndex = $this->input->post('order')[0]['column'];
		$orderDirection = $this->input->post('order')[0]['dir'];


		$sortableColumns = array(
			0 => 't_faktur.no_faktur',   
			1 => 't_faktur.tgl_faktur',
			2 => 'total_hargaX'
		);

		$orderColumn = $sortableColumns[$orderColumnIndex];

		$data = $this->M_barang->get_filtered_data($start, $length, $search, $orderColumn, $orderDirection);
		$total = $this->M_barang->get_total_data();
		$filtered_total = $this->M_barang->get_filtered_total($search);

        // Format data sebagai JSON
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total,
			"recordsFiltered" => $filtered_total,
			"data" => $data
		);

		echo json_encode($output);
	}


	public function getDataById()
	{
		$id = $this->input->post('id');

		$data = $this->M_dinamis->getById('t_faktur', ['id' => $id]);

		echo json_encode($data);
	}


	public function simpanEditFaktur()
	{	


		$idEdit = $this->input->post('idEdit');
		$noFakturEdit = $this->input->post('noFakturEdit');
		$tglFakturEdit = $this->input->post('tglFakturEdit');
		$arrayDate = explode('/',$tglFakturEdit);
		$tanggalFakturFormat = $arrayDate[2].'-'.$arrayDate[0].'-'.$arrayDate[1];
		$username = $this->session->userdata('username');
		$nmFileGagalUpload='';

		$dataEditFaktur = array(
			'no_faktur' => $noFakturEdit,
			'tgl_faktur' => $tanggalFakturFormat
		);


		$arrayFile = array(
			'fakturEdit' => 'Dokumen Faktru',
			'SPMEdit' => 'Dokumen SPM',
		);

		$arrayTypKolom = array(
			'fakturEdit' => 'dok_faktur',
			'SPMEdit' => 'dok_spm',
		);

		$config['allowed_types'] = 'pdf';
		$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.pdf';
		$config['max_size'] = 100000;
		$this->load->library('upload', $config);


		foreach ($arrayFile as $key => $value) {

			if (!empty($_FILES[$key]['name'])) {

				if (!file_exists('./assets/upload Dokumen Input Barang')) {
					mkdir('./assets/upload Dokumen Input Barang');
				}


				if (!file_exists("./assets/upload Dokumen Input Barang/$username")) {
					mkdir("./assets/upload Dokumen Input Barang/$username");
				}

				if (!file_exists("./assets/upload Dokumen Input Barang/$username/$value")) {
					mkdir("./assets/upload Dokumen Input Barang/$username/$value");
				}


				$path = "./assets/upload Dokumen Input Barang/$username/$value";

				$pathX = $_FILES[$key]['name'];
				$ext = pathinfo($pathX, PATHINFO_EXTENSION);


				$config['upload_path'] = $path;
				$config['allowed_types'] = 'pdf';
				$config['file_name'] = 'upload_time_'.date('Y-m-d').'_'.time().'.'.$ext;
				$config['max_size'] = 100000;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload($key)){

					$nmFileGagalUpload .= '   File'.$value.',';
					
				}else{

					$upload_data = $this->upload->data();
					$namaFile = $upload_data['file_name'];
					$fullPath = $upload_data['full_path'];

					$dataEditFaktur["$arrayTypKolom[$key]"] = $fullPath;
					
				}
			}
		}


		$pros = $this->M_dinamis->update('t_faktur', $dataEditFaktur, ['id' => $idEdit]);

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

		redirect('/StockBarang', 'refresh');

	}


	public function getBarangDigunakan()
	{
		$id_faktur = $this->input->post('id_faktur');
		$id_barang = $this->input->post('id_barang');

		$data = $this->M_dinamis->getById('t_stok_barang', ['id_faktur' => $id_faktur, 'id_kategori_barang' => $id_barang, 'terpakai' => '1']);

		if ($data != null) {
			echo json_encode(['code' => 401]);
		}else{
			echo json_encode(['code' => 200]);
		}

	}


	public function deleteDetailBarang()
	{
		$id_faktur = $this->input->post('id_faktur');
		$id_barang = $this->input->post('id_barang');

		$pros = $this->M_dinamis->delete('t_stok_barang', ['id_faktur' => $id_faktur, 'id_kategori_barang' => $id_barang]);

		echo json_encode(['code' => ($pros) ? 200:401, 'msg' => 'Data Gagal dihapus.!']);

	}


	public function getStockBarangByFakturIdBarang()
	{
		$id_faktur = $this->input->post('id_faktur');
		$id_barang = $this->input->post('id_barang');

		$data = $this->M_barang->getDataStockByKd($id_faktur, $id_barang);

		echo json_encode($data);

	}


	public function simpanEditData()
	{
		$id_faktur = $this->input->post('idFaktur');
		$id_barang = $this->input->post('idBarang');
		$jns_barang = $this->input->post('jns_barang');
		$nama_barang = $this->input->post('nama_barang');
		$jml_barang = $this->input->post('jml_barang');
		$harga_satuan = $this->input->post('harga_satuan');
		$idContent = $this->input->post('idContent');

		$pros = $this->M_barang->saveEditData($id_faktur, $id_barang, $jns_barang, $nama_barang, $jml_barang, $harga_satuan);

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

		redirect('/StockBarang/detail/'.$idContent, 'refresh');
	}


}