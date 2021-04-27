<div class="container mb-4">
  <div class="row">
    <div class="col">
      <div class="jumbotron mb-0 py-4 bg-dark text-light rounded-0 rounded-bottom">
        <h1 class="display-4 text-center d-none d-sm-block">Gestor de Archivos PHP - MYSQL</h1>
        <h1 class="display-6 text-center d-block d-sm-none">Gestor de Archivos PHP - MYSQL</h1>
        <hr class="my-2 bg-light">
        <p class="lead d-md-block text-center d-none d-sm-block">Bienvenidos al gestor de archivos PHP - MYSQL</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded-bottom">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link <?php if ($_GET['view'] == 'home') {echo 'active';} ?>" href="home">Home</a>
            <a class="nav-item nav-link <?php if ($_GET['view'] == 'login') {echo 'active';} ?>" href="login">Login</a>
            <a class="nav-item nav-link <?php if ($_GET['view'] == 'registro') {echo 'active';} ?>" href="registro">Registro</a>
          </div>
        </div>
      </nav>
    </div>
  </div>
</div>