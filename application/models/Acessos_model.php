<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Acessos_model extends CI_Model {

    function get_acessos() {
        $query = $this->db->get('acessos');
        return $query->result_array();
    }
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
   
    function gerar_acessos(){
    	$data = $this->input->post('data');
    	$acessos = array();
    	$sensores = $this->get_sensores();
    	for ($i = 0; $i < 5000; $i++) {
    		$rand_sensor = array_rand($sensores);

    		if ($i<500) {
    			$hora = mt_rand(0,7).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);
    		}
    		else if ($i<2500) {
    			$hora = mt_rand(7,13).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);
    		}
    		else if ($i<4500) {
    			$hora = mt_rand(14,18).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);
    		}
    		else{
    			$hora = mt_rand(19,23).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);
    		}
    		print_r($rand_sensor);
    		$acesso = array(
    		'id_sensor' => $sensores[$rand_sensor]['id'],
			'data' => $data,
			'hora' => $hora);
    		array_push($acessos, $acesso);

    		if($sensores[$rand_sensor]['sentido'] == "Entrada"){
    			$sql = "UPDATE portas SET num_pessoas = num_pessoas + 1 WHERE id = $sensores[$rand_sensor]['id_porta']";
    			$query = $this->db->query($sql);

    		}
    		else{
    			$sql = "UPDATE portas SET num_pessoas = num_pessoas - 1 WHERE id = $sensores[$rand_sensor]['id_porta']";
    			$query = $this->db->query($sql);
    		}
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
			$ids_acessos = range($last_id - 4999, $last_id);
			shuffle($ids_acessos);
			$i=0;
			foreach ($ids_acessos as $id_acesso) {
				if ($i< 3500) {
					$rand_aluno = array_rand($ids_alunos);
					$acesso_aluno = array('id_acesso' => $id_acesso ,
											'id_aluno' => $ids_alunos[$rand_aluno]['id'] );
					array_push($acessos_alunos, $acesso_aluno);
					
				}
				else if($i < 4500){
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
    
}
?>