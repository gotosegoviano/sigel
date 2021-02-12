<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Gonzalo Torres Segoviano">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon.png">
	<title>SIGEL :. Inicia Sesión</title>

	<!-- Bootstrap core CSS -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">

	<meta name="theme-color" content="#563d7c">


	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
	}
	</style>
	<!-- Custom styles for this template -->
	<link href="../assets/css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
	<div class="col-md-3">
		<div class="invalid-feedback alert alert-danger" role="alert">
			<h6 id="error">Usuario y/o contraseña incorrectos</h6>
		</div>
		<form id="frm-ingresar" class="needs-validation" novalidate>
			<img class="mb-4" src="../assets/img/logo.png" alt="" width="200" height="200">
			<h1 class="h3 font-weight-normal">Acceso al sistema</h1>
			<h6 class="text-muted mb-3">Sistema de Gestión de Laboratorios (SIGEL)</h6>
			<label for="input-no-control" class="sr-only">Número de Control</label>
			<input type="text" id="input-no-control" class="form-control llenado-correcto" placeholder="Número de Control" pattern="[A-Za-z0-9_-]{1,30}" required autofocus>
			<label for="input-contrasena" class="sr-only">Contraseña</label>
			<input type="password" id="input-contrasena" class="form-control llenado-correcto" placeholder="Contraseña" required>
			<button class="btn btn-lg btn-primary btn-block" id="btn-ingresar">Ingresar</button>
		</form>
		<p class="mt-3" id="leyenda-registro">Si no tienes una cuenta <span data-toggle="modal" data-target="#registroModal"><b>Registrate aqui</b></span></p>
	</div>
	<div class="col-md-9 img-signin">
	</div>

	<!-- Modal Registro -->
	<div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="registroModalLabel">Registro</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="needs-validation" id="frm-registro" novalidate>
					<div class="invalid-feedback alert alert-danger" role="alert">
                        <h6>Llene todos los campos correctamente</h6>
                    </div>
					<div class="form-group col-md-12 text-left">
						<label for="input-nombre">Nombre (s)</label>
						<input type="text" class="form-control llenado-correcto" id="input-nombre" required>
					</div>
					<div class="row alinea text-left">
						<div class="form-group col-md-6">
							<label for="input-apellido-paterno">Apellido Paterno</label>
							<input type="text" class="form-control llenado-correcto" id="input-apellido-paterno" required>
						</div>
						<div class="form-group col-md-6">
							<label for="input-apellido-materno">Apellido Materno</label>
							<input type="text" class="form-control llenado-correcto" id="input-apellido-materno" required>
						</div>
					</div>
					<div class="form-group col-md-12 text-left">
						<label for="input-nombre">Correo Electrónico</label>
						<input type="email" class="form-control llenado-correcto" id="input-correo" required>
					</div>
					<div class="row text-left alinea">
						<div class="col-md-6 form-group">
							<label for="input-nombre">Número de Control</label>
							<input type="text" class="form-control llenado-correcto" id="input-no-control" required>
						</div>
						<div class="col-md-6 form-group mt-4">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="rol" id="check-alumno" value="2" checked>
							<label class="form-check-label" for="check-alumno">Estudiante</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="rol" id="check-docente" value="3">
							<label class="form-check-label" for="check-docente">Docente</label>
						</div>
						</div>
					</div>
					<div class="input-group mb-3 col-md-12">
						<div class="input-group-prepend">
							<label class="input-group-text" for="select-carrera">Carrera</label>
						</div>
						<select class="custom-select" id="select-carrera">
							<option value="1">Ingeniería en Mecatrónica</option>
							<option value="2">Ingeniería en Sistemas Computacionales</option>
							<option value="3">Ingeniería Industrial</option>
							<option value="4">Industrias Alimentarias</option>
						</select>
					</div>
					<div class="row alinea">
						<div class="input-group mb-3 col-md-6">
							<div class="input-group-prepend">
								<label class="input-group-text" for="select-grado">Grado</label>
							</div>
							<select class="custom-select" id="select-grado">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
							</select>
						</div>
						<div class="input-group mb-3 col-md-6">
							<div class="input-group-prepend">
								<label class="input-group-text" for="input-grupo">Grupo</label>
							</div>
							<input class="form-control llenado-correcto" type="text" id="input-grupo" required>
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="btn-registrar">Guardar</button>
			</div>
			</div>
		</div>
	</div>
	<script src="../assets/js/jquery-3.5.1.js"></script>
<!--	<script src="../assets/js/popper.min.js"></script>-->
	<script src="../assets/js/bootstrap.min.js"></script>
	<script defer>

	/* Ocultar campos carrera, grupo y grado */
	$("input[name='rol']").on('change', function(e) {
		console.log($(this).val())
		if ($(this).val() === "2")
		{
			$('#select-carrera').parent().removeClass('d-none')
			$('#select-grado').parent().removeClass('d-none')
			$('#input-grupo').parent().removeClass('d-none')
			$('input-grupo').attr('required', true)
		} else {
			$('#select-carrera').parent().addClass('d-none')
			$('#select-grado').parent().addClass('d-none')
			$('#input-grupo').parent().addClass('d-none')
			$('input-grupo').attr('required', false)
		}
	})
	
	/* Evento al presionar el botón ingresar */
	$('#btn-ingresar').click(function(e) {
		e.preventDefault();

		var form = $("#frm-ingresar");
        if (form[0].checkValidity() === false ) {
            e.stopPropagation()
            form.addClass('was-validated');
			$('.invalid-feedback').css('display', 'block');
			$('#error').html('Llene todos los campos correctamente');
        } else {
		
			$.ajax({
				url: '../controllers/UsuarioController.php',
				type: 'post',
				data: {param1: 'revisaUsuario', param2: $('#input-no-control').val(), param3:$('#input-contrasena').val(), 
				},
				dataType: 'json',
			})
			.done(function(response) {
				if(response.success==true){
					location.href='./' + response.dir + '/inicio.php';
				}
				else{
					$('#error').html('Usuario y/o contraseña incorrectos');
					$('.invalid-feedback').slideDown('slow').css('display', 'block');
					setTimeout(function (){
						$('.invalid-feedback').slideUp('slow');
					}, 3000);
				}
				
			})
			.fail(function(response) {
				console.log("error"+response);
			});
		}
		
	});

	// Al abrir el modal Registrar
	$('#registroModal').on('shown.bs.modal', function (e) {
		$('#input-nombre').focus();
	});

	// Al cerrar el modal Registrar
	$('#registroModal').on('hidden.bs.modal', function (e) {
		document.getElementById("frm-registro").reset();
	});

	/* Evento al presionar click en guardar dentro del modal*/
	$('#btn-registrar').click(function(e){
		e.preventDefault();

		var form = $("#frm-registro");
        if (form[0].checkValidity() === false ) {
            e.stopPropagation()
            form.addClass('was-validated');
            $('.invalid-feedback').css('display', 'block');
        } else {

			let datos = [];
			datos = [{
						nombre: 			$('#input-nombre').val(),
						apellido_materno:	$('#input-apellido-materno').val(),
						apellido_paterno:	$('#input-apellido-paterno').val(),
						correo:				$('#input-correo').val(),
						numero_control:		$('#input-no-control').val(),
						rol:				$("input[name='rol']:checked").val(),
						carrera:			$('#select-carrera').children("option:selected").val(),
						grado:				$('#select-grado').children("option:selected").val(),
						grupo:				$('#input-grupo').val()
			}];

			$.ajax({
				url: '../controllers/UsuarioController.php',
				type: 'post',
				data: {param1: 'registrarUsuario', param2: datos},
				dataType: 'json',
			})
			.done(function(response) 
			{
				if(response.success === true)
				{
					alert("Tu contraseña es: " + response.msg +" puedes cambiarla en el menú opciones.");
					$('#registroModal').modal('hide');
				}
				else if(response['error'] == 1 )
				{
					alert(response['msg']);
				} 
			})
			.fail(function(response) {
				console.log("error"+response);
			});
		}
	});

	</script>


</body>
</html>




