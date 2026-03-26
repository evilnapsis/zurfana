<div class="container py-5">
  <div class="row align-items-center">
    <div class="col-lg-6 mb-5 mb-lg-0">
      <div class="pe-lg-5 text-center text-lg-start">
        <h1 class="display-5 fw-bold mb-4 text-primary">¡Únete a la comunidad de Zurfana!</h1>
        <p class="fs-5 text-muted mb-4 lead">Para participar en preguntas o realizar compras, es necesario registrarte con datos fidedignos. Disfruta de una experiencia completa en nuestra tienda en línea.</p>
        <div class="d-flex flex-column gap-3">
          <div class="d-flex align-items-center">
            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
              <i class="fa fa-check text-primary"></i>
            </div>
            <span class="fs-6">Participa en preguntas y respuestas</span>
          </div>
          <div class="d-flex align-items-center">
            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
              <i class="fa fa-shopping-cart text-primary"></i>
            </div>
            <span class="fs-6">Compra productos de forma segura</span>
          </div>
          <div class="d-flex align-items-center">
            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
              <i class="fa fa-bell-o text-primary"></i>
            </div>
            <span class="fs-6">Recibe notificaciones de tus pedidos</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-dark text-white py-4">
          <h2 class="h4 mb-0 text-center fw-bold">REGISTRO DE USUARIOS</h2>
        </div>
        <div class="card-body p-4 p-md-5">
          <form method="post" action="index.php?action=register">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-bold small text-uppercase">Nombre*</label>
                <input type="text" required name="name" class="form-control" placeholder="Nombre">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold small text-uppercase">Apellido*</label>
                <input type="text" required name="lastname" class="form-control" placeholder="Apellido">
              </div>
              <div class="col-12 mt-3">
                <label class="form-label fw-bold small text-uppercase">Teléfono</label>
                <input type="text" name="phone" class="form-control" placeholder="Ej: +52 123 456 7890">
              </div>
              <div class="col-12 mt-3">
                <label class="form-label fw-bold small text-uppercase">Dirección</label>
                <input type="text" name="address" class="form-control" placeholder="Tu dirección completa">
              </div>
              <div class="col-12 mt-3">
                <label class="form-label fw-bold small text-uppercase">Correo Electrónico*</label>
                <input type="email" name="email" required class="form-control" placeholder="ejemplo@correo.com">
              </div>
              <div class="col-12 mt-3">
                <label class="form-label fw-bold small text-uppercase">Contraseña*</label>
                <input type="password" required name="password" class="form-control" placeholder="Mínimo 8 caracteres">
              </div>
              <div class="col-12 mt-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="accept" id="acceptCheck" required>
                  <label class="form-check-label small text-muted" for="acceptCheck">
                    Acepto los términos y condiciones de uso
                  </label>
                </div>
              </div>
              <div class="col-12 mt-4">
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm py-3">CREAR MI CUENTA</button>
                </div>
                <p class="text-center mt-3 text-muted small">* Campos obligatorios</p>
              </div>
            </div>
          </form>
          <hr class="my-4">
          <div class="text-center">
            <p class="mb-0 text-muted small">¿Ya tienes una cuenta? <a href="index.php?view=clientaccess" class="text-decoration-none fw-bold">Inicia sesión</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>