        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Tabelas</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Alunos</div>
        <div class="card-body">
          <div class="table-responsive">
     
    <table id="alunos-table" class="table table-bordered table-striped table-hover">
     <thead>
     <tr><th>Nº Aluno</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Nº Cartão de Cidadão</th>
      <th>Departamento</th></tr>
     </thead>
     <tbody>
     </tbody>
     </table>

              
          </div>
        </div>
        <div class="card-footer small text-muted"><?php date_default_timezone_set("Europe/Lisbon"); echo "Atualizado pela última vez às: " . date("G:i");?></div>
      </div>
   </div>
<script type="text/javascript">
$(document).ready(function() {
    $('#alunos-table').DataTable({
        "ajax": {
            url : "<?php echo site_url("books/books_page") ?>",
            type : 'GET'
        },
    });
});
</script>

