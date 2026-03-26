<?php if(isset($_SESSION["client_id"])):
$client = UserData::getById($_SESSION["client_id"]);
$coin_symbol = ConfigurationData::getByPreffix("general_coin")->val;
$products = ContactData::getAnsInboxByUserId($_SESSION["client_id"]);
?>
<div class="container py-4">
  <div class="row mb-4 align-items-center">
    <div class="col-md-8">
      <h1 class="h3 fw-bold mb-0">Mis Preguntas</h1>
      <p class="text-muted mb-0">Gestiona las dudas y consultas de tus potenciales clientes.</p>
    </div>
    <div class="col-md-4 text-md-end">
      <a href="./?view=newproduct" class="btn btn-primary shadow-sm">
        <i class="fa fa-plus me-1"></i> Publicar Producto
      </a>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-12">
      <div class="d-flex flex-wrap gap-2 mb-4 p-3 bg-light rounded border">
        <a href="./?view=myorders" class="btn btn-outline-dark"><i class="fa fa-shopping-bag me-1"></i> Mis Compras</a>
        <a href="./?view=myproducts" class="btn btn-outline-dark"><i class="fa fa-th me-1"></i> Mis Productos</a>
        <a href="./?view=myquestions" class="btn btn-dark active"><i class="fa fa-question-circle me-1"></i> Mis Preguntas</a>
      </div>

      <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white py-3">
          <h2 class="h5 mb-0 fw-bold"><i class="fa fa-question-circle-o me-2"></i> Consultas Recibidas (Preguntas)</h2>
        </div>
        <div class="card-body p-0">
          <?php if(count($products)>0): ?>
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th class="ps-3" style="width: 80px;">ID</th>
                  <th>Pregunta</th>
                  <th>Remitente</th>
                  <th>Fecha</th>
                  <th class="text-center" style="width: 150px;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($products as $buy): ?>
                <tr>
                  <td class="ps-3"><span class="badge bg-secondary">#<?php echo $buy->id; ?></span></td>
                  <td>
                    <div class="fw-bold mb-1">
                      <?php 
                        $p_info = ProductData::getById($buy->product_id);
                        echo $p_info ? "Producto: ".$p_info->name : "Información no disponible";
                      ?>
                    </div>
                    <div class="text-muted small italic">"<?php echo $buy->message; ?>"</div>
                  </td>
                  <td>
                    <?php $u = $buy->getClient(); ?>
                    <div class="fw-bold"><?php echo $u->name." ".$u->lastname; ?></div>
                    <div class="small text-muted"><?php echo $u->email; ?></div>
                  </td>
                  <td><span class="small"><?php echo $buy->created_at; ?></span></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal-<?php echo $buy->id; ?>">
                      <i class="fa fa-reply me-1"></i> Responder
                    </button>

                    <!-- Modal -->
                    <div class="modal fade text-start" id="replyModal-<?php echo $buy->id; ?>" tabindex="-1" aria-labelledby="replyModalLabel-<?php echo $buy->id; ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header bg-dark text-white">
                            <h5 class="modal-title fw-bold" id="replyModalLabel-<?php echo $buy->id; ?>">Enviar Respuesta</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body p-4">
                            <div class="alert alert-light border mb-4">
                              <div class="small fw-bold text-muted mb-1 text-uppercase">Pregunta de <?php echo $u->name; ?>:</div>
                              <div class="fst-italic">"<?php echo $buy->message; ?>"</div>
                            </div>
                            <form method="post" action="index.php?action=productcontact2&msgid=<?php echo $buy->id; ?>">
                              <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase">Tu Respuesta*</label>
                                <textarea required name="message" class="form-control" placeholder="Escribe tu respuesta aquí..." rows="5"></textarea>
                              </div>
                              <input type="hidden" name="contact_id" value="<?php echo $buy->id; ?>">
                              <input type="hidden" name="product_id" value="<?php echo $buy->product_id; ?>">
                              <input type="hidden" name="is_question" value="1">
                              <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Enviar Respuesta</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php else: ?>
          <div class="text-center py-5 text-muted">
            <i class="fa fa-question-circle fa-4x mb-3 opacity-25"></i>
            <h2 class="h4 fw-bold">Sin preguntas pendientes.</h2>
            <p class="mb-0">Aún no has recibido consultas sobre tus productos.</p>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
