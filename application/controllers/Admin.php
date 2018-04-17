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
  		$this->load->view('tabela_alunos',array());

	}
	public function tabela_docentes()
	{
		if (!isset($_SERVER['HTTP_REFERER']))
		{ redirect('Admin');}
  		$this->load->view('tabela_docentes',array());

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
		if (!isset($_SERVER['HTTP_REFERER']))
		{ redirect('Admin');}
		$this->load->view('tabela_acessos_alunos',array());

	}

	public function tabela_acessos_docentes()
	{
	
		if (!isset($_SERVER['HTTP_REFERER']))
		{ redirect('Admin');}
		$this->load->view('tabela_acessos_docentes',array());
	}

}
