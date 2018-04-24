  <link href="<?php echo base_url('assets/clockpicker/css/bootstrap-clockpicker.min.css') ?>" rel="stylesheet">

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
        'class'         => 'form-control input100',
        'id'           => 'data'
);
        ?>
        <div class="form-group validate-input" style="margin: 0 auto;"> 
           <div class="wrap-input100 validate-input" > 
 
                <input id = "data" type="date" class="form-control input100" placeholder="Data">
                <span class="focus-input100"></span>
                <label class="label-input100" for="data">
                  <span ><i class="fas fa-calendar-alt"></i></span>
                </label>
           
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

            <div class="wrap-input100 validate-input" > 
 
            <select name="num_acessos" id="num_acessos" class="input100" style = "height: 60px;")">
              <option value=""<?php echo  set_select('num_acessos', 'none', TRUE); ?>>Nº Acessos a Gerar</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
                <option value="1500">1500</option>
                <option value="2000">2000</option>
                <option value="3000">3000</option>
                <option value="4000">4000</option>
                <option value="5000">5000</option>

          </select>
                <span class="focus-input100"></span>
                <label class="label-input100" for="data">
                  <span ><i class="fas fa-universal-access"></i></span>
                </label>
           
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

<script>
  $( document ).ready(function() {
    $("#data").prop('type', 'date');
    $("#data").prop('value', '2018-01-01');
});

</script>