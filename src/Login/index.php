<?php
include_once("conexionBD.php");
/* Registrar usuario */
if(isset($_POST["registrar"])){
	$nombre=mysqli_real_escape_string($conexion,$_POST["nombre"]);
	$correo=mysqli_real_escape_string($conexion,$_POST["correo"]);
	$usuario=mysqli_real_escape_string($conexion,$_POST["user"]);
	$password=mysqli_real_escape_string($conexion,$_POST["pass"]);
	$password_encriptada = password_hash($password, PASSWORD_DEFAULT);
	$sqluser="select idusuarios from usuarios where usurio='$usuario'";
	$resultuser=$conexion->query($sqluser);
	$filas=$resultuser->num_rows;
	if($filas>0){
		echo "<script> alert('El usuario ya existe');
		window.location='index.php';</script>";
	}else{
		$sqlusuarioNuevo="insert into usuarios(Nombre,Correo,Usurio,Contraseña) values('$nombre','$correo','$usuario','$password_encriptada')";
		$resultusuarioNuevo=$conexion->query($sqlusuarioNuevo);
		if ($resultusuarioNuevo>0) {
			echo "<script> alert('Registro exitoso');
			window.location='index.php';</script>";
		}else{
			echo "<script> alert('Error al registrarse');
			window.location='index.php';</script>";
		}
	}
}
/* Login */
if (!empty($_POST)) {
    $usuario2 = mysqli_real_escape_string($conexion, $_POST["user"]);
    $contra = mysqli_real_escape_string($conexion, $_POST["pass"]);

    $sqlcontra = "SELECT idusuarios, rol, Contraseña FROM usuarios WHERE Usurio = '$usuario2'";
    $resultcontra = $conexion->query($sqlcontra);
    $filas = $resultcontra->num_rows;

    if ($filas > 0) {
        $fila = $resultcontra->fetch_assoc();

        // Verifica la contraseña encriptada
        if (password_verify($contra, $fila["Contraseña"])) {
            session_start();
            $_SESSION['id_usuario'] = $fila["idusuarios"];

            if ($fila["rol"] == 'admin') {
                echo "<script>window.location='../Admin/Admin.php';</script>";
            } else {
                echo "<script>window.location='../index.php';</script>";
            }
        } else {
            echo "<script>alert('Usuario o Contraseña Incorrecta'); window.location='index.php';</script>";
        }
    } else {
        echo "<script>alert('Usuario o Contraseña Incorrecta'); window.location='index.php';</script>";
    }
}

require '../PhpMailer/PHPMailer.php';
require '../PhpMailer/Exception.php';
require '../PhpMailer/SMTP.php';

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Sport Solutions</title>
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />
		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-leaf green"></i>
									<span class="red">"Forma Parte de la Familia Sport Solutions, </span>
									<span class="white" id="id-text2">Regístrate".</span>
								</h1>
								
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Ingresa tu Informacion
											</h4>

											<div class="space-6"></div>
											<!-- Formulario Login -->

											<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" >
												<fieldset>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control"  name="user"placeholder="Usuario" required/>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="pass"class="form-control" placeholder="Contraseña"required />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> Recordarme</span>
														</label>

											<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
												<i class="ace-icon fa fa-key"></i>
												<span class="bigger-110">Ingresar</span>
											</button>

													</div>
													<div class="space-4"></div>
												</fieldset>
											</form>

											<div class="social-or-login center">
												<span class="bigger-110">Suscribete</span>
											</div>

											<div class="space-6"></div>

											<div class="social-login center">
												<a href="#" target="_blank" class="btn btn-danger">
													<i class="ace-icon fa fa-youtube" ></i>
												</a>
												<a href="#" target="_blank" class="btn btn-primary">
													<i class="ace-icon fa fa-facebook"></i>
												</a>

												<a href="#" target="_blank" class="btn btn-info">
													<i class="ace-icon fa fa-twitter"></i>
												</a>

												<a href="#" target="_blank" class="btn btn-danger">
													<i class="ace-icon fa fa-instagram"></i>
												</a>
											</div>
										</div>

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													Olvide mi contraseña
												</a>
											</div>

											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link">
													Nuevo Registro
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div>
								</div>

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Recuperar Contraseña
											</h4>

											<div class="space-6"></div>
											<p>
												Ingresa tu correo electronico para recibir las instrucciones
											</p>

						<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" >
							<fieldset>
								<label class="block clearfix">
									<span class="block input-icon input-icon-right">
									<input type="email" class="form-control" placeholder="Email" name="email" />
									<i class="ace-icon fa fa-envelope"></i>
									</span>
								</label>
							<div class="clearfix">
								<button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
								<i class="ace-icon fa fa-lightbulb-o"></i>
								<span class="bigger-110">Enviar</span>
								</button>
							</div>
							</fieldset>
						</form>
				</div>

	<div class="toolbar center">
		<a href="#" data-target="#login-box" class="back-to-login-link">
			Regresar al Login
			<i class="ace-icon fa fa-arrow-right"></i>
			</a>
			</div>
			</div>
			</div>

	<div id="signup-box" class="signup-box widget-box no-border">
             	<div class="widget-body">
			<div class="widget-main">
				<h4 class="header green lighter bigger">
					<i class="ace-icon fa fa-users blue"></i>
						Registro de Nuevos Usuarios
				</h4>
	<div class="space-6"></div>

		<p>Ingresa los datos solicitados acontinuacion: </p>

		<!-- Formulario para regitrar usuario nuevo -->
		<!-- AQUI -->
		<!-- id="registro" -->
		<form id="registro" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" >
			<fieldset>
			            <label class="block clearfix">
					<span class="block input-icon input-icon-right">
						<input type="text" class="form-control"  name="nombre" placeholder="Nombre Completo"  required />
							<i class="ace-icon fa fa-users"></i>
					</span>
				</label>
			
				<label class="block clearfix">
					<span class="block input-icon input-icon-right">
				             	<input type="email" class="form-control" name="correo" placeholder="Email"  required />
					                        <i class="ace-icon fa fa-envelope"></i>
					</span>
				</label>
					<label class="block clearfix">
						<span class="block input-icon input-icon-right">
			                     		<input type="text" class="form-control" name="user" placeholder="Usuario"  required />
                                       				<i class="ace-icon fa fa-user"></i>
  						</span>
				</label>
				<label class="block clearfix">
                     				<span class="block input-icon input-icon-right">
		                      			<input type="password" class="form-control" name="pass" placeholder="Password"  required />
							<i class="ace-icon fa fa-lock"></i>
					</span>
				</label>

				<label class="block clearfix">
					<span class="block input-icon input-icon-right">
						<input type="password" class="form-control" name="passr" placeholder="Repetir password" />
							<i class="ace-icon fa fa-retweet"></i>
									</span>
				</label>

				<label class="block">
					<input type="checkbox" class="ace" />
						<span class="lbl">
						Acepto los
						<a href="#">Terminos de Uso</a>
						</span>
				</label>
				<div class="space-24"></div>
				<div class="clearfix">
					<button type="reset" class="width-30 pull-left btn btn-sm">
						<i class="ace-icon fa fa-refresh"></i>
							<span class="bigger-110">Reset</span>
					</button>
					
					<button type="submit" name="registrar"   class="width-65 pull-right btn btn-sm btn-success">
						<span class="bigger-110">Registrar</span>
							<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
					</button>
					 </div>
			</fieldset>
		</form>
	</div>

			<div class="toolbar center">
				<a href="#" data-target="#login-box" class="back-to-login-link">
					<i class="ace-icon fa fa-arrow-left"></i>
						Regresar al Login
				</a>
			</div>
		</div><!-- /.widget-body -->
	</div><!-- /.signup-box -->
</div><!-- /.position-relative -->

							<div class="navbar-fixed-top align-right">
								<br />
								&nbsp;
								<a id="btn-login-dark" href="#">Oscuro</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Azul</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Claro</a>
								&nbsp; &nbsp; &nbsp;
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});



			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');

				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');

				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');

				e.preventDefault();
			 });

			});
		</script>
	</body>
</html>
