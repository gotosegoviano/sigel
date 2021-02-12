<?php

include("../encabezado_render.php");

?>
<!-- Contenido -->
<div class="row px-5">
    <div class="col-md-4 mb-4">
        <button class="btn btn-primary" data-toggle="modal" data-target="#editModal">
            <i class="fas fa-plus"></i>
            <span> Nuevo</span>
        </button>
    </div>
    <div class="col-md-12 mx-auto">
        <table class="table table-striped table-hover tabla-principal" id="tabla-danos">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">id_Material</th>
                    <th scope="col">Material</th>
                    <th scope="col">id_Responsable</th>
                    <th scope="col">Responsable</th>
                    <th scope="col">No. Control </th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Evidencia</th>
                    <th scope="col">Estado</th>
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
        <h5 class="modal-title" id="editModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="needs-validation" id="frm-danos" enctype="multipart/form-data" novalidate>
            <div class="invalid-feedback alert alert-danger" role="alert">
                <h6>Llene todos los campos correctamente</h6>
            </div>
            <div id="seccion-ingreso">
                <div class="row">
                    <div class="form-group col-md-12 mx-3 pr-5">
                        <label for="input-material">Material</label>
                        <select class="js-data-example-ajax form-control llenado-correcto" id="select-material" required>
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12 mx-3 pr-5">
                        <label for="input-usuario">Responsable</label>
                        <select class="js-data-example-ajax form-control llenado-correcto" id="select-usuario" required>
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                </div>
                <div class="row mx-3">
                    <div class="form-group col-md-3">
                        <label for="input-cantidad">Cantidad</label>
                        <input type="number" class="form-control llenado-correcto" value="1" min="1" aria-label="Cantidad" aria-describedby="basic-addon1" id="input-cantidad" required>
                    </div>
                    <div class="form-group mb-3 col-md-9">
                        <label for="input-fecha">Fecha</label>
                        <input type="date" class="form-control llenado-correcto" id="input-fecha" required>
                    </div>
                </div>
                <div class="form-group col-md-12 mx-3 pr-5">
                    <label for="input-archivo">Evidencia</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input llenado-completo" name="files[]" accept=".jpg,.jpeg,.png" id="input-archivo" multiple>
                        <label class="custom-file-label" for="input-archivo" data-browse="Elegir"></label>
                    </div>
                    <h6 class="text-muted mt-2">Solo acepta archivos con formato jpg, jpeg y png.</h6>
                    <ul class="list-inline lista-evidencia text-center ">
                    </ul>
                </div>
                <div class="col-md-12 mx-3 pr-5">
                    <label for="select-estado">Estado</label>
                    <select id="select-estado" class="form-control" required>
                        <option value="1">Pendiente</option>
                        <option value="2">Recuperado</option>
                    </select>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger mr-auto d-none" id="btn-borrar-modal" data-toggle="modal" data-target="#eliminarModal">Borrar</button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn-guardar">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Eliminar daño Modal -->
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminarModalLabel">Eliminar </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Esta seguro de eliminar el registro <span></span></p> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-outline-danger" id="btn-borrar">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Eliminar evidencia Modal -->
<div class="modal fade" id="eliminarEvidenciaModal" tabindex="-1" aria-labelledby="elimianrEvidenciaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="elimianrEvidenciaModalLabel">Eliminar <span></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Está seguro de que quiere eliminar la evidencia seleccionada?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn-elimina-evidencia">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<?php
include("../footer_render.php");
?>

<script defer>
    let data, componente, nombre

    // Obtenemos los datos de la tabla de materiales
    $('#tabla-danos').DataTable({
        "ajax": {
            "type": "POST",
            "url": '../../controllers/MaterialController.php',
            "data": {'param1': 'getDanos'}
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
            {"data": "id_dano", visible: false},
            {"data": "id_material", visible: false},
            {"data": "material", className: "text-center"},
            {"data": "id_usuario", visible: false},
            {"data": "usuario", className: "text-center"},
            {"data": "no_control", className: "text-center"},
            {"data": "cantidad", className: "text-center"},
            {"data": "fecha", className: "text-center"},
            {"data": "evidencia", className: "text-center",
                render: function (data){
                    if(data === "Sin Evidencias") {
                        return '<span class="text-danger">' + data + '</span>';
                    } else {
                        return '<span class="text-success">' + data + '</span>';
                    }
                }
            },
            {"data": "estado", className: "text-center",
                render: function(data) {
                    if (data === "Pendiente") {
                        return '<span class="text-warning">' + data + '</span>';
                    } else {
                        return '<span class="text-success">' + data + '</span>';
                    }
                }
            },
        ]
    });

   // Obtenemos datos de la fila presionada y mostramos el modal
   $('#tabla-danos tbody').on( 'click', 'td', function () {
        table = $('#tabla-danos').DataTable()
        data = table.row( $(this).parents('tr') ).data()

        $('#editModal').modal('show')
    });   

    // Cargamos los datos obtenidos al presionar una fila en la tabla
    $('#editModal').on('shown.bs.modal', function (e) {
        $("#select-material").select2({
            ajax: { 
                url: "../../controllers/MaterialController.php",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        param1: "getMaterialSelect",
                        palabra: params.term 
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        $("#select-usuario").select2({
            ajax: { 
                url: "../../controllers/UsuarioController.php",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        param1: "getUsuarioSelect",
                        palabra: params.term 
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        if(data == null) {
            $('#editModalLabel').text("Nuevo daño")
            $('#btn-guardar').text("Guardar")
            $('#btn-borrar-modal').addClass('d-none')  
            $('#select-estado').addClass('d-none')
            $("label[for='select-estado']").addClass('d-none')
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
            $('#input-fecha').val(today)
        } else {
            $('#editModalLabel').text("Editar daño " + data.material)
            $('#btn-guardar').text("Guardar Cambios")
            $('#btn-borrar-modal').removeClass('d-none')  
            $('#select-estado').removeClass('d-none')
            $("label[for='select-estado']").removeClass('d-none')

            $('#select-material').append('<option></option>')
            $('#select-material option:last').attr('value', data.id_material).text(data.material)
            $('#select-material').val(data.id_material).trigger('change')
            $('#select-usuario').append('<option></option>')
            $('#select-usuario option:last').attr('value', data.id_usuario).text(data.usuario)
            $('#select-usuario').val(data.id_usuario).trigger('change')
            $('#input-cantidad').val(data.cantidad)
            $('#input-fecha').val(data.fecha)
            $('#select-estado').val(data.estado == "Pendiente" ? 1 : 2)

            $.ajax({
                url: "../../controllers/MaterialController.php",
                type: "post",
                dataType: 'json',
                data: {param1: "obtener_evidencias", param2: data.id_dano}
            })
            .done(function(response) 
            {
                $.each (response.evidencia, function( index, value ) {
                    $('.lista-evidencia').append('<li></li>')
                    $('.lista-evidencia li').append('<td><li></li></td>').append('<td><span></span></td>')
                    $('.lista-evidencia li > td > li ').last().addClass('mt-2 list-inline-item').append('<img></img>')
                    $('.lista-evidencia li > td > li > img').last().attr('src',response.direccion+value)
                    $('.lista-evidencia li > td > span').last().attr({'class': 'mx-auto eliminar', 'id': 'eliminar'+ (parseInt(index,10)+1), "data-toggle": 'tooltip', "data-placement": "right", "title": "Eliminar", "data-toggle":"modal", "data-target": "#eliminarEvidenciaModal" }).append('<i class="fas fa-times-circle"></i>')
                })
                $('.lista-evidencia li > td >li').picEyes();
                
                $('.eliminar').on('click', function(){
                    const ruta = $(this).parent().prev().find('img').attr('src')
                    nombre = ruta.substr(ruta.lastIndexOf("/")+1) 
                })
            })
            .fail(function(response) {
                console.log('error'+response)
            })
            
        }
    })
  
    // Elimina la evidencia seleccionada
    $('#btn-elimina-evidencia').click(function(e) {
        e.preventDefault()

        datos = [{
            id:         data.id_dano,
            evidencia:  nombre
        }]

        $.ajax({
            url: "../../controllers/MaterialController.php",
            type: "post",
            dataType: 'json',
            data: {param1: "eliminar_evidencia", param2: datos}
        })
        .done(function(response) 
        {
            if (response.success)
            {
                $("#eliminarEvidenciaModal").modal('toggle')
                $('#eliminar'+nombre.split('_')[1].split('.')[0]).parent().parent().fadeOut(2000)
            } else {
                alert("Hubo un error al eliminar la evidencia, intentelo mas tarde.")
            }
        })
        .fail(function(response) {
            console.log('error'+response)
        })
    })


    // sube los archivos agregados y los muestra
    $('#input-archivo').on('change',function(){
        var form_data = new FormData()
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);

        form_data.append('param1', 'nueva_evidencia')

        var totalfiles = document.getElementById('input-archivo').files.length;
        for (var index = 0; index < totalfiles; index++) {
            form_data.append("files[]", document.getElementById('input-archivo').files[index]);
        }

        $.ajax({
            url: "../../controllers/MaterialController.php",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response)
            {
                const resp = JSON.parse(response)
                $.each (resp.msg, function( index, value ) {
                    $('.lista-evidencia').append('<li></li>')
                    $('.lista-evidencia li').append('<td><li><span></span></li></td>').append('<td><span></span></td>')
                    $('.lista-evidencia li > td > li ').last().addClass('mt-2 list-inline-item').append('<img>')
                    $('.lista-evidencia li > td > li > img').last().attr('src',resp.direccion+value)
                    $('.lista-evidencia li > td > span').last().attr({'class': 'mx-auto eliminar', 'id': 'eliminar'+ (parseInt(index,10)+1), "data-toggle": 'tooltip', "data-placement": "right", "title": "Eliminar", "data-toggle":"modal", "data-target": "#eliminarEvidenciaModal" }).append('<i class="fas fa-times-circle"></i>')
                    $('.lista-evidencia li > td').last().append('<i class="fas fa-exclamation-circle text-warning advertencia mt-n3 ml-n3" data-toggle="tooltip" data-placement="right" title="Elemento no guardado, presione en guardar."></i>')
                })
            }
        })
    })

    // Acción al presionar el botón guardar en el modal
    $('#btn-guardar').click(function(e) {
        e.preventDefault()

        var form = $("#frm-danos");
        if (form[0].checkValidity() === false ) {
            e.stopPropagation()
            form.addClass('was-validated');
            $('.invalid-feedback').css('display', 'block');
        } else {

            let evidencia = [], tmp, index=0;
            $('.lista-evidencia img').each(function(i, obj) {
                tmp = $(this).prop('src')
                tmp = tmp.replace('http://localhost/web/sigel/assets/img/Evidencias/','')
                if (tmp.length > 30) {
                    evidencia[index] = tmp.replace('http://localhost/web/sigel/assets/img/tmp/','')
                    index++;
                }
            });

            let datos = {
                id:        data == null ? null : data.id_dano,
                material : $('#select-material').children("option:selected").val(),
                usuario :  $('#select-usuario').children("option:selected").val(),
                cantidad:  $('#input-cantidad').val(),
                fecha :    $('#input-fecha').val(),
                estado :   $('#select-estado').children("option:selected").val()
            }

            $.ajax({
                url: "../../controllers/MaterialController.php",
                method: "POST",
                dataType: 'json',
                data: {'param1': data == null ? 'nuevo_dano' : 'edita_dano', param2: datos, param3: evidencia},
                success: function(response)
                {
                    alert(response.msg)
                    $('#editModal').modal('toggle')
                    $("#tabla-danos").DataTable().ajax.reload();
                }
            })
        }
    })

    // Obtiene al información del código de barras para imprimirlo
    $('#btn-imprimir-codigo').click(function(e) {
        e.preventDefault();
        var printContents = document.getElementById('code128').parentElement.innerHTML
        var originalContents = document.body.innerHTML
        document.body.innerHTML = printContents
        window.print()
        document.body.innerHTML = originalContents
        location.reload()
    })

    // Limpiamos variables e inputs ne modal edit
    $('#editModal').on('hidden.bs.modal', function (e) {
        data = null

        let evidencia = [], tmp, index=0;
        $('.lista-evidencia img').each(function(i, obj) {
            tmp = $(this).prop('src')
            tmp = tmp.replace('http://localhost/web/sigel/assets/img/Evidencias/','')
            if (tmp.length > 30) {
                evidencia[index] = tmp.replace('http://localhost/web/sigel/assets/img/tmp/','')
                index++;
            }
        });

        $.ajax({
            url: "../../controllers/MaterialController.php",
            type: "post",
            dataType: 'json',
            data: {param1: "borrar_tmps", param2: evidencia}
        })

        $('#select-material').empty()
        $('#select-usuario').empty()
        $('#input-cantidad').val(1)
        $('#input-archivo').next('.custom-file-label').html('');
        $('.lista-evidencia').empty()
    })

    $('#eliminarModal').on('show.bs.modal', function(e) {
        $(this).find('p > span').text(data.nombre)
    })

    // Recupera el focus en el modal edit
    $("#eliminarEvidenciaModal").on('hidden.bs.modal', function (e) {
        $('body').addClass('modal-open')
    })

   
   

</script>

</body>

</html>