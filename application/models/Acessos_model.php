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
    	$n_acessos = 1000;
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

    		$id_porta = $sensores[$rand_sensor]['id_porta'];
    		if($sensores[$rand_sensor]['sentido'] == "Entrada"){
    			$sql = "UPDATE portas SET num_pessoas = num_pessoas + 1 WHERE id = $id_porta";
    			$query = $this->db->query($sql);

    		}
    		else{
    			$sql = "UPDATE portas SET num_pessoas = num_pessoas - 1 WHERE id = $id_porta ";
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
    function get_alunos_varias_entradas(){
    		$sql = "SELECT id_aluno from acessos_alunos
				group by id_aluno
					having count(*) > 1";
			$query = $this->db->query($sql);
			return $query->result_array();
    }

		function get_acessos_alunos(){
			$sql = "SELECT m.id_acesso,m.id_aluno, a.data,a.hora,concat(p.edificio, '.',p.piso,'.',p.num_porta) as porta,s.sentido
						FROM acessos_alunos AS m
  						JOIN acessos AS a on a.id = m.id_acesso
  						join sensores as s on s.id = a.id_sensor
  						join portas as p on p.id = s.id_porta
						ORDER BY a.data DESC, a.hora DESC";
			$query = $this->db->query($sql);
    		$acessos = $query->result_array();
    		$alunos = this->get_alunos_varias_entradas();
    		foreach ($alunos as $aluno ) {
    			$sql = "SELECT m.id_acesso,m.id_aluno, a.data,a.hora,concat(p.edificio, '.',p.piso,'.',p.num_porta) as porta,s.sentido
						FROM acessos_alunos AS m
  						JOIN acessos AS a on a.id = m.id_acesso
  						join sensores as s on s.id = a.id_sensor
  						join portas as p on p.id = s.id_porta
  						where m.id_aluno = $aluno['id']
						ORDER BY a.data DESC, a.hora DESC";
			$query = $this->db->query($sql);
    		print_r($query->result_array());
    		echo "<br><br>"
    			# code...
    		}
		}    
}
?>