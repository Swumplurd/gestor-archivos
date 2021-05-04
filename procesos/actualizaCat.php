<?php
    require_once '../clases/categorias.class.php';

    $categoria = new Categoria();

    $datos = array(
        "categoria" => $_POST['categoria'],
        "categoriaU" => $_POST['categoriaU']
    );

    echo $categoria->actualizarCat($datos);
?>