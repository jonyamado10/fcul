<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabelas extends CI_Controller {

  function __contruct(){
    parent::__contruct();
        $this->load->model('Users_model');

  }
  public function alunos2()
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
        $template = array(
        'table_open'            => '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">',

        'thead_open'            => '<thead>',
        'thead_close'           => '</thead>',

        'heading_row_start'     => '<tr>',
        'heading_row_end'       => '</tr>',
        'heading_cell_start'    => '<th>',
        'heading_cell_end'      => '</th>',

        'tbody_open'            => '<tbody>',
        'tbody_close'           => '</tbody>',

        'row_start'             => '<tr>',
        'row_end'               => '</tr>',
        'cell_start'            => '<td>',
        'cell_end'              => '</td>',

        'row_alt_start'         => '<tr>',
        'row_alt_end'           => '</tr>',
        'cell_alt_start'        => '<td>',
        'cell_alt_end'          => '</td>',

        'table_close'           => '</table>'
);

          $this->table->set_template($template);
          $this->table->set_heading("Nº","Nome", "ola" ,"Sentido","Passou Cartão?");
          $data["table"] =  $this->table->generate($data);
         $this->load->view('tabela_acessos',$data);

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
                        'Nao'
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



}
