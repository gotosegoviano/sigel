<?php

include("../encabezado_render.php");

?>
<!-- Contenido -->
<div class="row px-5">
    <div class="col-md-12 mx-auto">
        <div class="d-flex bd-highlight">
            <h3>Pedidos activos</h3>
        </div>
        <table class="table table-striped table-hover" id="table-material-prestamo">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Cantidad de Materiales</th>
                    <th scope="col">Acciones</th> <!-- Entregar, agregar -->
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 mx-auto mt-5 border-top">
        <div class="d-flex bd-highlight mt-4">
            <h3>Pedidos con adeudos</h3>
        </div>
        <table class="table table-striped table-hover" id="table-material-prestamo">
            <thead>
                <tr>
                    <th scope="col">Material</th>
                    <th scope="col">Cantidad</th>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php
include("../footer_render.php");
?>

<script >

</script>

</body>

</html>