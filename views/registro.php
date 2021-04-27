<div class="container">
  <div class="row">
    <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
      <form action="" id="formulario-registro-a">
        <fieldset>
          <legend>Informacion Personal</legend>
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Ingresa tu(s) nombre(s)</small>
          </div>
          <div class="form-group row">
            <div class="col">
              <label for="fecha-nacimiento">Fecha de Nacimiento</label>
              <input type="date" name="fecha-nacimiento" id="fecha-nacimiento" class="form-control" placeholder="" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Ingresa tu fecha de nacimiento</small>
            </div>
          </div>
          <div class="form-group">
            <label for="registro-email">Email</label>
            <input type="email" name="registro-email" id="registro-email" class="form-control" placeholder="" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Ingresa un correo valido</small>
          </div>
          <div class="form-group">
            <label for="usuario">Nombre de Usuario</label>
            <input type="email" name="usuario" id="usuario" class="form-control" placeholder="" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Ingresa un nombre de usuario</small>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 col-md-6">
              <label for="registro-password">Password</label>
              <input type="password" name="registro-password" id="registro-password" class="form-control" placeholder="" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Ingresa una contraseña</small>
            </div>
            <div class="col-sm-12 col-md-6">
              <label for="registro-password-confirmacion">Confirmar Password</label>
              <input type="password" name="registro-password-confirmacion" id="registro-password-confirmacion" class="form-control" placeholder="" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Confirma tu contraseña</small>
            </div>
          </div>
          <div class="form-group row my-5">
            <div class="col-8 offset-2">
              <span id="btn-registro-usuario" class="btn btn-outline-success btn-block">Registrate</span>
              <a href="login" class="btn btn-outline-dark btn-block">Cancelar</a>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>

<script src="manager/registro.js"></script>