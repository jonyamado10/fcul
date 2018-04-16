<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __contruct(){
		parent::__contruct();
        $this->load->model('Users_model');

	}
	public function index()
	{
		if($this->session->userdata('is_logged_in_admin')){
			$this->load->view('nav');
			$this->load->view('admin_dashboard');
			$this->load->view('footer');
		}
		else{
			header('HTTP/1.1 403 Forbidden'); 
		}
	}
	public function dashboard()
	{
		if (!isset($_SERVER['HTTP_REFERER']))
		{ redirect('Admin');}

		$this->load->view('admin_dashboard');
	}
	public function tabela_alunos()
	{
		if (!isset($_SERVER['HTTP_REFERER']))
		{ redirect('Admin');}
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
		if (!isset($_SERVER['HTTP_REFERER']))
		{ redirect('Admin');}

		$this->load->model('Users_model');
		$data['alunos_departamento']  = $this->Users_model->get_num_alunos_por_departamento();
		$this->load->view('grafico_alunos_departamento',$data);

	}

	public function grafico_pessoas_por_edificio()
	{
		if (!isset($_SERVER['HTTP_REFERER']))
		{ redirect('Admin');}

		$this->load->model('Users_model');
		$data['pessoas_edificio']  = $this->Users_model->get_num_pessoas_por_edificio();
		$this->load->view('grafico_pessoas_edificio',$data);

	}
	public function gerar_acessos()

	{
		if (!isset($_SERVER['HTTP_REFERER']))
		{ redirect('Admin');}

		$this->load->view('gerar_acessos');
	}

	public function tabela_acessos_alunos()
	{
	
		$this->load->model('Acessos_model');

		$acessos = $this->Acessos_model->get_tabela_acessos_alunos();

		$template = array('table_open'  => '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">');
		$this->table->set_heading("Aluno Nº", "Data", "Hora","Porta","Sentido","Passou Cartão?");

		foreach ($acessos as $acesso ) {
			if ($acesso['id_acesso'] > 0) {
				if ($acesso['sentido']=='Saida') {
					$cell = array('data' => $acesso['sentido'], 'class' => 'sentido', 'color' => 'red');
				}
				else{
					$cell = array('data' => $acesso['sentido'], 'class' => 'sentido', 'color' => 'green');
				}
				$this->table->add_row($acesso['num_aluno'],$acesso['data'],$acesso['hora'],$acesso['porta'],$cell, 'Sim');
			}
			else{
				if ($acesso['sentido']=='Saida') {
					$cell = array('data' => $acesso['sentido'], 'class' => 'sentido', 'color' => 'red');
				}
				else{
					$cell = array('data' => $acesso['sentido'], 'class' => 'sentido', 'color' => 'green');
				}
				$this->table->add_row($acesso['num_aluno'],$acesso['data'],$acesso['hora'],$acesso['porta'],$acesso['sentido'], 'Não');
				
			
			}
				
			
		}
  		$this->table->set_template($template);

		$data['table'] = $this->table->generate();
		$this->load->view('tabela_acessos_alunos',$data, $template);

	}

}
