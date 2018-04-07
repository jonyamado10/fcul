<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Acessos_model extends CI_Model {

    function get_acessos() {
        $query = $this->db->get('acessos');
        return $query->result_array();
    }
    public function add_acesso(){
		date_default_timezone_set('Europe/Lisbon');
		$date = date('Y-m-d H:i:s');

		$data = array(
			'cardnumber' => $this -> input->post('cardnumber'),
			'building' => $this -> input->post('edificio'),
			'floornumber' => $this -> input->post('piso'),
			'door' => $this -> input->post('porta'),
			'date' => $date
			);
		$query = $this->db->insert('acessos',$data);
		if($query){
			return true;
		} else{
			return false;
		}

    }
    function gerar_acessos(){
    	$data = $this->input->post('data');
    	$acessos = array();
    	for ($i = 0; $i < 5000; $i++) {
    		$id_sensor = mt_rand(1,760);
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
    		$acesso = array(
    		'id_sensor' => mt_rand(1,760),
			'data' => $data,
			'hora' => $hora);
    		array_push($acessos, $acesso);
		}
		$query = $this->db->insert_batch('acessos', $acessos);
		if($query){
			return true;
		}
		else{
			return false;
		}

    }
    
}
?>