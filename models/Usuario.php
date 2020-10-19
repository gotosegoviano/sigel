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

        function get_usuario($no_control, $password)
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
                        if(!$stmt->execute())
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

        
        function registrar_usuarios($datos)
        {
            try{
                $pass = strtolower(substr($datos[0]['nombre'],0,1).$datos[0]['apellido_paterno']);
                $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

                $sql = 'CALL save_usuario(:nombre, :apellido_paterno, :apellido_materno, :correo, :carrera, :grado, :grupo, :no_control, :contrasena, :rol)';
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':nombre',$datos[0]['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':apellido_paterno',$datos[0]['apellido_paterno'], PDO::PARAM_STR);
                $stmt->bindParam(':apellido_materno',$datos[0]['apellido_materno'], PDO::PARAM_STR);
                $stmt->bindParam(':correo',$datos[0]['correo'], PDO::PARAM_STR);
                $stmt->bindParam(':carrera',$datos[0]['carrera'], PDO::PARAM_STR);
                $stmt->bindParam(':grado',$datos[0]['grado'], PDO::PARAM_STR);
                $stmt->bindParam(':grupo',$datos[0]['grupo'], PDO::PARAM_STR);
                $stmt->bindParam(':no_control',$datos[0]['numero_control'], PDO::PARAM_STR);
                $stmt->bindParam(':contrasena',$pass_hash, PDO::PARAM_STR);
                $stmt->bindParam(':rol',$datos[0]['rol'], PDO::PARAM_STR);
                
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
    }

