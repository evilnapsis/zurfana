<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white py-3">
          <h2 class="h5 mb-0 text-center fw-bold">ACCESO DE USUARIOS</h2>
        </div>
        <div class="card-body p-4 p-md-5">
          <form method="post" action="index.php?action=clientaccess">
            <div class="mb-4">
              <label for="inputEmail" class="form-label fw-bold">Correo Electrónico</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fa fa-envelope-o text-muted"></i></span>
                <input type="email" name="email" class="form-control form-control-lg" id="inputEmail" placeholder="ejemplo@correo.com" required>
              </div>
            </div>
            <div class="mb-4">
              <label for="inputPassword" class="form-label fw-bold">Contraseña</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="fa fa-lock text-muted"></i></span>
                <input type="password" name="password" class="form-control form-control-lg" id="inputPassword" placeholder="Tu contraseña" required>
              </div>
            </div>
            <div class="d-grid mt-5">
              <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">Iniciar Sesión</button>
            </div>
          </form>
          <div class="text-center mt-4">
            <p class="mb-0 text-muted">¿No tienes una cuenta? <a href="index.php?view=register" class="text-decoration-none fw-bold">Regístrate aquí</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

