<?php
session_start();
if(!isset($_SESSION['no_control']))
{
    header('Location:../signin.php');
} else if($_SESSION['rol'] !== "1") {
    header('Location:./user/inicio.php');
}
// Obtenemos el nombre de la pagina para agregar el título
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistema de Gestion de Laboratorios">
  <meta name="author" content="Gonzalo Torres Segoviano">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/favicon.png">
  <title>SIGEL :. <?php
  
    switch ($curPageName) {
		case 'inicio.php':
			echo 'Inicio';
			break;
		case 'usuarios.php':
			echo 'Usuarios';
			break;
		case 'materiales.php':
			echo 'Materiales';
			break;
		case 'materiales_danados.php':
			echo 'Materiales Dañados';
			break;
		case 'inicio.php':
			echo 'Inicio';
			break;
      
     
    }
  
  ?></title>

  <!-- Custom fonts for this template-->
  <link href="../../vendor/components/font-awesome/css/all.min.css" rel="stylesheet">
  <link href="../../assets/css/nunito-font.css " rel="stylesheet">
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../../assets/css/main.css" rel="stylesheet">

  <!-- Custom datatables-->
  <link href="../../assets/css/jquery.dataTables.min.css" rel="stylesheet">

  <!-- Custom select2 -->
  <link href="../../vendor/select2/select2/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body id="page-top" class="d-flex flex-column h-100">

  <!-- Loading spinner -->
  <div id="overlay">
    <div class="cv-spinner">
      <span class="spinner"></span>
    </div>
  </div>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="../../assets/img/logo_1.png" class="corto" alt="Logo de ITESG">
            <img src="../../assets/img/logo-largo.png" class="largo" alt="Logo completo de ITESG">
        </div>
        <!-- <div class="sidebar-brand-text mx-3"></div> -->
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li <?= $curPageName === "inicio.php" ? 'class="nav-item active"' : 'class="nav-item"'?>>
        <a class="nav-link" href="./inicio.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Inicio</span></a>
      </li>

        <!-- Muestra los menús dependiendo del tipo de rol -->
        <?php 
        if ( $_SESSION['rol'] === "1" ) 
        {
            echo '
            <!-- Nav Item - Pages Collapse Menu -->';
             echo $curPageName === "usuarios.php" ? '<li class="nav-item active">' : '<li class="nav-item">';
              echo '<a class="nav-link" href="./usuarios.php">
                <i class="fas fa-fw fa-user"></i>
                <span>Usuarios</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Materiales
            </div>

            <!-- Nav Item - Opción Administrar  -->';
            echo $curPageName === "materiales.php" ? '<li class="nav-item active">' : '<li class="nav-item">';
                echo '<a class="nav-link" href="materiales.php">
                <i class="fas fa-fw fa-vials"></i>
                <span>Administrar</span></a>
            </li>

            <!-- Nav Item - Opción Dañados -->';
            echo $curPageName === "materiales_danados.php" ? '<li class="nav-item active">' : '<li class="nav-item">';
                echo '<a class="nav-link" href="materiales_danados.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Dañados</span></a>
            </li>

            <!-- Nav Item - Opción Reportes -->';
            echo $curPageName === "inicio.php" ? '<li class="nav-item active">' : '<li class="nav-item">';
                echo '<a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Reportes</span></a>
            </li>
            ';
        }
        ?>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Prestamos
        </div>

        
        <?php
            if($_SESSION['rol'] === "1")
            {
              echo '
                <!-- Nav Item - Opción Administrar -->';
                echo $curPageName === "inicio.php" ? '<li class="nav-item active">' : '<li class="nav-item">';
                    echo '<a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Administrar</span></a>
                </li>
                <!-- Nav Item - Opción Activos -->';
                echo $curPageName === "inicio.php" ? '<li class="nav-item active">' : '<li class="nav-item">';
                    echo '<a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Reportes</span></a>
                </li>
                ';
            } else {
              echo '
              <!-- Nav Item - Botón para solicitar material -->';
              echo $curPageName === "usuarios.php" ? '<li class="nav-item active">' : '<li class="nav-item">';
                echo '<a class="nav-link btn btn-outline-info" href="#" data-toggle="modal" data-target="#nuevaSolicitudModal">
                  <i class="fas fa-fw fa-plus text-info"></i>
                  <span class="text-info">Solicitar Material</span></a>
              </li>

              <!-- Nav Item - Botón para entregar material -->';
              echo $curPageName === "inicio.php" ? '<li class="nav-item active">' : '<li class="nav-item">';
                echo '<a class="nav-link btn btn-outline-secondary" href="#" data-toggle="modal" data-target="#nuevaSolicitudModal">
                  <i class="fas fa-fw fa-people-carry text-secondary"></i>
                  <span class="text-secondary">Entregar Material</span></a>
              </li>

                <!-- Nav Item - Opción Activos -->';
                echo $curPageName === "inicio.php" ? '<li class="nav-item active">' : '<li class="nav-item">';
                    echo '<a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-boxes"></i>
                    <span>Activos</span></a>
				</li>
				
                <!-- Nav Item - Opción Adeudos -->';
                echo $curPageName === "inicio.php" ? '<li class="nav-item active">' : '<li class="nav-item">';
                    echo '<a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-minus-circle"></i>
                    <span>Adeudos</span></a>
                </li>
                ';
            }
      ?> <!-- Termina la selección de datos si es administrador -->

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Nav Item - Opciones usuario -->
      <?=$curPageName === "inicio.php" ? '<li class="nav-item active">' : '<li class="nav-item">' ?>
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-cog"></i>
          <span>Configuración</span></a>
      </li>


      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <?php
			// Muestra un titulo en la barra superior
            if ( $curPageName == 'inicio.php' )
            {
			  echo '<h3>Inicio</h3>';
            } else if ( $curPageName == 'usuarios.php' ) {
              echo '<h3>Usuarios</h3>';
            }
            
          ?>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Alerts -->
            <!-- <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i> -->
                <!-- Counter - Alerts -->
              <!--  <span class="badge badge-danger badge-counter">3+</span>
              </a>
            </li> -->

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 "><?=$_SESSION['nombre']?></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesión
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->