<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docente extends CI_Controller {

	function __contruct(){
		parent::__contruct();

	}
	public function index()
	{
		if($this->session->userdata('is_logged_in_docente')){
			$this->load->view('nav_docente');
			$this->load->view('docente_dashboard');
			$this->load->view('footer_docente');
		}
		else{
			header('HTTP/1.1 403 Forbidden'); 
		}
	}
	public function dashboard()
	{
		if (!isset($_SERVER['HTTP_REFERER']))
		{ redirect('Docente');}

		$this->load->view('docente_dashboard');
	}
	public function tabela_meus_acessos()
	{
		if (!isset($_SERVER['HTTP_REFERER']))
		{ redirect('Docente');}
  		$this->load->view('tabela_meus_acessos_docente');

	}


}
