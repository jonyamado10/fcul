 <?php  $this->load->view('nav');?>

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Gráficos</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
           <div class="card-header">
              <i class="fa fa-pie-chart"></i> Pie Chart Example</div>
            <div class="card-body">
              <canvas id="alunosDepartamento" width="100%" height="50"></canvas>
            </div>
            <div class="card-footer small text-muted"><?php print_r($alunos_departamento);
           echo json_encode(array_keys($alunos_departamento));?>Updated yesterday at 11:59 PM</div>
      </div>
    </div>
<?php  $this->load->view('footer');?>
<script type="text/javascript">
  <?php 
  $js_array = json_encode(array_keys($alunos_departamento));
  echo "var javascript_array = ". $js_array . ";\n";
  ?>
  var ctx = document.getElementById("alunosDepartamento");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: javascript_array,
    datasets: [{
      data: <?php echo json_encode(array_values($alunos_departamento));?>,
     
    }],
  },
});

</script>
