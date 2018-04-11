

  
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
          <i class="fa fa-table"></i> Tabela Alunos</div>
        <div class="card-body">
          <div class="table-responsive">
            <?php
              echo $table;
            ?>

              
          </div>
        </div>
        <div class="card-footer small text-muted"><?php date_default_timezone_set("Europe/Lisbon"); echo "Atualizado pela última vez às: " . date("G:i");?></div>
      </div>
   </div>
    <script src=<?php echo base_url("assets/vendor/datatables/jquery.dataTables.js") ?>></script>
    <script src=<?php echo base_url("assets/vendor/datatables/dataTables.bootstrap4.js") ?>></script>
<script>
$(document).ready(function(){
$('#dataTable').DataTable();
});
</script>