<?php

require_once ('../models/Usuario.php');

//para ajax
switch ($_POST['param1'])
{
    case 'checkUser':
        $UsuarioController = new UsuarioController();
        $user = $UsuarioController->verifica_usuario();
        echo json_encode($user);
        break;
    case 'registerUser':
            $UsuarioController = new UsuarioController();
            $user = $UsuarioController->registrar_usuario();
            echo json_encode($user);
            break;


}

Class UsuarioController{
    
    function verifica_Usuario(){
        $Usuario = new Usuario();
        $resultado = $Usuario->get_usuario($_POST['param2'],$_POST['param3']);

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
        else{
            $datos = array();
            $datos["success"] = true;
            $datos ['id'] = $resultado['id'];
            $datos ['usuario'] = $resultado['nombreUsuario'];
            $datos ['nombre'] = $resultado['nombre'] . " " . $resultado['primerApellido'];
            $datos ['estatus'] = $resultado['estatus'];
            $datos ['rol_id'] = $resultado['rol'];
       
            session_start();
            $_SESSION['usuario']=$datos;
        }
        return $datos;
    }

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
            }
        } else {
            if($resultado === 0)
            {
                $info = array(
                    "success" => false,
                    "mensaje" => "sin datos ",
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


}
