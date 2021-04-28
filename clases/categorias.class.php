<?php
    require_once 'conexion.php';

    class Categoria extends Conexion{
        public function agregarCategoria($datos) {
            $conexion = Conexion::conectar();

            $sql = "INSERT INTO t_categorias (id_usuario, nombre) VALUES (?,?)";
            $query = $conexion->prepare($sql);
            $query->bind_param("is", $datos['id_usuario'], $datos['categoria']);
            $respuesta = $query->execute();
            $query->close();
            
            return $respuesta;
        }
    }
?>