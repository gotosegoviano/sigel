<?php

include("../encabezado_render.php");

?>
<!-- Contenido -->
<div class="row px-5">
    <div class="mb-4">
        <button class="btn btn-primary" data-toggle="modal" data-target="#editModal">
            <i class="fas fa-plus"></i>
            <span> Nuevo</span>
        </button>
    </div>
    <div class="col-md-12 mx-auto">
        <table class="table table-striped table-hover tabla-principal" id="tabla-usuarios">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Número de Control</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Estatus</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!-- fin contenido -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="needs-validation" id="frm-usuario" novalidate>
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
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rol" id="check-administrador" value="1">
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
          <button type="button" class="btn btn-danger d-none" id="btn-borrar-modal" data-toggle="modal" data-target="#eliminarModal">Borrar</button>
          <button type="button" class="btn btn-info mr-auto d-none" id="btn-reiniciar">Reiniciar contraseña</button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn-guardar">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminarModalLabel">Eliminar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Esta seguro de eliminar el usuario <span></span> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-outline-danger" id="btn-borrar">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<?php
include("../footer_render.php");
?>

<script defer>
    let data

    // Obtenemos los datos de la tabla de usuarios
    $('#tabla-usuarios').DataTable({
        "ajax": {
            "type": "POST",
            "url": '../../controllers/UsuarioController.php',
            "data": {'param1': 'getUsers'}
        },
        "language": {
            lengthMenu: "Mostrar _MENU_ resultados por página",
            search:       "Buscar:",
            zeroRecords: "No hay datos que mostrar",
            info: "Mostrando la página _PAGE_ de _PAGES_",
            infoEmpty: "No hay datos que mostrar",
            infoFiltered: "(filtrado de _MAX_ total datos)",
            paginate: {
                first:      "Primera",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Última"
            }
        },
        "columns": [
            {"data": "id_usuario", visible: false},
            {"data": "numero_control", className: "text-center"},
            {"data": "nombre", className: "text-center"},
            {"data": "correo", className: "text-center"},
            {"data": "carrera", className: "text-center"},
            {"data": "grupo", className: "text-center"},
            {"data": "rol", className: "text-center"},
            {"data": "estatus", className: "text-center"}
        ]
    });

   // Obtenemos datos de la fila presionada y mostramos el modal
   $('#tabla-usuarios tbody').on( 'click', 'td', function () {
        table = $('#tabla-usuarios').DataTable()
        data = table.row( $(this).parents('tr') ).data()

        $('#editModal').modal('show')
    });

    // Cargamos los datos obtenidos al presionar una fila en la tabla
    $('#editModal').on('shown.bs.modal', function (e) {
        if(data == null) {
            $('#btn-guardar').text("Guardar")
            $('#btn-borrar-modal').addClass('d-none')  
            $('#btn-reiniciar').addClass('d-none')  
        } else {
            // $('#btn-guardar').text("Guardar Cambios")
            $('#btn-borrar-modal').removeClass('d-none')  
            $('#btn-reiniciar').removeClass('d-none')  
            const nombre = data.nombre.split(" ")
            const grupo = data.grupo.split(" ")
            $('#input-nombre').val(nombre[0])
            $('#input-apellido-paterno').val(nombre[1])
            $('#input-apellido-materno').val(nombre[2])
            $('#input-correo').val(data.correo)
            $('#input-no-control').val(data.numero_control)
            data.rol === "Estudiante" ? $('#check-estudiante').attr('checked', true) : $('#check-docente').attr('checked', true)
            switch (data.carrera) {
                case "Ingeniería en Mecatrónica":
                    $('#select-carrera').val(1)
                    break;
                case "Ingeniería en Sistemas Computacionales":
                    $('#select-carrera').val(2)
                    break;
                case "Ingeniería Industrial":
                    $('#select-carrera').val(3)
                    break;
                case "Industrias Alimentarias":
                    $('#select-carrera').val(4)
                    break;
            }
            $('#select-grado').val(grupo[0])
            $('#input-grupo').val(grupo[1])
        }

    })

    // Acción al presionar el botón guardar en el modal
    $('#btn-guardar').click(function(e) {
        e.preventDefault()

        var form = $("#frm-usuario");
        if (form[0].checkValidity() === false ) {
            e.stopPropagation()
            form.addClass('was-validated');
            $('.invalid-feedback').css('display', 'block');
        } else {
            let datos = [];
            datos = [{
                id:                 data == null ? "0" : data.id_usuario,
                nombre: 			$('#input-nombre').val(),
                apellido_materno:	$('#input-apellido-materno').val(),
                apellido_paterno:	$('#input-apellido-paterno').val(),
                correo:				$('#input-correo').val(),
                numero_control:		$('#input-no-control').val()	,
                rol:				$("input[name='rol']:checked").val(),
                carrera:			$('#select-carrera').children("option:selected").val(),
                grado:				$('#select-grado').children("option:selected").val(),
                grupo:				$('#input-grupo').val()
            }]

            $.ajax({
                url: '../../controllers/UsuarioController.php',
                type: 'post',
                data: {param1: data == null ? 'registrarUsuario' : 'editarUsuario', param2: datos},
                dataType: 'json',
            })
            .done(function(response) 
            {
                if(response.success == true && data == null)
                {
                    alert("Tu contraseña es: " + response.msg +" puedes cambiarla en el menú opciones.")
                    $('#editModal').modal('hide')
                    $("#tabla-usuarios").DataTable().ajax.reload();
                }
                else if(response['error'] == 1 )
                {
                    alert(response['msg'])
                } else if(response.success){
                    alert("El usuario se ha modificado con exito")
                    $('#editModal').modal('hide')
                    $("#tabla-usuarios").DataTable().ajax.reload();
                }
            })
            .fail(function(response) {
                console.log("error"+response)
            })
        }
    })

    // Accion reiniciar contraseña 
    $('#btn-reiniciar').click(function(e){
        e.preventDefault()

        $.post( '../../controllers/UsuarioController.php', {param1: "reiniciar_contrasena", param2: data.id_usuario}, function( response ) {
            if(response.success)
            {
                alert(response.mensaje)
                $('#editModal').modal('hide')
                $("#tabla-usuarios").DataTable().ajax.reload();
            }
            else
            {
                alert(response['msg'])
            } 
        },'json');
    })

    //  Acción botón eliminar en modal de confirmación
    $('#btn-borrar').click(function(e){
        e.preventDefault()

        $.post( '../../controllers/UsuarioController.php', {param1: "eliminar_usuario", param2: data.id_usuario}, function( response ) {
            if(response.success)
            {
                alert(response.mensaje)
                $('#editModal').modal('hide')
                $("#tabla-usuarios").DataTable().ajax.reload();
            }
            else
            {
                alert(response['msg'])
            } 
        },'json');
    })


    // Limpiamos variables e inputs ne modal edit
    $('#editModal').on('hidden.bs.modal', function (e) {
        data = null
        $('#frm-usuario')[0].reset();

    })

</script>

</body>

</html>