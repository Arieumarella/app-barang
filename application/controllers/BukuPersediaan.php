<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;

class BukuPersediaan extends CI_Controller {

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
		$this->load->model('M_exportData');
	}


	public function index()
	{
		$tmp = array(
			'tittle' => 'Export Laporan Barang Persediaan',
			'header_content' => 'header2',
			'footer_content' => 'footer',
			'sidebar' => 'sidebar-left',
			'content' => 'exportBarangBukuPersediaan'
		);

		$this->load->view('tamplate/baseTamplate', $tmp);
	}


	public function exportPersediaan()
	{
		$bulan = $this->input->post('tgl');
		$tahun = date('Y');
		$arrayBulan = array(
			'01' => 'Januari',
			'02' =>'Februari',
			'03' =>'Maret',
			'04' =>'April',
			'05' =>'Mei',
			'06' =>'Juni',
			'07' =>'Juli',
			'08' =>'Agustus',
			'09' =>'September',
			'10' =>'Oktober',
			'11' =>'November',
			'12' =>'Desember',
		);
		$combined_html = '';
		
		$jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

		$dataAwal = $this->M_exportData->getDataAwalBarang();

		foreach ($dataAwal as $key => $val) {
			
			$tmp = array(
				'datatable' => $this->M_exportData->BarangPerSediaan($bulan),
				'tahun' => $tahun,
				'hari' => date('d'),
				'Bulan' => $arrayBulan[$bulan],
				'maksHari' => $jumlah_hari,
				'bulanAngka' => $bulan,
				'jamMenit' => date('H:i A')
			);

			$combined_html .= $this->load->view('tamplatePdfBukuPersediaan', $tmp, TRUE);

		}

		$dompdf = new Dompdf();
		$dompdf->set_option('isHtml5ParserEnabled', true);
		$dompdf->set_option('isRemoteEnabled', true);
		$dompdf->setPaper('A4', 'landscape'); 
		
		$dompdf->loadHtml($combined_html);
		$dompdf->render();
		$pdf_content = $dompdf->output();
		ob_end_clean();
		$dompdf->stream('gabungan_pdf.pdf', array('Attachment' => 0));
	}


}