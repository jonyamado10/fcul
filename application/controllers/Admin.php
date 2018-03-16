<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __contruct(){
		parent::__contruct();

	}
	public function dashboard()
	{
		if($this->session->userdata('is_logged_in_admin')){
			$this->load->view('admin_dashboard');
		}
		else{
			header('HTTP/1.1 403 Forbidden'); 
		}
	}
	public function tabela_alunos()
	{
		$data['alunos'] = $this->Users_model->get_alunos();
		
		$data['table'] = $this->table->generate($data['alunos']);
		$this->load->view('tabela_alunos',$data);

	}
	
	public function chart()
	{
		$this->load->view('simulador');
	}
}
