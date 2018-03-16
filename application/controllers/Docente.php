<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docente extends CI_Controller {

	function __contruct(){
		parent::__contruct();

	}
	public function dashboard()
	{
		if($this->session->userdata('is_logged_in_docente')){
			$this->load->view('docente_dashboard');
		}
		else{
			header('HTTP/1.1 403 Forbidden'); 
		}
	}
	public function table()
	{
		$this->load->view('admin_dashboard');
	}
	
	public function chart()
	{
		$this->load->view('simulador');
	}
}
