<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabelas extends CI_Controller {

  function __contruct(){
    parent::__contruct();
        $this->load->model('Users_model');


  }

  public function alunos()
     {
          $this->load->model('Users_model');
          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $alunos = $this->Users_model->get_alunos();

          $data = array();

          foreach($alunos->result() as $r) {

               $data[] = array(
                    $r->num_aluno,
                    $r->nome,
                    $r->email,
                    $r->num_cc ,
                    $r->departamento
               );
          }
          $total_alunos = $this->Users_model->get_total_alunos();
          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $total_alunos,
                 "recordsFiltered" => $total_alunos,
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }
      public function docentes()
     {
          $this->load->model('Users_model');
          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));

          $docentes = $this->Users_model->get_docentes();

          $data = array();

          foreach($docentes->result() as $r) {

               $data[] = array(
                    $r->num_funcionario,
                    $r->nome,
                    $r->email,
                    $r->num_cc ,
                    $r->departamento
               );
          }
          $total_docentes = $this->Users_model->get_total_docentes();
          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $total_docentes,
                 "recordsFiltered" => $total_docentes,
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }
    
     public function acessos_alunos()
     {
          $this->load->model('Acessos_model');
          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $acessos = $this->Acessos_model->get_tabela_acessos_alunos();

          $data = array();

          foreach($acessos as $acesso) {

              if ($acesso['id_acesso'] > 0) {
                          
                   $data[] = array(
                       $acesso['num_aluno'],
                        $acesso['nome'],
                        $acesso['data'],
                        $acesso['hora'],
                        $acesso['porta'],
                        $acesso['sentido'], 
                        'Sim'
                   );
              }
              else{
                    $data[] = array(
                        $acesso['num_aluno'],
                        $acesso['nome'],
                        $acesso['data'],
                        $acesso['hora'],
                        $acesso['porta'],
                        $acesso['sentido'], 
                        'Não'
                   );
              }
          }
           $data1 = array_slice($data, $start, $length);
          $total_acessos = sizeof($acessos);
          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $total_acessos,
                 "recordsFiltered" => $total_acessos,
                 "data" => $data1
            );
          echo json_encode($output);
          exit();
     }
     public function acessos_docentes()
     {
          $this->load->model('Acessos_model');
          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $acessos = $this->Acessos_model->get_tabela_acessos_docentes();

          $data = array();

          foreach($acessos as $acesso) {

              if ($acesso['id_acesso'] > 0) {
                          
                   $data[] = array(
                       $acesso['num_funcionario'],
                        $acesso['nome'],
                        $acesso['data'],
                        $acesso['hora'],
                        $acesso['porta'],
                        $acesso['sentido'], 
                        'Sim'
                   );
              }
              else{
                    $data[] = array(
                        $acesso['num_funcionario'],
                        $acesso['nome'],
                        $acesso['data'],
                        $acesso['hora'],
                        $acesso['porta'],
                        $acesso['sentido'], 
                        'Não'
                   );
              }
          }
          $data1 = array_slice($data, $start, $length);

          $total_acessos = sizeof($acessos);
          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $total_acessos,
                 "recordsFiltered" => $total_acessos,
                 "data" => $data1
            );
          echo json_encode($output);
          exit();
     }
      public function acessos_NaoDocentes()
     {
          $this->load->model('Acessos_model');
          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $acessos = $this->Acessos_model->get_tabela_acessos_NaoDocentes();

          $data = array();

          foreach($acessos as $acesso) {

              if ($acesso['id_acesso'] > 0) {
                          
                   $data[] = array(
                       $acesso['num_funcionario'],
                        $acesso['nome'],
                        $acesso['data'],
                        $acesso['hora'],
                        $acesso['porta'],
                        $acesso['sentido'], 
                        'Sim'
                   );
              }
              else{
                    $data[] = array(
                        $acesso['num_funcionario'],
                        $acesso['nome'],
                        $acesso['data'],
                        $acesso['hora'],
                        $acesso['porta'],
                        $acesso['sentido'], 
                        'Não'
                   );
              }
          }
          $total_acessos = sizeof($acessos);
          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $total_acessos,
                 "recordsFiltered" => $total_acessos,
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }
      public function acessos_user_aluno()
     {
          $this->load->model('Acessos_model');
          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));

          $acessos = $this->Acessos_model->get_tabela_acessos_user_aluno();

          $data = array();

          foreach($acessos as $acesso) {

              if ($acesso['id_acesso'] > 0) {
                          
                   $data[] = array(
                       $acesso['num_aluno'],
                        $acesso['nome'],
                        $acesso['data'],
                        $acesso['hora'],
                        $acesso['porta'],
                        $acesso['sentido'], 
                        'Sim'
                   );
              }
              else{
                    $data[] = array(
                        $acesso['num_aluno'],
                        $acesso['nome'],
                        $acesso['data'],
                        $acesso['hora'],
                        $acesso['porta'],
                        $acesso['sentido'], 
                        'Não'
                   );
              }
          }
          $total_acessos = sizeof($acessos);
          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $total_acessos,
                 "recordsFiltered" => $total_acessos,
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }

      public function acessos_user_docente()
     {
          $this->load->model('Acessos_model');
          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $acessos = $this->Acessos_model->get_tabela_acessos_user_docente();

          $data = array();

          foreach($acessos as $acesso) {

              if ($acesso['id_acesso'] > 0) {
                          
                   $data[] = array(
                       $acesso['num_funcionario'],
                        $acesso['nome'],
                        $acesso['data'],
                        $acesso['hora'],
                        $acesso['porta'],
                        $acesso['sentido'], 
                        'Sim'
                   );
              }
              else{
                    $data[] = array(
                        $acesso['num_funcionario'],
                        $acesso['nome'],
                        $acesso['data'],
                        $acesso['hora'],
                        $acesso['porta'],
                        $acesso['sentido'], 
                        'Não'
                   );
              }
          }
          $total_acessos = sizeof($acessos);
          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $total_acessos,
                 "recordsFiltered" => $total_acessos,
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }

public function acessos_alunos_nc()
{
    $this->load->model('Acessos_model');

    $columns = array( 
                            0 =>'num_aluno', 
                            1 =>'nome',
                            2=> 'data',
                            3=> 'hora',
                            4=> 'porta',
                            5=> 'sentido',
                            6=> 'passou_cartao',
                        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->Acessos_model->acessos_alunos_count();
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $acessos = $this->Acessos_model->get_acessos_alunos_nc($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $acessos =  $this->Acessos_model->acessos_alunos_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Acessos_model->acessos_alunos_search_count($search);
        }

        $data = array();
        if(!empty($acessos))
        {
            foreach ($acessos as $acesso)
            {

                $nestedData['num_aluno'] = $acesso->num_aluno;
                $nestedData['nome'] = $acesso->nome;
                $nestedData['data'] = $acesso->data;
                $nestedData['hora'] = $acesso->hora;
                $nestedData['porta'] = $acesso->porta;
                $nestedData['sentido'] = $acesso->sentido;
                if($acesso->id_acesso > 0){
                  $nestedData['passou_cartao'] = 'Sim';
                }
                else{
                  $nestedData['passou_cartao'] = 'Não';
                }

                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->input->post('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
}
}
