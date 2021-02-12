<!-- Footer -->
<!-- <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center">
             <span>Realizado por Gonzalo Torres Segoviano</span> 
          </div>
        </div>
      </footer> -->
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Nueva Solicitud Modal -->
<div class="modal fade" id="nuevaSolicitudModal" tabindex="-1" aria-labelledby="nuevaSolicitudModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nuevaSolicitudModalLabel">Solicitar Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn-solicitar-material">Solicitar</button>
      </div>
    </div>
  </div>
</div>

  <!-- Cerrar Sesión Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Está seguro que quiere cerrar la sesión</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Si deja algún cambio sin guardar se borrará y tendrá que iniciar de nuevo su solicitud.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="../salir.php">Salir</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../../assets/js/jquery-3.5.1.js"></script>
<!--	<script src="../assets/js/popper.min.js"></script>-->
	<script src="../../assets/js/bootstrap.min.js"></script>

  <!-- Core plugin Datatables -->
  <script src="../../assets/js/jquery.dataTables.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../assets/js/sb-admin-2.min.js"></script>

  <!-- CodeBar Generetor -->
  <script src="../../assets/js/JsBarcode.all.min.js"></script>

  <!-- picEyes Modal view Generator -->
  <script src="../../assets/js/jquery.picEyes.js"></script>

  <!-- SELECT2 custom -->
  <script src="../../vendor/select2/select2/dist/js/select2.min.js"></script>

<script defer>
    $(document).ajaxStart(function(){
        // Show image container
        $("#overlay").show();
    }).ajaxComplete(function(){
        // Hide image container
        $("#overlay").hide();
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

</script>