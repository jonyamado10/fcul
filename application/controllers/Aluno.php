<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends CI_Controller {

	function __contruct(){
		parent::__contruct();

	}
	public function index()
	{
		if($this->session->userdata('is_logged_in_aluno')){
			$this->load->view('nav_aluno');
			$this->load->view('aluno_dashboard');
			$this->load->view('footer_aluno');
		}
		else{
			header('HTTP/1.1 403 Forbidden'); 
		}
	}
	public function dashboard()
	{
		if (!isset($_SERVER['HTTP_REFERER']))
		{ redirect('aluno');}

		$this->load->view('aluno_dashboard');
	}
	public function tabela_meus_acesso()
	{
		if (!isset($_SERVER['HTTP_REFERER']))
		{ redirect('aluno');}
  		$this->load->view('tabela_meus_acessos',array());

	}


}
