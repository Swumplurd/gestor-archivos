<?php
    require_once 'clases/conexion.php';

    $id_usuario = $_SESSION['id_usuario'];
    $conexion = new Conexion();
    $conexion = $conexion->conectar();
?>

<table id="tablaCategorias" class="table text-center">
    <thead>
        <tr>
            <th>Id Categoria</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sql = "SELECT id_categoria, nombre, fecha_insersion FROM t_categorias WHERE id_usuario = '$id_usuario'";
            $result = mysqli_query($conexion, $sql);

            while($mostrar = mysqli_fetch_array($result)){
                $id_categoria = $mostrar['id_categoria'];
        ?>
        <tr>
            <td scope="row"> <?php echo $mostrar['id_categoria'] ?> </td>
            <td> <?php echo $mostrar['nombre'] ?> </td>
            <td> <?php echo $mostrar['fecha_insersion'] ?> </td>
            <td>
                <span class="btn btn-outline-warning" href="editar" onclick="return obtenerDatos('<?php echo $id_categoria ?>')" data-toggle="modal" data-target="#modificarCat">✏</span>
            </td>
            <td>
                <span class="btn btn-outline-danger" href="eliminar" onclick="eliminarCategoria('<?php echo $id_categoria ?>')">🚯</span>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modificarCat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Editar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="" id="actualiza-categoria">
            <fieldset>
            <legend>Actualizar Categoria</legend>
            <div class="form-group">
                <input required type="text" name="categoria" id="categoria" class="form-control" placeholder="" aria-describedby="helpId">

                <label for="categoriaU">Nombre de la Categoria</label>
                <input required type="text" name="categoriaU" id="categoriaU" class="form-control" placeholder="" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Ingresa el nuevo nombre de la categoria</small>
            </div>
            </fieldset>
        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <span type="button" id="actualiza-cat" class="btn btn-outline-warning">Actualizar</span>
        </div>
    </div>
    </div>
</div>