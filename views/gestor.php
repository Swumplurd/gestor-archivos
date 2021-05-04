<?php
session_start();
if (isset($_SESSION['usuario'])) {
?>

  <div class="container mb-5">
    <div class="row mb-3">
      <div class="col">
        <span type="button" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#modelId">
          Agregar Archivo
        </span>

        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="nuevo-archivo" enctype="multipart/form-data">
                  <fieldset>
                    <legend>Agrega Archivo</legend>
                    <div class="form-group">
                      <label for="">Categoria</label>
                      <div id="categoriasLoad"></div>
                    </div>
                    <div class="form-group">
                      <label for="archivos">Subir</label>
                      <input type="file" name="archivos" id="archivos" class="form-control" placeholder="" aria-describedby="helpId">
                      <small id="helpId" class="text-muted">Sube tus archivos</small>
                    </div>
                  </fieldset>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <span type="button" class="btn btn-primary" id="btnGuardarArchivos">Subir</span>
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
              <th>Extension</th>
              <th>Descargar</th>
              <th>Visualizar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td scope="row"></td>
              <td></td>
              <td></td>
              <td></td>
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
      $('#categoriasLoad').load('views/includes/selectCat.php');

      $('#btnGuardarArchivos').click(() => {
        var formData = new FormData(document.getElementById('nuevo-archivo'));
        $.ajax({  
          url: 'procesos/guardarArchivos.php',
          type: 'POST',
          datatype: "html",
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          success: (response) => {
            console.log(response);
            console.log('object');
          }
        });
      });
    });
  </script>

<?php
} else {
  header('location: sesion');
}
?>