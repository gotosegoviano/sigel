<?php

    require_once('ConexionPDO.php');
    include '../vendor/autoload.php';
    include "src/BarcodeGenerator.php";
    include "src/BarcodeGeneratorHTML.php";

class Material
{
    private $direccion_imagenes = "../assets/img/Evidencias/";
    private $direccion_tmp = "../assets/img/tmp/";
    private $valid_ext = array("png","jpeg","jpg");

    private $conexion;

    public function __construct()
    {
        $Conexion =  new ConexionPDO();
        $this->conexion = $Conexion->openConnection();
    }

    /**
     * Retorna una lista de todos los materiales con su información completa
     *
     * @return array
     */
    public function obtenMateriales()
    {
        try {
            $sql = "CALL obtener_materiales()";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $materialesData['data'][] = $row;
                }

                return $materialesData;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            $error = array();
            $error[0] = -1;
            $error[1] = $e->getCode();
            return $error;
        }
    }

    /**
     * Retorna la información para los selects para el modal de materiales
     *  tipo de materiales, marcas y categorias
     *
     * @return array
     */
    function datosModal()
    {
        try {
            $sql = "CALL obtener_tipos()";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $materialesData['tipo'][] = $row;
                }
            } else {
                return 0;
            }
            $sql = "CALL obtener_marcas()";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $materialesData['marca'][] = $row;
                }
            } else {
                return 0;
            }
            $sql = "CALL obtener_categorias()";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $materialesData['cat'][] = $row;
                }

                return $materialesData;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            $error = array();
            $error[0] = -1;
            $error[1] = $e->getCode();
            return $error;
        }
    }

    /**
     * Registra el nuevo material en la base de datos
     *
     * @param [array] $datos
     * @return void
     */
    function registraMaterial($datos)
    {
        try {
            $sql = 'CALL registrar_material(:nombre, :cantidad, :descripcion, :tipo, :marca, :categoria)';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $datos[0]['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $datos[0]['cantidad'], PDO::PARAM_INT);
            $stmt->bindParam(':descripcion', $datos[0]['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $datos[0]['tipo'], PDO::PARAM_INT);
            $stmt->bindParam(':marca', $datos[0]['marca'], PDO::PARAM_INT);
            $stmt->bindParam(':categoria', $datos[0]['categoria'], PDO::PARAM_INT);

            if (!$stmt->execute()) {
                return 0 ;
            } else {
                return 1;
            }
        } catch (PDOException $e) {
            $error = array();
            $error[0] = -1;
            $error[1] = $e->getCode();
            return $error;
        }
    }

    /**
     * Actualiza la información del material
     *
     * @param [array] $datos
     * @return void
     */
    function actualizaMaterial($datos)
    {
        try {
            $sql = 'CALL editar_material(:id, :nombre, :cantidad, :descripcion, :tipo, :marca, :categoria)';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $datos[0]['id'], PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $datos[0]['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $datos[0]['cantidad'], PDO::PARAM_INT);
            $stmt->bindParam(':descripcion', $datos[0]['descripcion'], PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $datos[0]['tipo'], PDO::PARAM_INT);
            $stmt->bindParam(':marca', $datos[0]['marca'], PDO::PARAM_INT);
            $stmt->bindParam(':categoria', $datos[0]['categoria'], PDO::PARAM_INT);

            if (!$stmt->execute()) {
                return 0 ;
            } else {
                return 1;
            }
        } catch (PDOException $e) {
            $error = array();
            $error[0] = -1;
            $error[1] = $e->getCode();
            return $error;
        }
    }

    /**
     * Manda el id del material para cambiar el estatus de activo a descativado
     *
     * @param [type] $id
     * @return void
     */
    function eliminarMaterial($id)
    {
        try {
            $sql = 'CALL elimina_material(:id)';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if (!$stmt->execute()) {
                return 0 ;
            } else {
                return 1;
            }
        } catch (PDOException $e) {
            $error = array();
            $error[0] = -1;
            $error[1] = $e->getCode();
            return $error;
        }
    }

    /**
     * Obtiene la información del componente seleccionado para mostrar en la tabla principal del modal componente
     *  componentes -> Tipo, Marca, Categoria
     *
     * @param [type] $componente
     * @return void
     */
    function obtenComponente($componente)
    {
        try {
            $sql = 'CALL get_' . $componente . '()';
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $materialesData['data'][] = $row;
                }

                return $materialesData;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            $error = array();
            $error[0] = -1;
            $error[1] = $e->getCode();
            return $error;
        }
    }

    /**
     * Guarda la información del componente en la bd dependiendo del botón seleccionado
     *  Componentes -> Tipo, Marca, Categoria
     *
     * @param [string] $componente
     * @param [array] $datos
     * @return void
     */
    function registraComponente($componente, $datos)
    {
        try {
            if ($componente == "Tipos") {
                $nombre = ucwords(strtolower($datos[0]['nombre']));
            } else {
                $nombre = strtoupper($datos[0]['nombre']);
            }
            $sql = 'CALL registrar_' . $componente . '(:nombre)';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return 0 ;
            } else {
                return 1;
            }
        } catch (PDOException $e) {
            $error = array();
            $error[0] = -1;
            $error[1] = $e->getCode();
            return $error;
        }
    }

    /**
     * Actualiza el componente según el botón seleccionado
     * Componentes -> Tipo, Marca, Categoria
     *
     * @param [string] $componente
     * @param [array] $datos
     * @return void
     */
    function actualizaComponente($componente, $datos)
    {
        try {
            if ($componente == "Tipos") {
                $nombre = ucwords(strtolower($datos[0]['nombre']));
            } else {
                $nombre = strtoupper($datos[0]['nombre']);
            }
            $sql = 'CALL editar_' . $componente . '(:id, :nombre)';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $datos[0]['id'], PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return 0 ;
            } else {
                return 1;
            }
        } catch (PDOException $e) {
            $error = array();
            $error[0] = -1;
            $error[1] = $e->getCode();
            return $error;
        }
    }

    /**
     * Manda el id del componente para cambiar el estatus de activo a descativado
     *
     * @param [type] $id
     * @return void
     */
    function eliminarComponente($componente, $id)
    {
        try {
            $sql = 'CALL elimina_' . $componente . '(:id)';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if (!$stmt->execute()) {
                return 0 ;
            } else {
                return 1;
            }
        } catch (PDOException $e) {
            $error = array();
            $error[0] = -1;
            $error[1] = $e->getCode();
            return $error;
        }
    }

    /**
     * Sube un archivo al servidor en formato xls, csv, o xlsx para obtener la información e insertarla en la tabla materiales en la bd
     *
     * @param [type] $file
     * @return int
     */
    function cargarDatosArchivo($file)
    {
        if ($file["file"]["name"] != '') {
            $allowed_extension = array('xls', 'csv', 'xlsx');
            $file_array = explode(".", $file["file"]["name"]);
            $file_extension = end($file_array);

            if (in_array($file_extension, $allowed_extension)) {
                $file_name = "tmp_material" . '.' . $file_extension;
                move_uploaded_file($file['file']['tmp_name'], $file_name);
                $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

                $spreadsheet = $reader->load($file_name);
                unlink($file_name);

                $data = $spreadsheet->getActiveSheet()->toArray();
                foreach ($data as $key => $row) {
                    if ($key < 1) {
                        continue;
                    }

                    try {
                        $nombre = ucwords(strtolower($row[1]));
                        $sql = 'CALL registrar_Tipos(:nombre)';
                        $stmt = $this->conexion->prepare($sql);
                        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                        if (!$stmt->execute()) {
                            return 0 ;
                        }

                        $nombre = strtoupper($row[4]);
                        $sql = 'CALL registrar_Marcas(:nombre)';
                        $stmt = $this->conexion->prepare($sql);
                        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                        if (!$stmt->execute()) {
                            return 0 ;
                        }

                        $nombre = strtoupper($row[5]);
                        $sql = 'CALL registrar_Categorias(:nombre)';
                        $stmt = $this->conexion->prepare($sql);
                        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                        if (!$stmt->execute()) {
                            return 0 ;
                        }

                        $sql = 'CALL registrar_material_archivo(:nombre, :cantidad, :descripcion, :tipo, :marca, :categoria)';
                        $stmt = $this->conexion->prepare($sql);
                        $stmt->bindParam(':nombre', $row[0], PDO::PARAM_STR);
                        $stmt->bindParam(':cantidad', $row[3], PDO::PARAM_INT);
                        $stmt->bindParam(':descripcion', $row[2], PDO::PARAM_STR);
                        $stmt->bindParam(':tipo', $row[1], PDO::PARAM_STR);
                        $stmt->bindParam(':marca', $row[4], PDO::PARAM_STR);
                        $stmt->bindParam(':categoria', $row[5], PDO::PARAM_STR);
                        if (!$stmt->execute()) {
                            return 0 ;
                        }
                    } catch (PDOException $e) {
                        $error = array();
                        $error[0] = -1;
                        $error[1] = $e->getCode();
                        if ($error[1] == "22007") {
                            continue;
                        } else {
                            return $error;
                        }
                    }
                }
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    /**
     * Obtiene los datos de la tabla materiales_danos y los prepara para mostrarlas en la tabla
     *
     * @return array
     */
    function obtenDanos()
    {
        try {
            $sql = "CALL obtener_danos()";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $materialesData['data'][] = $row;
                }

                return $materialesData;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
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
    function obtenMaterialesSelect($palabra)
    {
        try {
            $sql = "CALL obtener_material_busqueda(:palabra)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':palabra', $palabra, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $materialesData[] = ['id' => $row['id_material'], 'text' => $row['nombre']];
                }

                return $materialesData;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            $error = array();
            $error[0] = -1;
            $error[1] = $e->getCode();
            return $error;
        }
    }

    /**
     * Sube las imagenes a la carpeta tmp que está en assest/img para después copiarlos
     * a evidencias si se guarda el registro y eliminarlas o se eliminan si se cancela el registro.
     * Regresa los nombres de los archivso que son la fecha y hora en el que se subieron
     *
     * @param [file] $files
     * @return array $nombres
     */
    public function nuevasEvidencias($files)
    {
        $nombres = array();

        $cantidad_archivos = count($files['files']['name']);
        $nombre_tmp = date("Y_m_d_H_i_s");
        for ($index = 0; $index < $cantidad_archivos; $index++) {
            $filename = $files['files']['name'][$index];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $valid_ext = array("png","jpeg","jpg");
            if (in_array($ext, $valid_ext)) {
                $nombre_tmp .= "_" . $index . "." . $ext;
                $path = $this->direccion_tmp . $nombre_tmp;
                if (move_uploaded_file($files['files']['tmp_name'][$index], $path)) {
                    array_push($nombres, $nombre_tmp);
                } else {
                    return -1;
                }
            } else {
                return -2;
            }
        }
        return $nombres;
    }

    /**
     * Remueve las imágenes temporales
     * @param $files
     * @return int
     */
    public function eliminaEvidenciaTmp($files)
    {
        foreach ($files as $file) {
            if (!unlink($this->direccion_tmp . $file)) {
                return 0;
            }
        }

        return 1;
    }

    /**
     * Guarda un nuevo registro de daños y después sube los archivos de evidencia actualizando
     * el registro con el nombre de los archivos
     *
     * @param object $datos
     * @return int
     */
    public function registrarDano($accion, $datos, $evidencia): int
    {
        try {
            if ($accion === 1) {
                $sql = "CALL registrar_dano(:material, :usuario, :cantidad, :fecha)";
                $stmt = $this->conexion->prepare($sql);
            } else {
                $sql = "CALL editar_dano(:id, :material, :usuario, :cantidad, :fecha)";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':id', $datos['id'], PDO::PARAM_INT);
            }
            $stmt->bindParam(':material', $datos['material'], PDO::PARAM_INT);
            $stmt->bindParam(':usuario', $datos['usuario'], PDO::PARAM_INT);
            $stmt->bindParam(':cantidad', $datos['cantidad'], PDO::PARAM_INT);
            $stmt->bindParam(':fecha', $datos['fecha']);
            if ($accion === 1) {
                $stmt->execute();
                if ($stmt->rowCount() < 1) {
                    return 0;
                }

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $id_ingreso = $row['id'];
            } else {
                if (!$stmt->execute()) {
                    return 0;
                }
                $id_ingreso = $datos['id'] ;
            }
        } catch (PDOException $e) {
//            $error = array();
            $error = -1;
//            $error[1] = $e->getCode();
            return $error;
        }

        foreach ($evidencia as $index => $file) {
            $ext = pathinfo($file)['extension'];
            if (in_array($ext, $this->valid_ext)) {
                $filename = "Evidencia" . $id_ingreso . "_" . ($index + 1) . "." . $ext;
                rename($this->direccion_tmp . $file, $this->direccion_imagenes . $filename);
            } else {
                return -2;
            }
            $sql = "CALL agregar_evidencia(:id, :nombre)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id_ingreso, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $filename);
            if (!$stmt->execute()) {
                return 0;
            }
        }
        return 1;
    }

    /**
     * Obtiene la dirección de las evidencias de un daño especifico
     *
     * @param [int] $id
     * @return string
     */
    function obtener_evidencias($id)
    {
        try {
            $sql = "CALL obtener_evidencia(:id)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $evidencias = explode(",", $row['evidencia'], -1);
                return $evidencias;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            $error = array();
            $error[0] = -1;
            $error[1] = $e->getCode();
            return $error;
        }
    }

    /**
     * Elimina la imagen de evidencia en el servidor y el registro en la base de datos
     *
     * @param [object] $datos
     * @return void
     */
    public function eliminaEvidencia($datos)
    {
        if (!unlink($this->direccion_imagenes . $datos[0]['evidencia'])) {
            return 0;
        }

        $datos[0]['evidencia'] = $datos[0]['evidencia'] . ",";
        try {
            $sql = "CALL eliminar_evidencia(:id,:evidencia)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $datos[0]['id'], PDO::PARAM_INT);
            $stmt->bindParam(':evidencia', $datos[0]['evidencia'], PDO::PARAM_STR);
            if ($stmt->execute()) {
                return 1;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            $error = array();
            $error[0] = -1;
            $error[1] = $e->getCode();
            return $error;
        }
    }
}
