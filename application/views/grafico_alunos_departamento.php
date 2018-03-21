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
            <div class="card-footer small text-muted"><?php printr($alunos_departamento);?>Updated yesterday at 11:59 PM</div>
      </div>
    </div>
<?php  $this->load->view('footer');?>
<script type="text/javascript">
  var ctx = document.getElementById("alunosDepartamento");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Blue", "Red", "Yellow", "Green"],
    datasets: [{
      data: [12.21, 15.58, 11.25, 8.32],
      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});

</script>
