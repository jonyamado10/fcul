        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
  <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.css') ?>" rel="stylesheet">

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
     
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
   <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.jqueryui.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTable').DataTable({
        "ajax": {
            url : "<?php echo site_url("Tabelas/alunos") ?>",
            type : 'GET'
        },
    });
});
</script>

