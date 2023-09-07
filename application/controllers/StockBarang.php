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


	public function simpanInputBarang()
	{
		$jns_barang = $this->input->post('jns_barang');
		$namaKategoriBarang = $this->input->post('namaKategoriBarang');
		$kon_barang = $this->input->post('kon_barang');
		$jml_barang = $this->input->post('jml_barang');
		$hrg_satuan = $this->input->post('hrg_satuan');
		$noBukti = $this->input->post('noBukti');
		$tglMasuk = $this->input->post('tglMasuk');
		$arrayDate = explode('/',$tglMasuk);
		$catatan = $this->input->post('catatan');
		$username = $this->session->userdata('username');
		$nmFileGagalUpload ='';

		$dataInsert = array(
			'id_kategori_barang' => $jns_barang,
			'id_kondisi_barang' => $kon_barang,
			'nama_barang' => $namaKategoriBarang,
			'harga_satuan' => $hrg_satuan,
			'stok_barang_masuk' => $jml_barang,
			'tgl_bukti' => $arrayDate[2].'-'.$arrayDate[0].'-'.$arrayDate[1],
			'keterangan' => $catatan,
			'created_at' => date('Y-m-d H:i:s')
		);


		$arrayFile = array(
			'faktur' => 'Dokumen Faktru',
			'SPM' => 'Dokumen SPM',
			'SP2D' => 'Dokumen SP2D'
		);

		$arrayTypKolom = array(
			'faktur' => 'path_faktur',
			'SPM' => 'path_spm',
			'SP2D' => 'path_sp2d'
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

					$dataInsert["$arrayTypKolom[$key]"] = $fullPath;
					
				}
			}
		}

		$pros = $this->M_barang->simpanBarang($dataInsert, $jml_barang, $jns_barang);

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

		$dataMaster = $this->M_dinamis->getById('t_stok_barang', ['id' => $id]);
		$dataStock = $this->M_dinamis->getById('t_barang', ['id' => $dataMaster->id_kategori_barang]);

		if ($dataMaster->stok_barang_masuk > $dataStock->stok_barang) {
			echo json_encode(['code' => '401', 'msg' => 'Jumlah Stock barang yang ada sekarang kurang dari data yang ingin dihapus.!']);
			return;
		}

		$this->M_dinamis->update('t_barang', ['stok_barang' => $dataStock->stok_barang-$dataMaster->stok_barang_masuk], ['id' => $dataMaster->id_kategori_barang]);
		$this->M_dinamis->delete('t_stok_barang', ['id' => $id]);

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
			0 => 't_stok_barang.nama_barang',   
			1 => 't_barang.nama_barang',
			2 => 'harga_satuan' ,
			3 => 'stok_barang_masuk',
			4 => 'tgl_bukti'
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


}