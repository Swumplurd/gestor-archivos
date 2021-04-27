<div class="container mb-5">
    <div class="row">
        <div class="col">
        
            <table id="tabla" class="table">
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
    });
</script>