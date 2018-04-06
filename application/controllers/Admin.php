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

		$data['alunos'] = $this->Users_model->get_departamentos_alunos();


		$template = array('table_open'  => '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">');
		$this->table->set_heading("ID", "Nº Aluno", "Nome","Apelido","Email","Nº Cartão de Cidadão","Departamento");
        $this->table->set_template($template);

		$data['table'] = $this->table->generate($data['alunos']);
		$this->load->view('tabela_alunos',$data, $template);

	}

	public function tabela_docentes()
	{
		        $this->load->model('Users_model');

		$data['docentes'] = $this->Users_model->get_departamentos_docentes();


		$template = array('table_open'  => '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">');
		$this->table->set_heading("ID", "ID Docente", "Departamento");
        $this->table->set_template($template);

		$data['table'] = $this->table->generate($data['docentes']);
		$this->load->view('tabela_docentes',$data, $template);

	}
	
	public function grafico_alunos_por_departamento()
	{
		$this->load->model('Users_model');
		$data['alunos_departamento']  = $this->Users_model->get_num_alunos_por_departamento();
		$this->load->view('grafico_alunos_departamento',$data);

	}

	public function grafico_pessoas_por_edificio()
	{
		$this->load->model('Users_model');
		$data['pessoas_edificio']  = $this->Users_model->get_num_pessoas_por_edificio();
		$this->load->view('grafico_pessoas_edificio',$data);

	}
	public function gerar_acessos()
	{
		$this->load->view('gerar_acessos');
	}
}
