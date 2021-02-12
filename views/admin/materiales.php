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
    <div class="col-md-8 text-right">
        <button class="btn btn-outline-secondary mx-2" data-toggle="modal" data-target="#componentesModal" data-whatever="Tipos">
            <i class="fas fa-industry"></i>
            <span> Tipos</span>
        </button>
        <button class="btn btn-outline-secondary mx-2" data-toggle="modal" data-target="#componentesModal" data-whatever="Marcas">
            <i class="fas fa-copyright"></i>
            <span> Marcas</span>
        </button>
        <button class="btn btn-outline-secondary mx-2" data-toggle="modal" data-target="#componentesModal" data-whatever="Categorias">
            <i class="fas fa-stream"></i>
            <span> Categorias</span>
        </button>
    </div>
    <div class="col-md-12 mx-auto">
        <table class="table table-striped table-hover tabla-principal" id="tabla-materiales">
            <thead>
                <tr>
                    <th scope="col">No. de Material</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Categoria</th>
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
        <div class="custom-control custom-switch ml-auto">
            <input type="checkbox" class="custom-control-input" id="sw-archivo">
            <label class="custom-control-label" for="sw-archivo">Desde archivo</label>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="needs-validation" id="frm-material" novalidate>
            <div class="invalid-feedback alert alert-danger" role="alert">
                <h6>Llene todos los campos correctamente</h6>
            </div>
            <div class="row d-none" id="seccion-archivo">
                <label for="input-archivo" class="ml-4">Seleccionar archivo</label>
                <div class="form-group col-md-12 mx-3 pr-5">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input llenado-completo" accept=".xls,.xlsx,.csv" id="input-archivo">
                        <label class="custom-file-label" for="input-archivo" data-browse="Elegir"></label>
                    </div>
                    <h6 class="text-muted mt-2">Solo acepta archivos con formato xls, xlsx y csv.</h6>
                </div>
            </div>
            <div id="seccion-ingreso">
                <div class="row">
                    <div class="form-group col-md-8 ml-3">
                        <label for="input-nombre">Nombre</label>
                        <input type="text" class="form-control llenado-correcto" id="input-nombre" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="input-cantidad">Cantidad</label>
                        <input type="number" class="form-control" value="0" min="0" aria-label="Cantidad" aria-describedby="basic-addon1" id="input-cantidad" required>
                    </div>
                </div>
                <div class="input-group mb-3 col-md-12">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="select-tipo">Tipos</label>
                    </div>
                    <select class="custom-select" id="select-tipo" required>
                        <option value="" selected>Seleccione</option>
                    </select>
                </div>
                <div class="input-group mb-3 col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Descripción</span>
                        </div>
                        <textarea class="form-control" id="input-descripcion" aria-label="Descripción" required></textarea>
                    </div>
                </div>
                <div class="input-group mb-3 col-md-12">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="select-marca">Marcas</label>
                    </div>
                    <select class="custom-select" id="select-marca" required>
                        <option value="" selected>Seleccione</option>
                    </select>
                </div>
                <div class="input-group mb-3 col-md-12">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="select-categoria">Categorias</label>
                    </div>
                    <select class="custom-select" id="select-categoria" required>
                        <option value="" selected>Seleccione</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="row mt-3 d-none" id="codigo-barras">
            <div class="col-md-12 text-center">
                <svg id="code128"></svg>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger d-none" id="btn-borrar-modal" data-toggle="modal" data-target="#eliminarModal">Borrar</button>
        <button type="button" class="btn btn-info mr-auto d-none" id="btn-imprimir-codigo">Imprimir código</button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn-guardar">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Componenetes materiales -->
<div class="modal fade" id="componentesModal" tabindex="-1" aria-labelledby="componentesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="componentesModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-md-4 mb-4">
            <button class="btn btn-primary" data-toggle="modal" data-target="#editComponentesModal">
                    <i class="fas fa-plus"></i>
                    <span> Nuevo</span>
                </button>
            </div>
            <table class="table table-striped table-hover" id="tabla-componentes">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal editar componentes de materiales-->
<div class="modal fade" id="editComponentesModal" tabindex="-1" aria-labelledby="editComponentesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editComponentesModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="needs-validation" id="frm-componentes" novalidate>
                <div class="invalid-feedback alert alert-danger" role="alert">
                    <h6>Llene todos los campos correctamente</h6>
                </div>
                <div class="form-group col-md-12 text-left">
                    <label for="input-nombre">Nombre</label>
                    <input type="text" class="form-control llenado-correcto" id="input-nombre-componente" required>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btn-guardar-componente">Guardar</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
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

<?php
include("../footer_render.php");
?>

<script defer>
    let data, componente

   /* $(document).ajaxStart(function(){
        // Show image container
        $("#overlay").show();
    }).ajaxComplete(function(){
        // Hide image container
        $("#overlay").hide();
    });*/

    // Obtenemos los datos de la tabla de materiales
    $('#tabla-materiales').DataTable({
        "ajax": {
            "type": "POST",
            "url": '../../controllers/MaterialController.php',
            "data": {'param1': 'getMateriales'}
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
            {"data": "id_material", className: "text-center"},
            {"data": "nombre", className: "text-center"},
            {"data": "tipo", className: "text-center"},
            {"data": "descripcion", className: "text-center"},
            {"data": "cantidad", className: "text-center"},
            {"data": "marca", className: "text-center"},
            {"data": "categoria", className: "text-center"},
        ]
    });

    // Muestra / oculta la sección de ingreso desde archivo en modal edit
    $('#sw-archivo').on('change', function(e) {
        if ($(this).is(':checked'))
        {
            $('#seccion-ingreso').addClass('d-none')
            $('#seccion-archivo').removeClass('d-none')
            $('#frm-material').attr('enctype', 'multipart/form-data')
            $('#frm-material input').attr('required',false)
            $('#frm-material textarea').attr('required',false)
            $('#frm-material select').attr('required',false)
            
        } else {
            $('#seccion-archivo').addClass('d-none')
            $('#seccion-ingreso').removeClass('d-none')
            $('#frm-material').removeAttr('enctype')
            $('#frm-material input').attr('required', true )
            $('#frm-material textarea').attr('required',true)
            $('#frm-material select').attr('required',true)
        }
    })

   // Obtenemos datos de la fila presionada y mostramos el modal
   $('#tabla-materiales tbody').on( 'click', 'td', function () {
        table = $('#tabla-materiales').DataTable()
        data = table.row( $(this).parents('tr') ).data()

        $('#editModal').modal('show')
    });

    // Cargamos los datos obtenidos al presionar una fila en la tabla
    $('#editModal').on('shown.bs.modal', function (e) {
        $.ajax({
            url: '../../controllers/MaterialController.php',
            type: 'post',
            data: {param1: "get_datos_modal"},
            dataType: 'json',
        })
        .done(function(response) 
        {
            $.each(response.msg.tipo, function(){
                $('#select-tipo').append($('<option></option>').val(this.id).text(this.tipo))
            })
            $.each(response.msg.marca, function(key, entry){
                $('#select-marca').append($('<option></option>').val(this.id).text(this.marca))
            })
            $.each(response.msg.cat, function(key, entry){
                $('#select-categoria').append($('<option></option>').val(this.id).text(this.categoria))
            })
            
            if(data == null) {
                $('#sw-archivo').parent().removeClass('d-none')
                $('#editModalLabel').text("Nuevo material")
                $('#btn-guardar').text("Guardar")
                $('#btn-borrar-modal').addClass('d-none')  
                $('#btn-imprimir-codigo').addClass('d-none')
                $('#codigo-barras').addClass('d-none')  
            } else {
                $('#sw-archivo').parent().addClass('d-none')
                $('#editModalLabel').text("Editar material " + data.nombre)
                $('#btn-guardar').text("Actualizar")
                $('#btn-borrar-modal').removeClass('d-none')  
                $('#btn-imprimir-codigo').removeClass('d-none')
                $('#codigo-barras').removeClass('d-none')  
    
                $('#input-nombre').val(data.nombre)
                $('#input-cantidad').val(data.cantidad)
                $('#input-descripcion').val(data.descripcion)
                $('#select-tipo option:contains('+ data.tipo +')').attr('selected', 'selected')
                $('#select-marca option:contains('+ data.marca +')').attr('selected', 'selected')
                $('#select-categoria option:contains('+ data.categoria +')').attr('selected', 'selected')
                
                let nombre_material = data.nombre.split(' ').slice(0,2).join('') + "-" + data.id_material;
                JsBarcode("#code128", nombre_material, {
                    width: 2,
                    height: 40
                });
            }
        })
        .fail(function(response) {
            console.log('error'+response)
        })

    })

    // Acción al presionar el botón guardar en el modal
    $('#btn-guardar').click(function(e) {
        e.preventDefault()

        var form = $("#frm-material");
        if (form[0].checkValidity() === false ) {
            e.stopPropagation()
            form.addClass('was-validated');
            $('.invalid-feedback').css('display', 'block');
        } else {
            if ($('#sw-archivo').is(':checked'))
            {
                var form_data = new FormData()

                form_data.append('param1', 'archivo_materiales')
                form_data.append('file', $('input[type=file]')[0].files[0]);
                $.ajax({
                    url: "../../controllers/MaterialController.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response)
                    {
                        if (response === 1)
                        {
                            alert("Los datos se han guardado correctamente.")
                            $('#editModal').modal('hide')
                            $("#tabla-materiales").DataTable().ajax.reload();
                        } else {
                            alert("Hubo un error al guardar los datos.")
                        }
                    }
                })

            } else {
                let datos = [];
                datos = [{
                    id:                 data == null ? "0" : data.id_material,
                    nombre: 			$('#input-nombre').val(),
                    cantidad:       	$('#input-cantidad').val(),
                    descripcion:    	$('#input-descripcion').val(),
                    tipo:   			$('#select-tipo').children("option:selected").val(),
                    marca:  			$('#select-marca').children("option:selected").val(),
                    categoria:			$('#select-categoria').children("option:selected").val(),
                }]

                $.ajax({
                    url: '../../controllers/MaterialController.php',
                    type: 'post',
                    data: {param1: data == null ? 'registrarMaterial' : 'editarMaterial', param2: datos},
                    dataType: 'json',
                })
                .done(function(response) 
                {
                    if(response.success == true)
                    {
                        alert(response.msg)
                        $('#editModal').modal('hide')
                        $("#tabla-materiales").DataTable().ajax.reload();
                    } else {
                        alert(response.msg)
                    }
                })
                .fail(function(response) {
                    console.log("error"+response)
                })
            }
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
        $('#frm-material')[0].reset();
        $('#frm-material select').empty().append($('<option></option>').val('').text('Seleccione'))  
        $('#seccion-archivo').addClass('d-none')
        $('#seccion-ingreso').removeClass('d-none')
        document.getElementById("sw-archivo").checked = false;
    })

    $('#eliminarModal').on('show.bs.modal', function(e) {
        $(this).find('p > span').text(data.nombre)
    })

    $('#input-archivo').on('change',function(){
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })

    /***********************
     *  Componentes
     ***********************/

   // Obtenemos datos de la fila presionada y mostramos el modal
   $('#tabla-componentes tbody').on( 'click', 'td', function () {
        table = $('#tabla-componentes').DataTable()
        data = table.row( $(this).parents('tr') ).data()
    });

    // Obtiene el botón pulsado de los tres botones de arriba a mano derecha
    $('#componentesModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        componente = button.data('whatever') 
        var modal = $(this)
        modal.find('.modal-title').text('Administrar ' + componente)
    })

    $('#componentesModal').on('shown.bs.modal', function(e) {
        
        // Obtiene los datos de la tabla correspondiente según el botón presionado
        $('#tabla-componentes').DataTable({
            "ajax": {
                "type": "POST",
                "url": '../../controllers/MaterialController.php',
                "data": {'param1': 'getComponente', 'param2': componente}
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
                {"data": "id", visible: false},
                {"data": "nombre", className: "text-center"},
                {
                    data: null,
                    className: "center",
                    defaultContent: '<a type="button" class="btn btn-warning" data-toggle="modal" data-target="#editComponentesModal" data-toggle="tooltip" data-placement="top" title="Editar">' +
                        '<i class="fa fa-edit"></i></a> ' +
                        '<a type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarModal" data-toggle="tooltip" data-placement="top" title="Eliminar">' +
                        '<i class="fa fa-trash"></i></a>'
                }
            ]
        });
    })

    // Elimina la tabla principal en el modal componentes
    $('#componentesModal').on('hidden.bs.modal', function(e) {
        $('#tabla-componentes').DataTable().clear().destroy()
        // $('#tabla-componentes').DataTable().destroy();
    })
    
    // Prepara el texto al abrir el modal para editar o guardar un componente
    $('#editComponentesModal').on('show.bs.modal', function(e) {
        if (data == null)
        {
            $('#editComponentesModalLabel').text('Nuevo ' + componente.slice(0,-1))
            $('#btn-guardar-compoenente').text("Guardar")
        } else {
            $('#editComponentesModalLabel').text('Editar ' + data.nombre)
            $('#btn-guardar-compoenente').text("Actualizar")
            $('#input-nombre-componente').val(data.nombre)
        }
    })
    
    // Limpia el input al cerrar el modal para editar o guardar un componente
    $('#editComponentesModal').on('hidden.bs.modal', function(e) {
        data = null
        $('#input-nombre-componente').val("")
    })

    // Guarda o edita un nuevo registro
    $('#btn-guardar-componente').click(function(e) {
        e.preventDefault()

        var form = $("#frm-componentes");
        if (form[0].checkValidity() === false ) {
            e.stopPropagation()
            form.addClass('was-validated');
            $('.invalid-feedback').css('display', 'block');
        } else {
            let datos = [];
            datos = [{
                id:                 data == null ? "0" : data.id,
                nombre: 			$('#input-nombre-componente').val(),
            }]

            $.ajax({
                url: '../../controllers/MaterialController.php',
                type: 'post',
                data: {param1: data == null ? 'registrarComponente' : 'editarComponente', param2: componente, param3: datos},
                dataType: 'json',
            })
            .done(function(response) 
            {
                if(response.success == true)
                {
                    alert(response.msg)
                    $('#editComponentesModal').modal('hide')
                    $("#tabla-componentes").DataTable().ajax.reload();
                } else {
                    alert(response.mensaje)
                }
            })
            .fail(function(response) {
                console.log("error"+response)
            })
        }
    })


     //  Acción botón eliminar en modal de confirmación
     $('#btn-borrar').click(function(e){
        e.preventDefault()

        $.post( '../../controllers/MaterialController.php', {param1: $('#componentesModal').hasClass('show') ? "eliminar_componente" : "eliminar_material", param2: $('#componentesModal').hasClass('show') ? componente : data.id_material, param3: $('#componentesModal').hasClass('show') ? data.id : "0"}, function( response ) {
            if(response.success)
            {
                alert(response.mensaje)
                $('#eliminarModal').modal('hide')
                if ($('#componentesModal').hasClass('show'))
                {
                    $("#tabla-componentes").DataTable().ajax.reload();
                } else {
                    $('#editModal').modal('hide')
                    $("#tabla-materiales").DataTable().ajax.reload();
                }
            }
            else
            {
                alert(response['msg'])
            } 
        },'json');
    })

</script>

</body>

</html>