<?php 

class Acessos extends CI_Controller{
	
	public function acessos_validation(){

		$this->load->model('Acessos_model');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('data', 'data', 'required|trim');
		if($this->form_validation->run()){
		   if($this->Acessos_model->gerar_acessos()){
		    $sucess = "Acessos gerados com sucesso!";
          	echo $sucess;
           
		   }
		   else{
		   	echo "Erro interno, a gerar Acessos, tente novamente!";
		   	return false;
		   }

			}
		else{

			echo $this->input->post('data');
			return false;
			}

	}

}



?>
