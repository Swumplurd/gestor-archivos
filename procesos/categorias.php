<?php
    session_start();

    require_once '../clases/categorias.class.php';

    $cat = new Categoria();

    $datos = array(
        "id_usuario" => $_SESSION['id_usuario'],
        "categoria" => $_POST['categoria']
    );

    echo $cat->agregarCategoria($datos);
?>