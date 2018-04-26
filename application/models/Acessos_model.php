<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Acessos_model extends CI_Model {


    function get_ids_acessos() {
        $this->db->select('id');
		$this->db->from('acessos');
		$query = $this->db->get(); 
        return $query->result_array();
    }
    function get_ids_alunos() {
        $this->db->select('id');
		$this->db->from('alunos');
		$query = $this->db->get(); 
        return $query->result_array();
    }
    function get_ids_docentes() {
        $this->db->select('id');
		$this->db->from('docentes');
		$query = $this->db->get(); 
        return $query->result_array();
    }
    function get_ids_nao_docentes() {
        $this->db->select('id');
		$this->db->from('nao_docentes');
		$query = $this->db->get(); 
        return $query->result_array();
    }
    function get_sensores(){
    	$this->db->select('*');
		$this->db->from('sensores');
		$query = $this->db->get(); 
        return $query->result_array();
    }
    function get_acesso_mais_rencente_aluno($id_aluno){
    	$sql = "SELECT m.*, p.data,p.hora,p.id_sensor FROM  acessos_alunos AS m
 				JOIN acessos AS p on p.id = m.id_acesso
				WHERE m.id_aluno = $id_aluno
				ORDER BY p.data DESC, p.hora DESC";
		$query = $this->db->query($sql);
    	$result = $query->result_array()[0];
    	return $result;

    }
   
    function gerar_acessos(){
    	$data = $this->input->post('data');
    	$acessos = array();
    	$sensores = $this->get_sensores();
    	$n_acessos = 2000;
    	for ($i = 0; $i < $n_acessos; $i++) {
    		$rand_sensor = array_rand($sensores);

    		if ($i<$n_acessos*0.05) {
    			$hora = "0".mt_rand(0,7).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);
    		}
    		else if ($i<$n_acessos*0.25) {
    			$hora = "0".mt_rand(8,9).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);
    		}
    		else if ($i<$n_acessos*0.5) {
    			$hora = mt_rand(10,13).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);
    		}
    		else if ($i < $n_acessos*0.9) {
    			$hora = mt_rand(14,18).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);
    		}
    		else{
    			$hora = mt_rand(19,23).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);
    		}
    		$acesso = array(
    		'id_sensor' => $sensores[$rand_sensor]['id'],
			'data' => $data,
			'hora' => $hora);
    		array_push($acessos, $acesso);


		}
		$query = $this->db->insert_batch('acessos', $acessos);
		$last_id = $this->db->insert_id();

		if($query){
			$ids_alunos = $this->get_ids_alunos();
			$ids_docentes = $this->get_ids_docentes();
			$ids_nao_docentes = $this->get_ids_nao_docentes();
			$acessos_alunos = array();
			$acessos_docentes = array();
			$acessos_nao_docentes = array();
			$ids_acessos = range($last_id - ($n_acessos-1), $last_id);
			shuffle($ids_acessos);
			$i=0;
			foreach ($ids_acessos as $id_acesso) {
				if ($i< $n_acessos*0.8) {
					$rand_aluno = array_rand($ids_alunos);
					$acesso_aluno = array('id_acesso' => $id_acesso ,
											'id_aluno' => $ids_alunos[$rand_aluno]['id'] );
					array_push($acessos_alunos, $acesso_aluno);
					
				}
				else if($i < $n_acessos*0.95){
					$rand_docente = array_rand($ids_docentes);
					$acesso_docente = array('id_acesso' => $id_acesso ,
											'id_docente' => $ids_docentes[$rand_docente]['id'] );
					array_push($acessos_docentes, $acesso_docente);

				}
				else{
					$rand_nao_docente = array_rand($ids_nao_docentes);
					$acesso_nao_docente = array('id_acesso' => $id_acesso ,
											'id_nao_docente' => $ids_nao_docentes[$rand_nao_docente]['id']);
					array_push($acessos_nao_docentes, $acesso_nao_docente);
				}
				$i++;
			}
			$query1 = $this->db->insert_batch('acessos_alunos', $acessos_alunos);
			$query2 = $this->db->insert_batch('acessos_docentes', $acessos_docentes);
			$query3 = $this->db->insert_batch('acessos_nao_docentes', $acessos_nao_docentes);

			if ($query1 and $query2 and $query3) {
				return true;
			}
			else{
				$this->db->trans_rollback();
				return false;
			}	
		
			
		}
		else{
			$this->db->trans_rollback();
			return false;
		}

    }
    //ACESSOS ALUNOS
    function ha_novos_acessos_alunos(){
    	$sql = "SELECT count (*) as num
				FROM   acessos_alunos
				WHERE  not EXISTS (SELECT *
                  				 FROM   acessos_alunos_corrigidos
                   				WHERE  acessos_alunos.id_acesso = acessos_alunos_corrigidos.id_acesso);" ;
		$query = $this->db->query($sql);

		$result = $query->row();
      	if(isset($result)) return 1;
      	return 0;  

    }
      function get_alunos_com_acessos(){
    		$sql = "SELECT id_aluno from acessos_alunos
				group by id_aluno" ;
			$query = $this->db->query($sql);
			return $query->result_array();
    }

		function get_tabela_acessos_alunos(){
			
    		$acessos_corrigidos = array();
    		$alunos = $this->get_alunos_com_acessos();
    		foreach ($alunos as $aluno ) {
    			$id_aluno = $aluno['id_aluno'];
    			$sql = "SELECT m.id_acesso,al.num_aluno,concat(al.nome, ' ',al.apelido) as nome,s.sentido,  a.data,a.hora,
    							concat(p.edificio, '.',p.piso,'.',p.num_porta) as porta,s.sentido
						FROM acessos_alunos AS m
						  JOIN acessos AS a on a.id = m.id_acesso
						  join sensores as s on s.id = a.id_sensor
						  join portas as p on p.id = s.id_porta
						  join alunos as al on m.id_aluno = al.id
  						where m.id_aluno = $id_aluno
						ORDER BY a.data DESC, a.hora DESC";
			$query = $this->db->query($sql);
			$result = $query->result_array();
			array_push($acessos_corrigidos, $this->corrige_acessos($result));
    		}

    		return $this->insert_alunos_corrigidos($acessos_corrigidos);
		}
		function insert_alunos_corrigidos($array) { 
				$result = array();
				foreach ($array as $acessosPessoa) {
						# code...
					
					if(sizeof($acessosPessoa>1)){
						foreach ($acessosPessoa as $acesso) {
							if($acesso['id_acesso'] > 0){
							 	$acesso['passou_cartao'] = "Sim";
							}
							else{
								$acesso['passou_cartao'] = "Não";
							} 			
							array_push($result, $acesso);
						}
					 }
					 else{
					 		if($acesso['id_acesso'] > 0){
							 	$acesso['passou_cartao'] = "Sim";
							}
							else{
								$acesso['passou_cartao'] = "Não";
							} 		
					 	array_push($result, $acessosPessoa);
					 }
				
				}
				return $result;
		}
	  //ACESSOS Docentes
      function get_docentes_com_acessos(){
    		$sql = "SELECT id_docente from acessos_docentes
				group by id_docente" ;
			$query = $this->db->query($sql);
			return $query->result_array();
    }

	function get_tabela_acessos_docentes(){
			
    		$acessos_corrigidos = array();
    		$docentes = $this->get_docentes_com_acessos();
    		foreach ($docentes as $docente ) {
    			$id_docente = $docente['id_docente'];
    			$sql = "SELECT m.id_acesso,fu.num_funcionario,concat(fu.nome, ' ',fu.apelido) as nome,s.sentido,  
    			a.data,a.hora,concat(p.edificio, '.',p.piso,'.',p.num_porta) as porta,s.sentido
				FROM 
				  acessos_docentes AS m
				  JOIN acessos AS a on a.id = m.id_acesso
				  join sensores as s on s.id = a.id_sensor
				  join portas as p on p.id = s.id_porta
				  join docentes as do on m.id_docente = do.id
				  join funcionarios as fu on do.id_funcionario = fu.id
				where m.id_docente = $id_docente
				ORDER BY 
				a.data DESC, a.hora DESC";
			$query = $this->db->query($sql);
			$result = $query->result_array();
	
			array_push($acessos_corrigidos, $this->corrige_acessos($result));
    	
    		}
    		return $this->array_flatten($acessos_corrigidos);
	}
	 //ACESSOS Nao Docentes
    function get_naoDocentes_com_acessos(){
    		$sql = "SELECT id_nao_docente from acessos_nao_docentes
				group by id_nao_docente" ;
			$query = $this->db->query($sql);
			return $query->result_array();
    }

	function get_tabela_acessos_naoDocentes(){
			
    		$acessos_corrigidos = array();
    		$naoDocentes = $this->get_naoDocentes_com_acessos();
    		foreach ($naoDocentes as $naoDocente ) {
    			$id_naoDocente = $naoDocente['id_nao_docente'];
    			$sql = "SELECT m.id_acesso,fu.num_funcionario,concat(fu.nome, ' ',fu.apelido) as nome,s.sentido,  
    			a.data,a.hora,concat(p.edificio, '.',p.piso,'.',p.num_porta) as porta,s.sentido
				FROM 
				  acessos_nao_docentes AS m
				  JOIN acessos AS a on a.id = m.id_acesso
				  join sensores as s on s.id = a.id_sensor
				  join portas as p on p.id = s.id_porta
				  join nao_docentes as do on m.id_nao_docente = do.id
				  join funcionarios as fu on do.id_funcionario = fu.id
				where m.id_nao_docente = $id_naoDocente
				ORDER BY 
				a.data DESC, a.hora DESC";
			$query = $this->db->query($sql);
			$result = $query->result_array();
	
			array_push($acessos_corrigidos, $this->corrige_acessos($result));
    	
    		}
    		return $this->array_flatten($acessos_corrigidos);
		}


		function get_tabela_acessos_user_aluno(){
			
    		$acessos_corrigidos = array();

    		$id_aluno = $this->session->userdata('id');
    		$sql = "SELECT m.id_acesso,al.num_aluno,concat(al.nome, ' ',al.apelido) as nome,s.sentido,  a.data,a.hora,
    							concat(p.edificio, '.',p.piso,'.',p.num_porta) as porta,s.sentido
						FROM acessos_alunos AS m
						  JOIN acessos AS a on a.id = m.id_acesso
						  join sensores as s on s.id = a.id_sensor
						  join portas as p on p.id = s.id_porta
						  join alunos as al on m.id_aluno = al.id
  						where m.id_aluno = $id_aluno
						ORDER BY a.data DESC, a.hora DESC";
			$query = $this->db->query($sql);
			if($query->num_rows() == 0){
				return array();
			}
			else{
				$result = $query->result_array();
			
				array_push($acessos_corrigidos, $this->corrige_acessos($result));
    			return $this->array_flatten($acessos_corrigidos);
    		}
		}
		function get_tabela_acessos_user_docente(){
			
    		$acessos_corrigidos = array();

    		$id_docente = $this->session->userdata('id');
  			$sql = "SELECT m.id_acesso,fu.num_funcionario,concat(fu.nome, ' ',fu.apelido) as nome,s.sentido,  
    			a.data,a.hora,concat(p.edificio, '.',p.piso,'.',p.num_porta) as porta,s.sentido
				FROM 
				  acessos_docentes AS m
				  JOIN acessos AS a on a.id = m.id_acesso
				  join sensores as s on s.id = a.id_sensor
				  join portas as p on p.id = s.id_porta
				  join docentes as do on m.id_docente = do.id
				  join funcionarios as fu on do.id_funcionario = fu.id
				where fu.id = $id_docente
				ORDER BY 
				a.data DESC, a.hora DESC";
			$query = $this->db->query($sql);
			if($query->num_rows() == 0){
				return array();
			}
			else{
				$result = $query->result_array();
			
				array_push($acessos_corrigidos, $this->corrige_acessos($result));
    			return $this->array_flatten($acessos_corrigidos);
    		}
		}

	function corrige_acessos($acessos_por_pessoa){
		$copia_acessos = $acessos_por_pessoa;
		if(sizeof($acessos_por_pessoa) > 1){
			for ($i=0; $i <sizeof($acessos_por_pessoa)-1 ; $i++) { 
			 	if($acessos_por_pessoa[$i]['sentido'] == "Entrada"){
			 		if($acessos_por_pessoa[$i+1]['sentido'] == "Entrada"){ // temos que simular uma saida
			 				$copia_acesso=$acessos_por_pessoa[$i+1];
			 				$copia_acesso['sentido'] = "Saida";
			 				$copia_acesso['id_acesso'] = -$copia_acesso['id_acesso'];
			 				array_push( $copia_acessos, $copia_acesso ); // VOLTARA A EXPERIMENTAR ARRAY_SPLICE
			 				
			 				
			 		}
			 		
			 	}
			 	else{
			 		if($acessos_por_pessoa[$i+1]['sentido'] == "Saida"){ // temos que simular uma entrada
			 				$copia_acesso2=$acessos_por_pessoa[$i];
			 				$copia_acesso2['sentido'] = "Entrada";
			 				$copia_acesso2['id_acesso'] = -$copia_acesso2['id_acesso'];
			 				array_push( $copia_acessos, $copia_acesso2); 
	

			 		}
			 		else if($acessos_por_pessoa[$i+1]['sentido'] == "Entrada"){
			 			if($acessos_por_pessoa[$i]['porta'] != $acessos_por_pessoa[$i+1]['porta'] ){
			 				$copia_acesso= $acessos_por_pessoa[$i+1];
			 				$copia_acesso['sentido'] = "Saida";
			 				$copia_acesso['id_acesso'] = -$copia_acesso['id_acesso'];
			 				$copia_acesso2=$acessos_por_pessoa[$i];
			 				$copia_acesso2['sentido'] = "Entrada";
			 				$copia_acesso2['id_acesso'] = -$copia_acesso2['id_acesso'];
			 				array_push( $copia_acessos, $copia_acesso ); 
			 				array_push( $copia_acessos, $copia_acesso2); 
			 			}
			 		}
			 		else if(sizeof($acessos_por_pessoa) == $i+1){ // se nao há mais acessos
			 			$copia_acesso=$acessos_por_pessoa[$i];
			 			$copia_acesso['sentido'] = "Entrada";
			 			$copia_acesso['id_acesso'] = -$copia_acesso['id_acesso'];
			 			array_push( $copia_acessos, $copia_acesso ); 
			 	
			 		}
			 	}
			 } 
			}
		else{
			if($acessos_por_pessoa[0]['sentido'] == "Saida"){
				$copia_acesso=$acessos_por_pessoa[0];
		 		$copia_acesso['sentido'] = "Entrada";
		 		$copia_acesso['id_acesso'] = -$copia_acesso['id_acesso'];
		 		array_push($copia_acessos, $copia_acesso);
			}
		}
			
			return $copia_acessos;

		} 
	function acessos_alunos_count()
    {   
      $query = $this->db->select("COUNT(*) as num")->get("acessos_alunos");
      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;  

    }
    
	function get_acessos_alunos_nc($limit,$start,$col,$dir){

		$sql = "SELECT m.id_acesso,al.num_aluno,concat(al.nome, ' ',al.apelido) as nome,s.sentido,  
    			a.data,a.hora,concat(p.edificio, '.',p.piso,'.',p.num_porta) as porta,s.sentido
				FROM 
				  acessos_alunos AS m 
				  JOIN acessos AS a on a.id = m.id_acesso
				  join sensores as s on s.id = a.id_sensor
				  join portas as p on p.id = s.id_porta
				  join alunos as al on m.id_aluno = al.id
				  
				ORDER BY 
				$col $dir
				OFFSET $start ROWS
				FETCH NEXT $limit ROWS ONLY;";
		$query = $this->db->query($sql);
		if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
	}
	function acessos_alunos_search($limit,$start,$search,$col,$dir)
    {
    	$search_s = $search.'%';
    	$sql = "SELECT m.id_acesso,al.num_aluno,concat(al.nome, ' ',al.apelido) as nome,s.sentido,  
    			a.data,a.hora,concat(p.edificio, '.',p.piso,'.',p.num_porta) as porta,s.sentido
				FROM 
				  acessos_alunos AS m 
				  JOIN acessos AS a on a.id = m.id_acesso
				  join sensores as s on s.id = a.id_sensor
				  join portas as p on p.id = s.id_porta
				  join alunos as al on m.id_aluno = al.id
				WHERE concat(al.nome, ' ',al.apelido)  LIKE '$search_s' OR 
						data LIKE '$search_s' OR 
						concat (p.edificio, '.',p.piso,'.',p.num_porta) LIKE '$search_s' or 
						hora LIKE  '$search_s' or
						num_aluno LIKE '$search_s'
       
				ORDER BY 
				$col $dir
				OFFSET $start ROWS
				FETCH NEXT $limit ROWS ONLY;";
       	$query=$this->db->query($sql);

        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }
    function acessos_alunos_search_count($search)
    {
    	$search_s = $search.'%';
    	$sql = "SELECT count(*) as num
				FROM 
				  acessos_alunos AS m 
				  JOIN acessos AS a on a.id = m.id_acesso
				  join sensores as s on s.id = a.id_sensor
				  join portas as p on p.id = s.id_porta
				  join alunos as al on m.id_aluno = al.id
				WHERE concat(al.nome, ' ',al.apelido)  LIKE '$search_s' OR 
						data LIKE '$search_s' OR 
						concat (p.edificio, '.',p.piso,'.',p.num_porta) LIKE '$search_s' or 
						hora LIKE  '$search_s' or
						num_aluno LIKE '$search_s'";
       
       
    	$query = $this->db->query($sql);

      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;
 	}
    
   
		function array_flatten($array) { 
				$result = array();
				foreach ($array as $acessosPessoa) {
						# code...
					
					if(sizeof($acessosPessoa>1)){
						foreach ($acessosPessoa as $acesso) {
					
							 array_push($result, $acesso);
							 			
							 
						}
					 }
					 else{
					 	array_push($result, $acessosPessoa);
					 }
				
				}
				return $result;
		}
		function sum_time($horas, $op){
			list($h, $m) = explode(':', '00:10');
			if($op == '+'){
				return date('H:i', strtotime($horas) + $h*60*60 + $m*60); 
			}
			else{
				return date('H:i', strtotime($horas) - $h*60*60 - $m*60); 

			}
		}

}
?>