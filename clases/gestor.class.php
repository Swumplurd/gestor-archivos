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
    }
?>




