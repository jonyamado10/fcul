
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/main.css") ?>">
<!--===============================================================================================-->

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
        <div class="form-group"> <?php echo form_input('data',$this->input->post('data'),'class="form-control", id="data", value="2018-08-19",type="date"');?>
          <span class="focus-input100"></span>
          <label class="col-2 col-form-label" for="data">
            <span class="glyphicon glyphicon-credit-card"></span>
          </label>
        </div>
        <div class="form-group row">
  <label for="aaaa" class="col-2 col-form-label">Date</label>
  <div class="col-10">
    <input class="form-control" type="date" value="2011-08-19" id="aaa">
  </div>
</div>


        <div class="container-contact100-form-btn">
          <?php  
                  echo form_submit('gerar','Gerar', array('class' =>'contact100-form-btn'));
                  echo form_close(); 
                           
                    ?>
        </div>
      </div>
</div>