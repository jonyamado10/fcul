<?php  
class Users_model extends CI_model{

	public function can_log_in(){

		$this->db->where('email',$this->input->post('email'));
		$password = $this->input->post('password');
		$custo = '08';
		$salt = 'Cf1f11ePArKlBJomM0F6aJ';
		// Gera um hash baseado em bcrypt
		$hash = crypt($password, '$2a$' . $custo . '$' . $salt . '$');
		$this->db->where('password',$hash);
		$query = $this->db->get('alunos');
		$this->db->where('email',$this->input->post('email'));
		$this->db->where('password',$hash);
		$query2 = $this->db->get('funcionarios');

		if($query->num_rows()==1){
		
				return true;
		}
		else if ($query2->num_rows()==1) {
			return true;
			# code...
		}
		else{
			return false;
		}
	}
	public function can_log_in_admin(){

		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password',md5($this->input->post('password')));
		$query = $this->db->get('admin');

		if($query->num_rows()==1){
				return true;

		}
		else{

			return false;
		}
	}

     function is_aluno($email){
        $this->db->where('email',$email);
        $query = $this->db->get('alunos');
     
		if($query->num_rows()==1){
				return true;
		}
		else
			return false;
	}
	  function is_admin($id){
        $this->db->where('id_funcionario',$id);
        $query = $this->db->get('admin');
     
		if($query->num_rows()==1){
				return true;
		}
		else
			return false;
	}
	function is_docente($id){
        $this->db->where('id_funcionario',$id);
        $query = $this->db->get('docentes');
     
		if($query->num_rows()==1){
				return true;
		}
		else
			return false;
	}
    function get_alunoInfo($email){
        $this->db->where('email',$email);
        $query = $this->db->get('alunos');       
        foreach ($query->result() as $row)
            {
            	$userInfo = json_decode(json_encode($row), True);
            	unset($userInfo["password"]);
                return $userInfo;
            }
          
		return "Aluno Nao Encontrado";
	}
	function get_funcionarioInfo($email){
        $this->db->where('email',$email);
        $query = $this->db->get('funcionarios');       
        foreach ($query->result() as $row)
            {
            	$userInfo = json_decode(json_encode($row), True);
            	unset($userInfo["password"]);
                return $userInfo;
            }
          
		return "Funcionario Nao Encontrado";
	}

	function get_alunos() {
        $this->db->select('id, num_aluno, nome,apelido,email,num_cc,id_departamento');
		$this->db->from('alunos');
		$query = $this->db->get(); 
        return $query->result_array();
    }

    function get_departamentos_alunos(){
    	$alunos_departamentos = array();;
    	$alunos = $this->get_alunos();
    	foreach ($alunos as $aluno) {
    		 $this->db->select('designacao');
			 $this->db->from('departamentos');
			 $this->db->where('id',$aluno['id_departamento']);
			 $query = $this->db->get();
			 $designacao = $query->result_array()[0]['designacao'];
			 unset($aluno['id_departamento']);
			 $aluno['departamento'] = $designacao;
			 array_push($alunos_departamentos, $aluno);
    	}
    	return $alunos_departamentos;
    }

    function get_docentes() {
        $this->db->select('id, id_funcionario, id_departamento');
		$this->db->from('docentes');
		$query = $this->db->get(); 
        return $query->result_array();
    }

    function get_departamentos_docentes(){
    	$docentes_departamentos = array();;
    	$docentes = $this->get_docentes();
    	foreach ($docentes as $docente) {
    		 $this->db->select('designacao');
			 $this->db->from('departamentos');
			 $this->db->where('id',$docente['id_departamento']);
			 $query = $this->db->get();
			 $designacao = $query->result_array()[0]['designacao'];
			 unset($docente['id_departamento']);
			 $docente['departamento'] = $designacao;
			 array_push($docentes_departamentos, $docente);
    	}
    	return $docentes_departamentos;
    }
}





?>