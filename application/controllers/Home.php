<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->model('M_home');
	}


	public function index()
	{

		$tmp = array(
			'tittle' => 'Home',
			'header_content' => 'header2',
			'footer_content' => 'footer',
			'sidebar' => 'sidebar-left',
			'content' => 'Home',
			'jns_barang' => $this->M_home->getJmlBarang(),
			'blm_review' => $this->M_home->getJumlhBeluTeriview(),
			'terreview' => $this->M_home->getJumlhTeriview(),
			'sisaSaldo' => $this->M_home->saldoSaatIni(),
			'datatable' => $this->M_home->dataTabel()
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


}