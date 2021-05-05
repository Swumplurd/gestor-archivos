<?php
    session_start();
    require_once '../clases/gestor.class.php';
    $gestor = new Gestor();

    $idArchivo = $_POST['idArchivo'];
    $idUsuario = $_SESSION['id_usuario'];
    $nombreArchivo = $gestor->obtenNombreArchivo($idArchivo);

    if (unlink("../archivos/" . $idUsuario . "/" . $nombreArchivo)) {
        echo $gestor->eliminarRegistroArchivo($idArchivo);
    } else {
        echo 0;
    }
?>