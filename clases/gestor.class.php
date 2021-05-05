<?php
    require_once 'conexion.php';

    class Gestor extends Conexion{
        public function agregarRegistroArchivo($datos) {
            $conexion = Conexion::conectar();
            $sql = 'INSERT INTO t_archivos (id_usuario, id_categoria, nombre, tipo, ruta) VALUES (?, ?, ?, ?, ?)';
            $query = $conexion->prepare($sql);
            $query->bind_param("iisss", $datos['idUsuario'], $datos['idCategoria'], $datos['nombreArchivo'], $datos['tipo'], $datos['ruta']);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }

        public function obtenNombreArchivo($idArchivo) {
            $conexion = Conexion::conectar();
            $sql = "SELECT nombre FROM t_archivos WHERE id_archivo = '$idArchivo'";

            $result = mysqli_query($conexion, $sql);

            return mysqli_fetch_array($result)['nombre'];
        }

        public function eliminarRegistroArchivo($idArchivo) {
            $conexion = Conexion::conectar();
            $sql = 'DELETE FROM t_archivos WHERE id_archivo = ?';
            $query = $conexion->prepare($sql);
            $query->bind_param("i", $idArchivo);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }

        public function obtenerRutaArchivo($id_archivo){
            $conexion = Conexion::conectar();
            $sql = "SELECT nombre, tipo FROM t_archivos WHERE id_archivo = '$id_archivo'";
            $result = mysqli_query($conexion, $sql);
            $datos = mysqli_fetch_array($result);
            $nombreArchivo = $datos['nombre'];
            $extencion = $datos['tipo'];
            return Gestor::tipoArchivo($nombreArchivo, $extencion);
      
          }

        public function tipoArchivo($nombre, $extencion){
            $id_usuario = $_SESSION['id_usuario'];
            $ruta = "archivos/" . $id_usuario . "/" . $nombre;
            switch($extencion){
              case 'png':
                return '<img src="' . $ruta . '" style="width: 100%;">';
                break;
              case 'jpg':
                return '<img src="' . $ruta . '" style="width: 100%;">';
                break;
              case 'pdf':
                return '<embed src="' . $ruta . '#toolbar=0&navpanes=0&crollbar=0" type="application/pdf" width="100%" height="450px">';
                break;
              case 'mp3':
                return '<video controls src="' . $ruta . '"></video>';
                break;
              case 'mp4':
                return '<video src="' . $ruta . '" width="100%" control></video>';
                break;
              default:
                break;
            }
        }    
    }
?>




