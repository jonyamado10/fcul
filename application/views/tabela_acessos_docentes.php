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
          <i class="fa fa-table"></i> Docentes</div>
        <div class="card-body">
          <div class="table-responsive">
     
    <table class="table table-bordered" id="tabela-acessos-docentes" width="100%" cellspacing="0">
     <thead>
   <tr>
<th>Funcionário Nº</th><th>Nome</th><th>Data</th><th>Hora</th><th>Porta</th><th>Sentido</th><th>Passou Cartão?</th></tr>
     </thead>
     <tbody>
     </tbody>
      <tfoot>
   <tr>
<th>Funcionário Nº</th><th>Nome</th><th>Data</th><th>Hora</th><th>Porta</th><th>Sentido</th><th>Passou Cartão?</th></tr>
              </tfoot>
     </table>

              
          </div>
        </div>
        <div class="card-footer small text-muted"><?php date_default_timezone_set("Europe/Lisbon"); echo "Atualizado pela última vez às: " . date("G:i");?></div>
      </div>
   </div>

        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />
    
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">


    $('#tabela-acessos-docentes').DataTable({

        "processing": true,
        "serverSide": true,
        "ajax":{
         "url": "<?php echo base_url("Tabelas/acessos_docentes") ?>",
         "dataType": "json",
         "type": "GET",
         "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
                       },

        "createdRow": function( row, data, dataIndex){
                if( data[5] ==  'Entrada'){
                    $('td', row).eq(5).css("background-color", "#4af444");
                }
                if( data[5] ==  'Saida'){
                  $('td', row).eq(5).css("background-color", "#f43838");
                }
                if( data[6] ==  'Não'){
                  $(row).css("background-color", "#bedfe2");
                  $('td', row).eq(3).text( "Indefenida" );

                }
          }
    });

</script>
