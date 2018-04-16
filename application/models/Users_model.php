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
   	
		$sql = "SELECT a.num_aluno,concat(a.nome, ' ',a.apelido) as nome,a.email,a.num_cc, d.designacao as departamento
			FROM 
			  alunos AS a
			  JOIN departamentos AS d on d.id = a.id_departamento

			ORDER BY 
			a.num_aluno";
		return $this->db->query($sql);

    }
    public function get_total_alunos()
	{
      $query = $this->db->select("COUNT(*) as num")->get("alunos");
      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;
 	}

    function get_departamentos(){
    	$this->db->select('id,designacao');
		$this->db->from('departamentos');
		$query = $this->db->get(); 
        return $query->result_array();
    }

    function get_departamentos_alunos(){
    	$alunos_departamentos = array();
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

    function get_num_alunos_por_departamento(){
    	$alunos_por_departamentos = array();
    	$departamentos = $this->get_departamentos();
    	foreach ($departamentos as $departamento) {
    		$this->db->select('id');
			$this->db->from('alunos');
			$this->db->where('id_departamento',$departamento['id']);
			$query = $this->db->get();
			$alunos_por_departamentos[$departamento['designacao']] = $query->num_rows();

    	}
    	
    	return $alunos_por_departamentos;
    }

    function get_docentes() {
        $this->db->select('id, id_funcionario, id_departamento');
		$this->db->from('docentes');
		$query = $this->db->get(); 
        return $query->result_array();
    }

    function get_departamentos_docentes(){
    	$docentes_departamentos = array();
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
	function get_edificios(){
    	$this->db->select('id,designacao');
		$this->db->from('edificios');
		$query = $this->db->get(); 
        return $query->result_array();
    }

	function get_num_pessoas_por_edificio(){
    	$pessoas_por_edificio = array();
    	$edificios = $this->get_edificios();
    	foreach ($edificios as $edificio) {
    		$this->db->select('id');
			$this->db->from('pessoas');
			$this->db->where('id_edificio',$edificio['id']);
			$query = $this->db->get();
			$pessoas_por_edificios[$edificio['designacao']] = $query->num_rows();

    	}
    	
    	return $pessoas_por_edificios;
    }
?>