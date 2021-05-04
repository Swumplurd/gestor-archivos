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

        public function eliminarCat($idCategoria) {
            $conexion = Conexion::conectar();

            $sql = "DELETE FROM t_categorias WHERE id_categoria = ?";
            $query = $conexion->prepare($sql);
            $query->bind_param('i', $idCategoria);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }

        public function obtenerCategoria($idCategoria) {
            $conexion = Conexion::conectar();

            $sql = "SELECT id_categoria, nombre FROM t_categorias WHERE id_categoria = $idCategoria";
            $result = mysqli_query($conexion, $sql);
            $categorias = mysqli_fetch_array($result);
            $datos = array(
                "idCategoria" => $categorias['id_categoria'],
                "nombreCategoria" => $categorias['nombre']
            );
            return $datos;
        }

        public function actualizarCat($datos) {
            $conexion = Conexion::conectar();

            $sql = "UPDATE t_categorias SET nombre = ? WHERE id_categoria = ?";
            $query = $conexion->prepare($sql);
            $query->bind_param("si", $datos['categoriaU'], $datos['categoria']);
            $response = $query->execute();
            $query->close();
            return $response;
        }
    }
?>