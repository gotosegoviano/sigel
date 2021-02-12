<?php

    require_once('ConexionPDO.php');

    class Usuario{
        private $id;
        private $usuario;
        private $contrasena;
        private $estatus;
        private $idRol;

        private $conexion;

        function __construct() {
            $Conexion =  new ConexionPDO();
            $this->conexion = $Conexion->openConnection();
        }

        /**
         * Obtiene la información del usuario y comprueba su usuario y contraseña
         *
         * @param [string] $no_control
         * @param [string] $password
         * @return void
         */
        function obten_usuario($no_control, $password)
        {
            try{
                $sql = "CALL get_usuario(:no_control)";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':no_control',$no_control);
                $stmt->execute();
                if($stmt->rowCount() > 0){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if(password_verify($password,$row['contrasena']))
                    {
                        $sql = "CALL get_info_usuario(:no_control)";
                        $stmt = $this->conexion->prepare($sql);
                        $stmt->bindParam(':no_control',$no_control);
                        if($stmt->execute())
                        {
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            return $row;
                        } else {
                            return -1;
                        }
                    }
                    else
                    {
                        return 1;
                    }
                }else{
                    return 0;
                }
            }catch (PDOException $e){
                $error = array();
                $error[0] = -1;
                $error[1] = $e->getCode();
                return $error;
            }
        }

        /**
         * Registra el usuario generando una contraseña con el primer caracter de su primer nombre y su apelldio paterno.
         *
         * @param [array] $datos
         * @return void
         */
        function registrar_usuarios($datos)
        {
            try{
                $pass = strtolower(substr($datos[0]['nombre'],0,1). str_replace(' ', '', $datos[0]['apellido_paterno']));
                $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

                $sql = 'CALL save_usuario(:nombre, :apellido_paterno, :apellido_materno, :correo, :carrera, :grado, :grupo, :no_control, :contrasena, :rol)';
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':nombre',$datos[0]['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':apellido_paterno',$datos[0]['apellido_paterno'], PDO::PARAM_STR);
                $stmt->bindParam(':apellido_materno',$datos[0]['apellido_materno'], PDO::PARAM_STR);
                $stmt->bindParam(':correo',$datos[0]['correo'], PDO::PARAM_STR);
                $stmt->bindParam(':carrera',$datos[0]['carrera'], PDO::PARAM_INT);
                $stmt->bindParam(':grado',$datos[0]['grado'], PDO::PARAM_STR);
                $stmt->bindParam(':grupo',$datos[0]['grupo'], PDO::PARAM_STR);
                $stmt->bindParam(':no_control',$datos[0]['numero_control'], PDO::PARAM_STR);
                $stmt->bindParam(':contrasena',$pass_hash, PDO::PARAM_STR);
                $stmt->bindParam(':rol',$datos[0]['rol'], PDO::PARAM_INT);
                
                if(!$stmt->execute())
                {
                    return 0;
                } else 
                {
                    return $pass;
                }
            }catch (PDOException $e){
                $error = array();
                $error[0] = -1;
                $error[1] = $e->getCode();
                return $error;
            }
        }

        /**
         * Retorna una lista de todos los usuarios con su información completa
         *
         * @return $userData
         */
        function obten_usuarios()
        {
            try {
                $sql = "CALL obtener_usuarios()";
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute();
                if($stmt->rowCount() > 0)
                {
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                        $userData['data'][] = $row;
                    }

                    return $userData;
                }else{
                    return 0;
                }

            }catch (PDOException $e) {
                $error = array();
                $error[0] = -1;
                $error[1] = $e->getCode();
                return $error;
            }
        }

        /**
         * Retorna la información completa de un usuario
         *
         * @return $userData
         */
        function obtener_usuario($id)
        {
            try {
                $sql = "CALL obtener_usuario(:id)";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id',$id, PDO::PARAM_INT);
                $stmt->execute();
                if($stmt->rowCount() > 0)
                {
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                        $userData[] = $row;
                    }

                    return $userData;
                }else{
                    return 0;
                }

            }catch (PDOException $e) {
                $error = array();
                $error[0] = -1;
                $error[1] = $e->getCode();
                return $error;
            }
        }

        /**
         * Actualiza la información del usuario, si la contraseña es 1 se modifica si no se queda igual
         *
         * @param [array] $datos
         * @return void
         */
        function actualiza_usuario($datos)
        {
            try {
                $sql = 'CALL editar_usuario(:id, :nombre, :apellido_paterno, :apellido_materno, :correo, :carrera, :grado, :grupo, :no_control, :rol)';
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id',$datos[0]['id'], PDO::PARAM_INT);
                $stmt->bindParam(':nombre',$datos[0]['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':apellido_paterno',$datos[0]['apellido_paterno'], PDO::PARAM_STR);
                $stmt->bindParam(':apellido_materno',$datos[0]['apellido_materno'], PDO::PARAM_STR);
                $stmt->bindParam(':correo',$datos[0]['correo'], PDO::PARAM_STR);
                $stmt->bindParam(':carrera',$datos[0]['carrera'], PDO::PARAM_INT);
                $stmt->bindParam(':grado',$datos[0]['grado'], PDO::PARAM_STR);
                $stmt->bindParam(':grupo',$datos[0]['grupo'], PDO::PARAM_STR);
                $stmt->bindParam(':no_control',$datos[0]['numero_control'], PDO::PARAM_STR);
                $stmt->bindParam(':rol',$datos[0]['rol'], PDO::PARAM_INT);
                
                if(!$stmt->execute())
                {
                    return 0 ;
                } else 
                {
                    return $pass;
                }
            } catch(PDOException $e)
            {
                $error = array();
                $error[0] = -1;
                $error[1] = $e->getCode();
                return $error;
            }

        }

        /**
         * Genera la nueva contraseña con los datos de usuario, la guarda en la bd y regresa la contraseña para mostrarla
         *
         * @param [int] $id
         * @return void
         */
        function contrasena_default($id)
        {
            try{
                $sql = 'CALL obten_datos_contrasena(:id)';
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id',$id, PDO::PARAM_INT);
                $stmt->execute();
                if($stmt->rowCount() > 0){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                } else {
                    return -1;
                }

                $pass = strtolower(substr($row['nombre'],0,1). str_replace(' ', '', $row['apellido_paterno']));
                $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = 'CALL reinicia_contrasena(:id, :contrasena)';
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id',$id, PDO::PARAM_INT);
                $stmt->bindParam(':contrasena',$pass_hash, PDO::PARAM_STR);
                
                if(!$stmt->execute())
                {
                    return 0 ;
                } else 
                {
                    return $pass;
                }
            }catch (PDOException $e){
                $error = array();
                $error[0] = -1;
                $error[1] = $e->getCode();
                return $error;
            }
        }

        /**
         * Manda el id del usuario para cambiar el estatus de activo a descativado
         *
         * @param [type] $id
         * @return void
         */
        function eliminar_usuario($id)
        {
            try{
                $sql = 'CALL elimina_usuario(:id)';
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id',$id, PDO::PARAM_INT);
                
                if(!$stmt->execute())
                {
                    return 0 ;
                } else 
                {
                    return 1;
                }
            }catch(PDOException $e) {
                $error = array();
                $error[0] = -1;
                $error[1] = $e->getCode();
                return $error;
            }
        }


        /**
         * Obtiene la información de la bd según lo ingresado en la busqueda
         *
         * @param string $palabra
         * @return void
         */
        function obten_usuarios_select($palabra)
        {
            try {
                $sql = "CALL obtener_usuario_busqueda(:palabra)";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':palabra',$palabra, PDO::PARAM_STR);
                $stmt->execute();
                if($stmt->rowCount() > 0)
                {
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                        $userData[] = ['id' => $row['id_usuario'], 'text' => $row['nombre']];
                    }

                    return $userData;
                }else{
                    return 0;
                }

            }catch (PDOException $e) {
                $error = array();
                $error[0] = -1;
                $error[1] = $e->getCode();
                return $error;
            }
        }


    }

