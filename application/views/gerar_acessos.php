


<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Ferramentas</a>
        </li>
        <li class="breadcrumb-item active">Gerar Acessos</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
<?php  
        echo form_open('Acessos/acessos_validation','class="contact100-form validate-form" id = "myForm"'); 
        echo validation_errors();
        $attr = array(
        'class'         => 'form-control',
        'id'           => 'data'
);
        ?>
        <div class="form-group validate-input" style="margin: 0 auto;"> <label class="col-form-label" for="data"> Introduza a Data em que os acessos devem ser gerados:<?php echo form_input('data',$this->input->post('data'),$attr);?>

          
            <span class="glyphicon glyphicon-credit-card"></span>
          </label>
        </div>
     
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
           data: $("data").serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
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