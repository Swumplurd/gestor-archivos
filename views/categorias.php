<?php
session_start();
if (isset($_SESSION['usuario'])) {
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

    <div id="recarga" class="row">
      <div class="col">

        <?php
        include_once 'views/includes/tablaCat.php'
        ?>

      </div>
    </div>
  </div>

  <script>
    $(document).ready(() => {
      $('#tablaCategorias').DataTable();

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
                //Falta recargar la tabla
                $('#nombre-categoria').val("");
                /* swal('^w^', 'Agregada con exito', 'success'); */
                location.reload("categorias");
              } else {
                swal('UnU', 'Fallo al agregar', 'error');
              }
            }
          });
          return false;
        }
      });
    });

    function eliminarCategoria(idCategoria) {
      idCategoria = parseInt(idCategoria);
      if (idCategoria < 1) {
        swal('No hay id de categoria');
        return false
      } else {
        swal({
            title: "Estas seguro de borrar la categoria?",
            text: "Una vez eliminada, no podra recuperarse",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                type: 'POST',
                data: "idCategoria=" + idCategoria,
                url: 'procesos/eliminarCat.php',
                success: (result) => {
                  result = result.trim();
                  console.log(result);
                  if (result == 1) {
                    //Falta recargar la tabla
                    swal("Poof! Tu categoria ha sido eliminada!", {
                      icon: "success",
                    });
                  } else {
                    swal("No se pudo eliminar la categoria", {
                      icon: "error",
                    });
                  }
                }
              });
            }
          });
      }
    }

    function obtenerDatos(idCategoria) {
      $.ajax({
        type: 'POST',
        data: "idCategoria=" + idCategoria,
        url: 'procesos/obtenerCategoria.php',
        success: (result) => {
          result = jQuery.parseJSON(result);
          $('#categoria').val(result['idCategoria']);
          $('#categoriaU').val(result['nombreCategoria']);
        }
      });
    }

    function actualizaCategoria(idCategoria) {
      console.log($('#actualiza-categoria').serialize());
      if ($('#categoriaU').val() == '') {
        swal('No hay categoria');
        return false;
      } else {
        $.ajax({
          type: 'POST',
          data: $('#actualiza-categoria').serialize(),
          url: 'procesos/actualizaCat.php',
          success: (result) => {
            result = result.trim();

            if (result == 1) {
              //Fakta Actualizar Tabla
              swal('Actualizado con exito', 'success');
            } else {
              swal('No pude hacer na de na', 'error');
            }
          }
        });
      }
    }

    $('#actualiza-cat').click(() => {
      actualizaCategoria();
    });
  </script>

<?php
} else {
  header('location: sesion');
}
?>