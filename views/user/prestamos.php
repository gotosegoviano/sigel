<?php

include("./encabezado_render.php");

?>
<!-- Contenido -->
<div class="row px-3 mb-5">
    <div class="col-md-12 text-center">
        <button class="btn btn-primary btn-lg">Solicitar Material</button>
    </div>
</div>
<div class="row px-3">
    <div class="col-md-12">
        <h2>Últimos Materiales Solicitados</h2>
    </div>
    <div class="col-md-12">
        <table class="table table-striped table-hover" id="table-material-prestamo">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Material</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Acción</th> <!-- Solicitar más, entregar -->
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!-- fin contenido -->

<?php
include("./footer_render.php");
?>

<script >

</script>

</body>

</html>