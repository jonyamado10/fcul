<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __contruct(){
		parent::__contruct();
        $this->load->model('Users_model');

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
		        $this->load->model('Users_model');

		$data['alunos'] = $this->Users_model->get_alunos();


		$template = array('table_open'  => '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">');
		$this->table->set_heading("ID", "Nº Aluno", "Nome","Apelido","Email","Nº Cartão de Cidadão","Departamento");
        $this->table->set_template($template);

		$data['table'] = $this->table->generate($data['alunos']);
		$this->load->view('tabela_alunos',$data, $template);

	}
	
	public function chart()
	{
		$this->load->view('simulador');
	}
}
