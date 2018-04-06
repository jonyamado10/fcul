<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/main.css") ?>">
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
        ?>
        <div class="wrap-input100 validate-input"> <?php echo form_input('cardnumber',$this->input->post('cardnumber'),'class="input100", placeholder="Data" id="cardnumber" type="Date"');?>
          <span class="focus-input100"></span>
          <label class="label-input100" for="name">
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