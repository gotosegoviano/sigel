<?php

require_once ('../models/Usuario.php');

//para ajax
switch ($_POST['param1'])
{
    case 'revisaUsuario':
        $UsuarioController = new UsuarioController();
        $user = $UsuarioController->verifica_usuario();
        echo json_encode($user);
        break;
    case 'registrarUsuario':
            $UsuarioController = new UsuarioController();
            $user = $UsuarioController->registrar_usuario();
            echo json_encode($user);
            break;
    case 'getUsers':
            $UsuarioController = new UsuarioController();
            $user = $UsuarioController->obtener_usuarios();
            echo json_encode($user);
            break;
    case 'get_usuario':
            $UsuarioController = new UsuarioController();
            $user = $UsuarioController->obten_usuario();
            echo json_encode($user);
            break;
    case 'editarUsuario':
            $UsuarioController = new UsuarioController();
            $user = $UsuarioController->editar_usuario();
            echo json_encode($user);
            break;
    case 'reiniciar_contrasena':
            $UsuarioController = new UsuarioController();
            $user = $UsuarioController->reinicia_contrasena();
            echo json_encode($user);
            break;
    case 'eliminar_usuario':
            $UsuarioController = new UsuarioController();
            $user = $UsuarioController->elimina_usuario();
            echo json_encode($user);
            break;
    case 'getUsuarioSelect':
            $UsuarioController = new UsuarioController();
            $user = $UsuarioController->obtener_usuarios_select();
            echo json_encode($user);
            break;


}

Class UsuarioController{
    
    /**
     * Obtiene los datos del usuario si es correcta su contraseña
     *
     * @return $datos -> dirección de página inicio
     */
    function verifica_Usuario(){
        $Usuario = new Usuario();
        $resultado = $Usuario->obten_usuario($_POST['param2'],$_POST['param3']);

        if ($resultado === 0)
        {
            $datos = array(
                "success" => false,
                "mensaje" => "El usuario no está registrado"
            );
        }
        else if($resultado === 1)
        {
            $datos = array(
                "success" => false,
                "mensaje" => "El usuario o contraseña no son correctos. Intentelo de nuevo."
            );

        }
        else if($resultado === -1)
        {
            $datos = array(
                "success" => false,
                "mensaje" => "Hubo un problema desconocido. Contacte al administrador"
            );
        }
        else{
            
            session_start();
            $_SESSION['no_control'] = $resultado['numero_control'];
            $_SESSION['nombre'] = $resultado['nombre'];
            // $datos ['prestamos'] = $resultado['prestamos'];
            $_SESSION['rol'] = $resultado['id_rol'];

            $datos = array();
            $datos["datos"] = $resultado;
            $datos["success"] = true;
            if ($resultado['id_rol'] == 1 )
            {
                $datos['dir'] = "admin";
            } else {
                $datos['dir'] = "user";
            }
       
        }
        return $datos;
    }

    /**
     * Manda la información del usuario para ser guardada en la bd
     *
     * @return void
     */
    function registrar_usuario()
    {
        $Usuario = new Usuario();
        $resultado = $Usuario->registrar_usuarios($_POST['param2']);

        if(is_array($resultado))
        {
            if($resultado[1] === "23000")
            {
                $info = array (
                    'success' => false,
                    'error' => 1,
                    'msg' => "El usuario ya está registrado",
                );
            } else {
                $info = $resultado;
            }
        } else {
            if($resultado === 0)
            {
                $info = array(
                    "success" => false,
                    "mensaje" => "Hubo un error al guardar la información. Contacte al admonistrador ",
                );
            }
            else {
                $info = array (
                    'success' => true,
                    'msg' => $resultado,
                );
            } 
        }

        return $info;
    }

    /**
     * Obtiene la lista completa de los usuarios
     *
     * @return void
     */
    function obtener_usuarios()
    {
        $Usuario = new Usuario();
        $resultado = $Usuario->obten_usuarios();

       if ($resultado === 0)
       {
            $datos = array(
                "success" => false,
                "mensaje" => "sin datos"
            );
        }
        else{
            $datos = $resultado;
        }

        return $datos;
    }


    /**
     * Obtine la información completa de un usuario
     *
     * @return void
     */
    function obten_usuario()
    {
        $Usuario = new Usuario();
        $resultado = $Usuario->obtener_usuario($_POST['param2']);

        if($resultado === 0)
        {
            $datos = array(
                "success" => false,
                "mensaje" => "Sin datos"
            );
        } else{ 
            $datos = $resultado;
        }

        return $datos;
    }

    /**
     * Edita un usaurio seleccionado
     *
     * @return void
     */
    function editar_usuario()
    {
        $Usuario = new Usuario();
        $resultado = $Usuario->actualiza_usuario($_POST['param2']);

        if ($resultado === "0")
            $datos = array(
                "success" => false,
                "mensaje" => "sin datos"
            );
        else{
            if($resultado === "")
            {
                $datos = array(
                    "success" => true,
                    "mensaje" => "El usuario a ha sido modificado con exito."
                );
            } else {
                $datos = array(
                    "success" => true,
                    "mensaje" => "El usuario a ha sido modificado con exito. La contraseña es: " . $resultado
                );

            }
        }
        return $datos;
    }

    /**
     * Envia el id del usuario para reiniciar la contraseña
     *
     * @return void
     */
    function reinicia_contrasena()
    {
        $Usuario = new Usuario();
        $resultado = $Usuario->contrasena_default($_POST['param2']);

        if ($resultado === "0")
            $datos = array(
                "success" => false,
                "mensaje" => "sin datos"
            );
        else{
            $datos = array(
                "success" => true,
                "mensaje" => "La contraseña se ha restaurado con éxito. La contraseña es: " . $resultado
            );
        }

        return $datos;

    }

    /**
     * Envia el id para su desactivado
     *
     * @return void
     */
    function elimina_usuario()
    {
        $Usuario = new Usuario();
        $resultado = $Usuario->eliminar_usuario($_POST['param2']);

        if ($resultado === "0")
            $datos = array(
                "success" => false,
                "mensaje" => "sin datos"
            );
        else{
            $datos = array(
                "success" => true,
                "mensaje" => "El usuario se ha elimina con exito"
            );
        }

        return $datos;

    }

    /**
     * Obtiene los datos para rellenar el select responsable en danos materiales
     *
     * @return void
     */
    function obtener_usuarios_select()
    {
        $Usuario = new Usuario();
        $resultado = $Usuario->obten_usuarios_select($_POST['palabra']);

        if ($resultado === "0"){
            $datos = array(
                "success" => false,
                "msg" => "Hubo un error al obtener los datos"
            );
        }
        else{
            $datos = $resultado;
        }

        return $datos;
    }


}
