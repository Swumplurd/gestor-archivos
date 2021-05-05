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
                      <input type="file" name="archivos[ ]" id="archivos[ ]" class="form-control" multiple="">
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

        <?php
        require_once './clases/conexion.php';

        $c = new Conexion();
        $conexion = $c->conectar();
        $idUsuario = $_SESSION['id_usuario'];
        $sql = "SELECT archivos.id_archivo AS idArchivo, usuario.nombre AS nombreUsuario, categoriAS.nombre AS categoria, archivos.nombre AS nombreArchivo, archivos.tipo AS tipoArchivo, archivos.ruta AS rutaArchivo, archivos.fecha AS fecha
            FROM t_archivos AS archivos INNER JOIN t_usuarios as usuario ON archivos.id_usuario = usuario.id_usuario INNER JOIN t_categorias AS categorias ON archivos.id_categoria = categorias.id_categoria
            AND archivos.id_usuario = '$idUsuario'";
        $result = mysqli_query($conexion, $sql);
        ?>

        <table id="tablaGestorArchivos" class="table text-center">
          <thead>
            <tr>
              <th>Categoria</th>
              <th>Nombre</th>
              <th>Extension</th>
              <th>Descargar</th>
              <th>Visualizar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>

            <?php
            while ($mostrar = mysqli_fetch_array($result)) {
              $rutaDescarga = "archivos/" . "$idUsuario" . "/" . $mostrar['nombreArchivo'];
              $nombreArchivo = $mostrar['nombreArchivo'];
              $idArchivo = $mostrar['idArchivo']
            ?>

              <tr>
                <td scope="row"><?php echo $mostrar['categoria'] ?></td>
                <td><?php echo $mostrar['nombreArchivo'] ?></td>
                <td><?php echo $mostrar['tipoArchivo'] ?></td>
                <td>
                  <a class="btn btn-outline-primary" href="<?php echo $rutaDescarga ?>" download="<?php echo $nombreArchivo ?>">⤵</a>
                </td>
                
                <td>
                  <?php
                  $extensionesValidas = array('png', 'jpg', 'pdf', 'mp3', 'mp4');
                  for ($i = 0; $i < count($extensionesValidas); $i++) {
                    if ($extensionesValidas[$i] == $mostrar['tipoArchivo']) {
                  ?>
                      <a class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#mirar" onclick="ver(<?php echo $idArchivo ?>)">
                        👀
                      </a>
                  <?php
                    }
                  }
                  ?>
                </td>
                
                <td>
                  <a class="btn btn-outline-danger" onclick="eliminarArchivo(<?php echo $idArchivo ?>)">🚯</a>
                </td>
              </tr>

            <?php
            }
            ?>

          </tbody>
        </table>
        
        <!-- Modal -->
        <div class="modal fade" id="mirar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Archivo</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div id="archivoObtenido"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    $(document).ready(() => {
      $('#tablaGestorArchivos').DataTable();
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
            response = response.trim();
            if (response == 1) {
              //Falta recargar tabla
              swal(":D", "Se agrego con exito el archivo", "success");
            } else {
              swal("D:", "No se agrego", "error");
            }
          }
        });
      });
    });

    function eliminarArchivo(idArchivo) {
      idArchivo = parseInt(idArchivo);
      if (idArchivo < 1) {
        swal('No hay id de archivo');
        return false
      } else {
        swal({
            title: "Estas seguro de borrar el archivo?",
            text: "Una vez eliminado, no podra recuperarse",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                type: 'POST',
                data: "idArchivo=" + idArchivo,
                url: 'procesos/eliminarFile.php',
                success: (result) => {
                  result = result.trim();
                  console.log(result);
                  if (result == 1) {
                    //Falta recargar la tabla
                    swal("Poof! Tu archivo ha sido eliminada!", {
                      icon: "success",
                    });
                  } else {
                    swal("No se pudo eliminar el archivo", {
                      icon: "error",
                    });
                  }
                }
              });
            }
          });
      }
    }

    function ver(id_archivo) {
    console.log(id_archivo);
    $.ajax({
        type: "POST",
        data: "id_archivo=" + id_archivo,
        url: "procesos/obtenerArchivo.php",
        success: function(respuesta) {
            $('#archivoObtenido').html(respuesta);
        }
    });
}
  </script>

<?php
} else {
  header('location: sesion');
}
?>