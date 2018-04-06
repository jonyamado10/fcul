


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
        echo form_open('Acessos/gerar_acessos','class="contact100-form validate-form"'); 
        echo validation_errors();
        $attr = array(
        'class'         => 'form-control input100',
        'id'           => 'data',
        'type'         => 'date',
        'value'        => '2018-08-19'
);
        ?>
        <div class="form-group wrap-input100 validate-input"> <label class="col-form-label" for="data"> Introduza a Data em que os acessos devem ser gerados:<?php echo form_input('data',$this->input->post('data'),$attr);?>

          
            <span class="glyphicon glyphicon-credit-card"></span>
          </label>
        </div>
     
        <div class="container-contact100-form-btn">
          <?php  
                  echo form_submit('gerar','Gerar', array('class' =>'contact100-form-btn'));
                  echo form_close(); 
                           
                    ?>
        </div>
      </div>
</div>

<script>
  $( document ).ready(function() {
    $("#data").prop('type', 'date');
    $("#data").prop('value', '2018-01-01');
});

</script>