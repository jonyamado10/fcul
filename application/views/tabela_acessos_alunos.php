<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Acesso</a>
        </li>
        <li class="breadcrumb-item active">Tabelas</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Alunos</div>
        <div class="card-body">
          <div class="table-responsive">

    <table class="table table-bordered" id="tabela-acessos-alunos" width="100%" cellspacing="0">
     <thead>
   <tr>
<th>Aluno Nº</th><th>Nome</th><th>Data</th><th>Hora</th><th>Porta</th><th>Sentido</th><th>Passou Cartão?</th></tr>
     </thead>
     <tbody>
     </tbody>
      <tfoot>
   <tr>
<th>Aluno Nº</th><th>Nome</th><th>Data</th><th>Hora</th><th>Porta</th><th>Sentido</th><th>Passou Cartão?</th></tr>
              </tfoot>
     </table>

              
          </div>
        </div>
        <div class="card-footer small text-muted"><?php date_default_timezone_set("Europe/Lisbon"); echo "Atualizado pela última vez às: " . date("G:i");?></div>
      </div>
   </div>

<script type="text/javascript">


    $('#tabela-acessos-alunos').DataTable({

        "processing": true,
        "serverSide": true,
        "ajax":{
         "url": "<?php echo base_url("Tabelas/acessos_alunos") ?>",
         "dataType": "json",
         "type": "POST",
        "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
                       },
          "columns": [
              { "data": "num_aluno" },
              { "data": "nome" },
              { "data": "data" },
              { "data": "hora" },
              { "data": "porta" },
              { "data": "sentido" },
              { "data": "passou_cartao" },
           ],

        "createdRow": function( row, data, dataIndex){
                if( data["sentido"] ==  'Entrada'){
                    $('td', row).eq(5).css("background-color", "#4af444");
                }
                if( data["sentido"] ==  'Saida'){
                  $('td', row).eq(5).css("background-color", "#f43838");
                }
                if( data["passou_cartao"] ==  'Não'){
                  $(row).css("background-color", "#bedfe2");
                  $('td', row).eq(3).text( "Indefinida" );

                }
          }
    });

</script>


