
<!DOCTYPE html>
<html lang="en">
<head>
	<title>FCUL-Controlo de Acessos</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?php echo base_url("assets/images/icons/favicon.ico") ?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css") ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css") ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/fonts/iconic/css/material-design-iconic-font.min.css") ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css") ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendor/animate/animate.css") ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendor/css-hamburgers/hamburgers.min.css") ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendor/animsition/css/animsition.min.css") ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendor/select2/select2.min.css") ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendor/daterangepicker/daterangepicker.css") ?>>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/util.css") ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/main.css") ?>">
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="bg-container-contact100" style="background-image: url(<?php echo base_url("assets/images/bg-01.jpg"); ?>">
		<div class="contact100-header flex-sb-m">
			<a href="#" class="contact100-header-logo">
				<img src=<?php echo base_url("assets/images/icons/logo.png") ?> alt="LOGO">
			</a>

			<div>
				<a href="<?php echo base_url('login/logout');?>" >
					<button class="btn-show-contact100">
						Logout
					</button>
				</a>
			</div>
		</div>
		<!--NEW-->
		<div class=" flex-sb-m">
			
			
		<!--===============================================================================================-->
		<!-- Css da tabela pode se meter mesmo numa pasta de css para ficar melhor... -->
		<style>
		#t {
		    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		    border-collapse: collapse;
		    width: 80%;
		    margin-left:auto; 
    			margin-right:auto;
		    margin-top: 50px;
		    margin-bottom: 50px; 
		}

		#t td, #t th {
		    border: 1px solid #ddd;
		    padding: 8px;
		    background-color: #f2f2f2;
		}

		</style>
			
			<table id="t" class="table">
		 
		 		<tr>
		         	<th colspan="2"><h4 class="text-center">Professor Info</h3></th>
		 		</tr>
		        
		        <tr>
		        	<td>Número</td>
		         	<td>Teste</td>
		        </tr>
		          	
		        <tr>
		            <td>Nome</td>
		            <td>Buscar ao session...</td>
		        </tr>
		          
		      </table>


			<div>
				<a style="margin: 0 auto; display:block; text-align: center" href="" >
					<button type="button" class="btn btn-primary" disabled>
						Consultar Histórico de Acessos
					</button>
				</a>
				
			</div>
		</div>
	</div>
			
	



<!--===============================================================================================-->
	<script src=<?php echo base_url("assets/vendor/jquery/jquery-3.2.1.min.js") ?>></script>
<!--===============================================================================================-->
	<script src=<?php echo base_url("assets/vendor/animsition/js/animsition.min.js") ?>></script>
<!--===============================================================================================-->
	<script src=<?php echo base_url("assets/vendor/bootstrap/js/popper.js") ?>></script>
	<script src=<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.min.js") ?>></script>
<!--===============================================================================================-->
	<script src=<?php echo base_url("assets/vendor/select2/select2.min.js") ?>></script>
<!--===============================================================================================-->
	<script src=<?php echo base_url("assets/vendor/daterangepicker/moment.min.js") ?>></script>
	<script src=<?php echo base_url("assets/vendor/daterangepicker/daterangepicker.js") ?>></script>
<!--===============================================================================================-->
	<script src=<?php echo base_url("assets/vendor/countdowntime/countdowntime.js") ?>></script>
<!--===============================================================================================-->
	<script src=<?php echo base_url("assets/js/main.js") ?>></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>
</body>
</html>
