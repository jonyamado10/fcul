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


<script type="text/javascript">

 $(document).ready(function () {
    $('#tabela-acessos-docentes').DataTable({

        "pageLength" : 5,
        "serverSide": true,
        "order": [
          [1, "asc" ]
        ],

        "ajax": {
            url : "<?php echo site_url("Tabelas/tabela-acessos-docentes") ?>",
            type : 'GET'
        },
    });

   });
</script>
