<?php 

class Login extends CI_Controller{
	

	public function login_validation(){
        $this->load->model('Users_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required|trim|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|md5');
		if($this->form_validation->run()){
			 session_unset(); 

			if($this->Users_model->is_aluno($this->input->post('email'))){

				$userInfo = $this->Users_model->get_alunoInfo($this->input->post('email'));
				$userInfo['is_logged_in_aluno'] = 1;
				$this->session->set_userdata($userInfo);
				$this->session->sess_expiration = '14400';// expires in 4 hour
            	redirect('Aluno/dashboard');
            
			}
			else{// se não é aluno, é funcionario
				$userInfo = $this->Users_model->get_funcionarioInfo($this->input->post('email'));
		
				$this->session->sess_expiration = '14400';// expires in 4 hours
            	if($this->Users_model->is_admin($userInfo['id'])){ //se é Admin?
            		$userInfo['is_logged_in_admin'] = 1;
            		$this->session->set_userdata($userInfo);	
            		redirect('Admin/dashboard');
            	}
            	else if($this->Users_model->is_docente($userInfo['id'])){ // se é docente?
            		$userInfo['is_logged_in_docente'] = 1;
            		$this->session->set_userdata($userInfo);
            		redirect('Docente/dashboard');
            	}
            	else{
            		$this->load->view('login');
            	}
            
			}

			
		}
		else{
			$this->load->view('login');

		}
	}
	public function validate_credentials(){
		$this->load->model('Users_model');

		if($this->Users_model->can_log_in()){
			return true;
		}
	
		else{
			$this->form_validation->set_error_delimiters('<p style= "color:red">Email / Palavra-chave Incorrectos.<br>','<br></p>');
			$this->form_validation->set_message('validate_credentials',' Tente Novamente');
			return false;
		}


	}

	public function logout(){

		$this->session->sess_destroy();
		redirect('Main/login');
	}

	
}





?>
