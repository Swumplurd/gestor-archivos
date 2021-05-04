<?php
    require_once '../clases/categorias.class.php';

    $categoria = new Categoria();
    echo json_encode($categoria->obtenerCategoria($_POST['idCategoria']));
?>