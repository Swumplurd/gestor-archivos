<?php
    require_once 'conexion.php';

    class Usuario extends Conexion{
        public function agregarUsuario($datos){
            $conexion = Conexion::conectar();
            $sql = 'INSERT INTO t_usuarios (nombre, fecha_nacimiento, email, usuario, password) VALUES (?, ?, ?, ?, ?)';
            $query = $conexion->prepare($sql);
            $query->bind_param('sssss', $datos['nombre'], $datos['fecha-nacimiento'], $datos['registro-email'], $datos['usuario'], $datos['password']);
            $success = $query->execute();
            $query->close();
            return $success;
        } 
    }
?>