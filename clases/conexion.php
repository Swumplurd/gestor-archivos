<?php
    class Conexion {
        public function conectar() {
            $servidor = 'localhost';
            $usuario = 'root';
            $password = '';
            $bd = 'gestor';

            return $conexion = mysqli_connect($servidor, $usuario, $password, $bd);
        }
    }
?>