  <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
          <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
              <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#tabela-acessos-alunos').DataTable({
        "ajax": {
            url : "<?php echo site_url("Tabelas/acessos_alunos") ?>",
            type : 'GET'
        },
    });
});
</script>

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



