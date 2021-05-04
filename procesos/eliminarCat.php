<?php
    session_start();
    require_once '../clases/categorias.class.php';

    $categoria = new Categoria();
    echo $categoria->eliminarCat($_POST['idCategoria']);
?>