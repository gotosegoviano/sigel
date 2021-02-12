<?php

require_once('../models/Material.php');

//para ajax
switch ($_POST['param1']) {
    case 'getMateriales':
        $MaterialesController = new MaterialController();
        $dano = $MaterialesController->obtenerMateriales();
        echo json_encode($dano);
        break;
    case 'get_datos_modal':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->obtenerDatosModal();
        echo json_encode($dano);
        break;
    case 'registrarMaterial':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->registraMaterial();
        echo json_encode($dano);
        break;
    case 'editarMaterial':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->editarMaterial();
        echo json_encode($dano);
        break;
    case 'eliminar_material':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->eliminaMaterial();
        echo json_encode($dano);
        break;
    case 'getComponente':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->obtenerComponente();
        echo json_encode($dano);
        break;
    case 'registrarComponente':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->registraComponente();
        echo json_encode($dano);
        break;
    case 'editarComponente':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->editarComponente();
        echo json_encode($dano);
        break;
    case 'eliminar_componente':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->eliminaComponente();
        echo json_encode($dano);
        break;
    case 'archivo_materiales':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->cargaArchivo();
        echo json_encode($dano);
        break;
    case 'codigo_barras':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->codigoBarras();
        echo json_encode($dano);
        break;
    case 'getDanos':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->obtenerDanos();
        echo json_encode($dano);
        break;
    case 'getMaterialSelect':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->obtenerMaterialesSelect();
        echo json_encode($dano);
        break;
    case 'nueva_evidencia':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->nuevaEvidencia();
        echo json_encode($dano);
        break;
    case 'nuevo_dano':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->registroDano(1);
        echo json_encode($dano);
        break;
    case 'edita_dano':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->registroDano(2);
        echo json_encode($dano);
        break;
    case 'obtener_evidencias':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->obtenEvidencias();
        echo json_encode($dano);
        break;
    case 'eliminar_evidencia':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->eliminarEvidencia();
        echo json_encode($dano);
        break;
    case 'borrar_tmps':
        $MaterialController = new MaterialController();
        $dano = $MaterialController->eliminarEvidenciasTmp();
        echo json_encode($dano);
        break;
}

class MaterialController
{

    /**
     * Obtiene la lista completa de los materiales
     *
     * @return array
     */
    public function obtenerMateriales(): array
    {
        $Material = new Material();
        $resultado = $Material->obtenMateriales();

        if ($resultado === 0) {
            $datos = array(
                "success" => false,
                "mensaje" => "sin datos"
            );
        } else {
            $datos = $resultado;
        }

        return $datos;
    }


    /**
     * Obtine la información completa de un usuario
     *
     * @return array
     */
    public function obtenerDatosModal(): array
    {
        $Material = new Material();
        $resultado = $Material->datosModal();

        if ($resultado === 0) {
            $datos = array(
                "success" => false,
                "msg" => "Sin datos"
            );
        } else {
            $datos = array(
                "success" => true,
                "msg" => $resultado
            );
        }

        return $datos;
    }

    /**
     * Registra un material nuevo
     *
     * @return array
     */
    public function registraMaterial(): array
    {
        $Material = new Material();
        $resultado = $Material->registraMaterial($_POST['param2']);

        if ($resultado === 0) {
            $datos = array(
                "success" => false,
                "msg" => "Hubo un error al guardar la información, intente de nuevo."
            );
        } else {
            $datos = array(
                "success" => true,
                "msg" => "El material ha sido guardado con exito"
            );
        }

        return $datos;
    }

    /**
     * Edita un material seleccionado
     *
     * @return array
     */
    public function editarMaterial(): array
    {
        $Material = new Material();
        $resultado = $Material->actualiza_material($_POST['param2']);

        if ($resultado === "0") {
            $datos = array(
                "success" => false,
                "msg" => "sin datos"
            );
        } else {
            $datos = array(
                "success" => true,
                "msg" => "El registro a ha sido modificado con exito."
            );
        }
        return $datos;
    }

     /**
     * Envia el id para su desactivado
     *
     * @return array
     */
    public function eliminaMaterial(): array
    {
        $Material = new Material();
        $resultado = $Material->eliminar_material($_POST['param2']);

        if ($resultado === "0") {
            $datos = array(
                "success" => false,
                "mensaje" => "sin datos"
            );
        } else {
            $datos = array(
                "success" => true,
                "mensaje" => "El material se ha eliminado con exito"
            );
        }

        return $datos;
    }

    /**
     * Envia el nombre del componente para obtener los datos
     *
     * @return array
     */
    public function obtenerComponente(): array
    {
        $Material = new Material();
        $resultado = $Material->obtenComponente($_POST['param2']);

        if ($resultado === "0") {
            $datos = array(
                "success" => false,
                "mensaje" => "sin datos"
            );
        } else {
            $datos = $resultado;
        }

        return $datos;
    }

    /**
     * Registra componente dependiendo del botón seleccionado
     *
     * @return array
     */
    public function registraComponente(): array
    {
        $Material = new Material();
        $resultado = $Material->registraComponente($_POST['param2'], $_POST['param3']);

        if ($resultado === 0) {
            $datos = array(
                "success" => false,
                "msg" => "Hubo un error al guardar la información, intente de nuevo."
            );
        } else {
            $datos = array(
                "success" => true,
                "msg" => "El registro ha sido guardado con exito"
            );
        }

        return $datos;
    }

    /**
     * Edita
     * @return array
     */
    public function editarComponente(): array
    {
        $Material = new Material();
        $resultado = $Material->actualizaComponente($_POST['param2'], $_POST['param3']);

        if ($resultado === "0") {
            $datos = array(
                "success" => false,
                "msg" => "sin datos"
            );
        } else {
            $datos = array(
                "success" => true,
                "msg" => "El registro a ha sido modificado con exito."
            );
        }
        return $datos;
    }

    /**
     * Envia el id para su desactivado
     *
     * @return array
     */
    public function eliminaComponente(): array
    {
        $Material = new Material();
        $resultado = $Material->eliminarComponente($_POST['param2'], $_POST['param3']);

        if ($resultado === "0") {
            $datos = array(
                "success" => false,
                "mensaje" => "sin datos"
            );
        } else {
            $datos = array(
                "success" => true,
                "mensaje" => "El registro se ha eliminado con exito"
            );
        }

        return $datos;
    }

    /**
     * Obtiene la información de un archivo para ingresarla a la bd
     *
     * @return int
     */
    public function cargaArchivo(): int
    {

        $Material = new Material();
        $resultado = $Material->cargarDatosArchivo($_FILES);

        if ($resultado === "0") {
            $datos = 0;
        } else {
            $datos = 1;
        }

        return $datos;
    }

    /**
     * Obtiene la información para rellenar la tabla daños
     *
     * @return array
     */
    public function obtenerDanos(): array
    {
        $Material = new Material();
        $resultado = $Material->obtenDanos();

        if ($resultado === "0") {
            $datos = array(
                "success" => false,
                "msg" => "Hubo un error al obtener los datos"
            );
        } else {
            $datos = $resultado;
        }

        return $datos;
    }

    /**
     * Obtiene los datos para mostrarlos en el select de materiales en la sección daños
     *
     * @return array
     */
    public function obtenerMaterialesSelect(): array
    {
        $Material = new Material();
        $resultado = $Material->obtenMaterialesSelect($_POST['palabra']);

        if ($resultado === "0") {
            $datos = array(
                "success" => false,
                "msg" => "Hubo un error al obtener los datos"
            );
        } else {
            $datos = $resultado;
        }

        return $datos;
    }

    /**
     *
     * @return array
     */
    public function nuevaEvidencia(): array
    {
        $Material = new Material();
        $resultado = $Material->nuevasEvidencias($_FILES);

        if ($resultado === -1) {
            $datos = array(
                "success" => false,
                "msg" => "No tiene los permisos para subir archivos"
            );
        } elseif ($resultado === -2) {
            $datos = array(
                "success" => false,
                "msg" => "La extensión no es válida, solo admite archivos en formato, png, jpg y jpeg"
            );
        } else {
                $datos = array(
                    "success" => true,
                    "direccion" => '../../assets/img/tmp/',
                    "msg" => $resultado
                );
        }

        return $datos;
    }

    /**
     * Prepara los datos para enviarlos en un array junto con las imágenes para su almacenamiento
     *
     * @return array
     */
    public function registroDano(int $accion): array
    {
        $Material = new Material();
        $resultado = $Material->registrarDano($accion, $_POST['param2'], $_POST['param3']);

        if ($resultado === "0") {
            $datos = array(
                "success" => false,
                "msg" => "Hubo un error al guardar los datos"
            );
        } elseif ($resultado === "-1") {
            $datos = array(
                "success" => false,
                "msg" => "No tiene los permisos para subir archivos"
            );
        } elseif ($resultado === "-2") {
            $datos = array(
                "success" => false,
                "msg" => "La extensión no es válida, solo admite archivos en formato, png, jpg y jpeg"
            );
        } else {
                $datos = array(
                "success" => true,
                "msg" => "Los datos han sido guardado con exito"
                );
        }

        return $datos;
    }

    /**
     * Obtiene las evidencias para mostrarlas en el modal
     * @return array
     */
    public function obtenEvidencias(): array
    {

        $Material = new Material();
        $resultado = $Material->obtener_evidencias($_POST['param2']);


        if ($resultado === "0") {
            $datos = array(
                "success" => false,
                "msg" => "Hubo un error al guardar los datos"
            );
        } else {
                $datos = array(
                "success" => true,
                "direccion" => "../../assets/img/Evidencias/",
                "evidencia" => $resultado
                );
        }

        return $datos;
    }

    /**
     * Manda los datos para la eliminación de la evidencia
     *
     * @return array
     */
    public function eliminarEvidencia(): array
    {

        $Material = new Material();
        $resultado = $Material->eliminaEvidencia($_POST['param2']);

        if ($resultado === "0") {
            $datos = array(
                "success" => false,
                "msg" => "Hubo un error al eliminar la evidencia"
            );
        } else {
                $datos = array(
                "success" => true
                );
        }

        return $datos;
    }

    /**
     * Elimina las evidencias temporales de la carpeta tmp en assets/img
     * @return array
     */
    public function eliminarEvidenciasTmp(): array
    {
        $Material = new Material();
        $resultado = $Material->eliminaEvidenciaTmp($_POST['param2']);

        if ($resultado === "0") {
            $datos = array(
                "success" => false,
                "msg" => "Hubo un error al eliminar la evidencia"
            );
        } else {
            $datos = array(
                "success" => true,
                "msg" => "1"
            );
        }

        return $datos;
    }
}
