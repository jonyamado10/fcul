    <!-- Bootstrap core JavaScript-->
    <script src=<?php echo base_url("assets/vendor/jquery/jquery.min.js") ?>></script>
    <script src=<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>></script>
    <!-- Core plugin JavaScript-->
    <script src=<?php echo base_url("assets/vendor/jquery-easing/jquery.easing.min.js") ?>></script>
    <!-- Page level plugin JavaScript-->
    <script src=<?php echo base_url("assets/vendor/chart.js/Chart.min.js") ?>></script>
    <script src=<?php echo base_url("assets/vendor/datatables/jquery.dataTables.js") ?>></script>
    <script src=<?php echo base_url("assets/vendor/datatables/dataTables.bootstrap4.js") ?>></script>
    <!-- Custom scripts for all pages-->
    <script src=<?php echo base_url("assets/js/sb-admin.min.js") ?>></script>
    <!-- Custom scripts for this page-->
    <script src=<?php echo base_url("assets/js/sb-admin-datatables.min.js") ?>></script>

  <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/css/sb-admin.css') ?>" rel="stylesheet">
  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.css') ?>" rel="stylesheet">

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
$(document).ready(function() {
    $('#tabela-acessos-alunos').DataTable({
        "ajax": {
           paging: false,
           searching: false,
            url : "<?php echo site_url("Tabelas/acessos_alunos") ?>",
            type : 'GET'
        },
    });
});
</script>

