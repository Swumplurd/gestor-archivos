<?php
    session_start();
    if(isset($_SESSION['usuario'])) {
?>

<div class="container mb-5">
    <div class="row mb-3">
        <div class="col">

            <!-- Button trigger modal -->
            <span type="button" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#modelId">
              Agregar Nueva Categoria
            </span>
            
            <!-- Modal -->
            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Agrega Nueva Categoria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="nueva-categoria">
                                <fieldset>
                                    <legend>Categoria</legend>
                                    <div class="form-group">
                                        <label for="nombre-categoria">Nombre de la Categoria</label>
                                        <input required type="text" name="nombre-categoria" id="nombre-categoria" class="form-control" placeholder="" aria-describedby="helpId">
                                        <small id="helpId" class="text-muted">Ingresa el nombre de la categoria</small>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                            <span type="button" id="guardar-cat" class="btn btn-outline-primary">Guardar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
        
            <table id="tabla" class="table text-center">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td>
                            <a class="btn btn-outline-warning" href="editar">✏</a>
                        </td>
                        <td>
                            <a class="btn btn-outline-danger" href="eliminar">🚯</a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        $('#tabla').DataTable();

        $('#guardar-cat').click(() => {
            if ($('#nombre-categoria').val() == '') {
                swal(":'l", 'Agrega una categoria', 'error');
                return false;
            } else {
                var categoria = $('#nombre-categoria').val();
                $.ajax({
                    type: 'POST',
                    data: "categoria=" + categoria,
                    url: 'procesos/categorias.php',
                    success: (response) => {
                        response = response.trim();
                        if (response == 1) {
                            $('#nombre-categoria').val("");
                            swal('^w^', 'Agregada con exito', 'success')
                        } else {
                            swal('UnU', 'Fallo al agregar', 'error');
                        }
                    }
                });
                return false;
            }
        });
    });
</script>

<?php
    } else {
        header('location: sesion');
    }
?>