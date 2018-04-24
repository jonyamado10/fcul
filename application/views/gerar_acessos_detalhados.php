  <link href="<?php echo base_url('assets/clockpicker/css/bootstrap-clockpicker.min.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">


    <script src=<?php echo base_url("assets/clockpicker/js/bootstrap-clockpicker.min.js") ?>></script>



<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Ferramentas</a>
        </li>
        <li class="breadcrumb-item active">Gerar Acessos Detalhados</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
<?php  
        echo form_open('Acessos/acessos_validation','class="contact100-form validate-form" id = "myForm"'); 
        echo validation_errors();
        $attr = array(
        'class'         => 'form-control',
        'id'           => 'data data-placement="right" data-align="top" data-autoclose="true"'
);
        ?>
        <div class="form-group validate-input" style="margin: 0 auto;"> 
           <div class="wrap-input100 validate-input" > 
            <label class="col-form-label" for="data"> Introduza a Data em que os acessos devem ser gerados:</label>
            <?php echo form_input('data',$this->input->post('data'),$attr);?>

          </div>
          
        

        <div class="wrap-input100 validate-input" > 
            <div class = "clockpicker3" data-placement="right" data-align="top" data-autoclose="true">  
            <input id = "hora_inicial" type="text" class="input100" placeholder="Hora Inicial">
            <span class="focus-input100"></span>
            <label class="label-input100" for="hora_inicial">
              <span ><i class="fas fa-clock"></i></span>
            </label>
           </div>
           <div class = "clockpicker2" data-placement="right" data-align="top" data-autoclose="true">  <input id = "hora_inicial" type="text" class="input100" placeholder="Hora Final">
            <span class="focus-input100"></span>
            <label class="label-input100" for="hora_inicial">
              <span ><i class="fas fa-clock"></i></span>
            </label></div> 
        </div>

<script type="text/javascript">
$('.clockpicker').clockpicker();
$('.clockpicker2').clockpicker();
$('.clockpicker3').clockpicker();
</script>
        <div class="container-contact100-form-btn">
          <?php  
                  echo form_submit('gerar','Gerar', array('class' =>'contact100-form-btn', 'id' =>'BotaoGerar'));
                  echo form_close(); 
                           
                    ?>
        </div>
        <div id = "lo"></div>
        <script>
  $('#BotaoGerar').click(function(){
      $('#lo').html("<div class='loader' style = 'width:120px; height:120px; margin:0 auto'> </div>Aguarde ");
         var url = "<?php echo base_url('Acessos/acessos_validation') ?>"; // the script where you handle the form input.

        $.ajax({
               type: "POST",
               url: url,
               data: $("#data").serialize(), // serializes the form's elements.
               success: function(data)
               {
                   alert(data); // show response from the php script.
                   $("#content").load("<?php echo base_url('Admin/gerar_acessos') ?>");
                   
               }
             });

        return false; // avoid to execute the actual submit of the form.
     
    });
        </script>
      </div>
</div>

<script>
  $( document ).ready(function() {
    $("#data").prop('type', 'date');
    $("#data").prop('value', '2018-01-01');
});

</script>