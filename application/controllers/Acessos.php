<?php 

class Acessos extends CI_Controller{
	
	public function acessos_validation(){

		$this->load->model('Acessos_model');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('data', 'data', 'required|trim');
		if($this->form_validation->run()){
		   if($this->Acessos_model->gerar_acessos()){
		    $sucess = "Acessos gerados com sucesso";
          	
          	$this->load->view('gerar_acessos');
		   }
		   else{
		   	echo "Erro a gerar Acessos";
		   	return "data";
		   }

			}
		else{
			echo "Data Invalida";
			return "data";
			}

	}

}



?>
