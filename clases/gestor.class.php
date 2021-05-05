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
    }
?>




