<?php
  session_start();
  require_once "../clases/gestor.class.php";
  $gestor = new Gestor();
  $id_archivo = $_POST['id_archivo'];
  echo $gestor->obtenerRutaArchivo($id_archivo);
?>