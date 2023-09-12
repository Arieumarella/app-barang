<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('M_dinamis');
		
	}

	public function index()
	{
		$this->load->view('Login');
	}

	public function prs_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = $this->M_dinamis->getById('t_user', ['username' => $username, 'password' => $password]);

		if ($data == null) {
			$this->session->set_flashdata('psn', '
				<div class="alert alert-important alert-danger alert-dismissible" role="alert">
				<div class="d-flex">
				<div>
				<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
				</div>
				<div>
				Username & Password Salah.!
				</div>
				</div>
				<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
				</div>
				');

			redirect('/Login', 'refresh');
			return;
		}

		$dataSession = array(
			'nama' => $data->nama,
			'roll' => $data->id_roll,
			'email' => $data->email,
			'username' => $data->username,
			'sts_login' => true, 
		);

		$this->session->set_userdata($dataSession);

		redirect('/Home', 'refresh');

	}


	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('/Login', 'refresh');
	}


}