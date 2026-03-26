<?php 
$p = ProductData::getById($_GET["product_id"]);
if($p->s_id!=3){ Core::redir("./");}
$img_default = ConfigurationData::getByPreffix("general_img_default")->val;
$coin_symbol = ConfigurationData::getByPreffix("general_coin")->val;
Viewer::addView($p->id,"product_id","product_view");
?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="card border-0 shadow-sm mb-4 overflow-hidden">
          <div class="card-header bg-dark text-white py-3 border-0">
            <div class="d-flex align-items-center">
              <i class="fa fa-th-large me-2 text-warning"></i>
              <h5 class="mb-0 fw-bold small text-uppercase letter-spacing-1">Explorar Categorías</h5>
            </div>
          </div>
          <?php $cats = CategoryData::getPublics(); ?>
          <?php if(count($cats)>0): ?>
          <div class="list-group list-group-flush">
            <?php foreach($cats as $cat): 
              $is_current = (isset($_GET["cat"]) && $_GET["cat"] == $cat->short_name) || ($p->category_id == $cat->id);
            ?>
            <a href="index.php?view=productos&cat=<?php echo $cat->short_name; ?>" 
               class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center transition-all <?php echo $is_current ? 'bg-primary bg-opacity-10 text-primary fw-bold border-start border-primary border-4' : 'text-muted'; ?>">
              <i class="fa <?php echo $is_current ? 'fa-folder-open' : 'fa-folder'; ?> me-3 <?php echo $is_current ? 'text-primary' : 'text-secondary opacity-50'; ?>"></i>
              <span><?php echo $cat->name; ?></span>
              <i class="fa fa-chevron-right ms-auto small opacity-25"></i>
            </a>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
        
        <!-- Premium Badge / Promo -->
        <div class="card bg-gradient-primary text-white border-0 shadow-sm p-4 rounded-4 mb-4" style="background: linear-gradient(45deg, #2563eb, #7c3aed);">
          <h6 class="fw-bold mb-2">¿Buscas algo más?</h6>
          <p class="small mb-0 opacity-75">Explora todas nuestras secciones y encuentra las mejores ofertas en Zurfana.</p>
        </div>
      </div>
      
      <div class="col-md-9">
        <?php if($p!=null): 
          $img = "admin/storage/products/".$p->image;
          if($p->image==""){ $img=$img_default; }
        ?>
        <div class="card mb-4 shadow-sm border-0">
          <div class="card-header bg-info text-white py-3">
            <h2 class="h4 mb-0 fw-bold"><?php echo $p->name; ?></h2>
          </div>
          <div class="card-body p-4">
            <div class="row">
              <div class="col-md-6 mb-4 mb-md-0 d-flex align-items-center justify-content-center bg-light rounded" style="min-height: 300px;">
                <img src="<?php echo $img; ?>" class="img-fluid" style="max-height: 280px;" alt="<?php echo $p->name; ?>">
              </div>
              <div class="col-md-6 text-center text-md-start">
                <h1 class="display-4 text-primary fw-bold mb-4"><?php echo $coin_symbol; ?> <?php echo number_format($p->price, 2, ".", ","); ?></h1>
                
                <?php 
                $in_cart=false;
                if(isset($_SESSION["cart"])){
                  foreach ($_SESSION["cart"] as $pc) {
                    if($pc["product_id"]==$p->id){ $in_cart=true; }
                  }
                }
                ?>

                <?php if(!$in_cart): ?>
                <button type="button" data-bs-toggle="modal" data-bs-target="#contactModal" class="btn btn-primary btn-lg px-5 shadow-sm">
                  <i class="fa fa-envelope me-2"></i> Contactar
                </button>

                <!-- Modal -->
                <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title fw-bold" id="contactModalLabel">Contactar al vendedor</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body p-4">
                        <?php if(isset($_SESSION["client_id"]) && $_SESSION["client_id"]!=""): ?>
                          <?php if($p->user_id!=$_SESSION["client_id"]): ?>
                          <form method="post" action="index.php?action=productcontact">
                            <div class="mb-3">
                              <label for="messageText" class="form-label fw-bold">Mensaje</label>
                              <textarea required name="message" class="form-control" id="messageText" placeholder="Escribe tu mensaje aquí..." rows="5"></textarea>
                            </div>
                            <input type="hidden" name="product_id" value="<?php echo $p->id; ?>">
                            <div class="d-grid gap-2 mt-4">
                              <button type="submit" class="btn btn-primary btn-lg">Enviar Mensaje</button>
                            </div>
                          </form>
                          <?php else: ?>
                            <div class="alert alert-warning mb-0 border-0 shadow-sm"><i class="fa fa-exclamation-triangle me-2"></i> No puedes contactarte a ti mismo.</div>
                          <?php endif; ?>
                        <?php else: ?>
                          <div class="alert alert-info border-0 shadow-sm mb-4"><i class="fa fa-info-circle me-2"></i> Debes iniciar sesión para contactar al vendedor.</div>
                          <div class="d-grid gap-2">
                            <a href="index.php?view=clientaccess" class="btn btn-primary">Iniciar Sesión</a>
                            <a href="index.php?view=register" class="btn btn-outline-secondary">Registrarse</a>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
              </div>
            </div>
            
            <?php if($p->image2!="" || $p->image3!="" || $p->image4!=""): ?>
              <hr class="my-5">
              <h4 class="fw-bold mb-4">Más Imágenes</h4>
              <div class="row g-3">
                <?php if($p->image2!=""): ?>
                <div class="col-md-4">
                  <img src="admin/storage/products/<?php echo $p->image2; ?>" class="img-fluid rounded border p-1 bg-white">
                </div>
                <?php endif; ?>
                <?php if($p->image3!=""): ?>
                <div class="col-md-4">
                  <img src="admin/storage/products/<?php echo $p->image3; ?>" class="img-fluid rounded border p-1 bg-white">
                </div>
                <?php endif; ?>
                <?php if($p->image4!=""): ?>
                <div class="col-md-4">
                  <img src="admin/storage/products/<?php echo $p->image4; ?>" class="img-fluid rounded border p-1 bg-white">
                </div>
                <?php endif; ?>
              </div>
            <?php endif; ?>

            <hr class="my-5">
            <div class="row">
              <div class="col-md-12">
                <div class="p-3 bg-light rounded mb-4">
                  <p class="mb-0"><strong>Código de producto:</strong> <code class="text-primary fs-5"><?php echo $p->code; ?></code></p>
                </div>
                
                <h4 class="fw-bold mb-3 border-start border-primary border-4 ps-3">Descripción</h4>
                <div class="fs-5 text-muted mb-4"><?php echo nl2br($p->description); ?></div>
                
                <?php if($p->comments!=""): ?>
                <h4 class="fw-bold mb-3 border-start border-info border-4 ps-3">Comentarios adicionales</h4>
                <p class="mb-4"><?php echo $p->comments; ?></p>
                <?php endif; ?>

                <div class="row mt-4">
                  <?php if($p->brand!=""): ?>
                  <div class="col-md-4 mb-3">
                    <div class="p-3 border rounded shadow-sm">
                      <span class="text-muted d-block small text-uppercase fw-bold">Marca</span>
                      <span class="fs-5"><?php echo $p->brand; ?></span>
                    </div>
                  </div>
                  <?php endif; ?>

                  <?php if($p->model!=""): ?>
                  <div class="col-md-4 mb-3">
                    <div class="p-3 border rounded shadow-sm">
                      <span class="text-muted d-block small text-uppercase fw-bold">Modelo</span>
                      <span class="fs-5"><?php echo $p->model; ?></span>
                    </div>
                  </div>
                  <?php endif; ?>

                  <?php if($p->y!=""): ?>
                  <div class="col-md-4 mb-3">
                    <div class="p-3 border rounded shadow-sm">
                      <span class="text-muted d-block small text-uppercase fw-bold">Año fabricación</span>
                      <span class="fs-5"><?php echo $p->y; ?></span>
                    </div>
                  </div>
                  <?php endif; ?>
                </div>

                <hr class="my-5">
                
                <div class="bg-light p-4 rounded-3 border">
                  <?php if(isset($_SESSION["client_id"])): ?>
                    <?php if($p->user_id!=$_SESSION["client_id"]): ?>
                    <h4 class="fw-bold mb-4">Hacer una pregunta</h4>
                    <form method="post" action="index.php?action=productcontact">
                      <div class="mb-3">
                        <textarea required name="message" class="form-control" placeholder="Escribe tu pregunta aquí..." rows="4"></textarea>
                      </div>
                      <input type="hidden" name="product_id" value="<?php echo $p->id; ?>">
                      <input type="hidden" name="is_question" value="1">
                      <button type="submit" class="btn btn-dark btn-lg shadow-sm px-4">Hacer Pregunta</button>
                    </form>
                    <?php else: ?>
                      <div class="alert alert-warning mb-0"><i class="fa fa-exclamation-triangle me-2"></i> No puedes hacer preguntas sobre tus propios productos.</div>
                    <?php endif; ?>
                  <?php else: ?>
                    <div class="alert alert-info mb-0 d-flex align-items-center">
                      <i class="fa fa-info-circle fa-2x me-3"></i>
                      <div>Necesitas estar registrado e iniciar sesión para escribir preguntas.</div>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="mt-5">
                  <h4 class="fw-bold mb-4">Preguntas de la comunidad</h4>
                  <?php
                  $questions = ContactData::getQuestionsByProduct($p->id);
                  if(count($questions)>0):
                    foreach($questions as $qs):
                      $u = $qs->getUser();
                      $answers = ContactData::getAnswersByContact($qs->id);
                  ?>
                    <div class="card mb-3 border-0 bg-transparent">
                      <div class="card-body p-0">
                        <div class="d-flex mb-2 align-items-center">
                          <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fa fa-user"></i>
                          </div>
                          <div>
                            <span class="fw-bold d-block"><?php echo $u->name." ".$u->lastname; ?></span>
                            <span class="text-muted small"><?php echo $qs->created_at; ?></span>
                          </div>
                        </div>
                        <div class="ms-5 p-3 bg-white rounded shadow-sm border-start border-3 border-secondary mb-3">
                          <?php echo nl2br($qs->message); ?>
                        </div>
                        
                        <?php if(count($answers)>0): ?>
                          <div class="ms-5 pt-2">
                            <?php foreach($answers as $ans): 
                              $ux = UserData::getById($p->user_id);
                            ?>
                            <div class="d-flex mb-2 align-items-center">
                              <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 35px; height: 35px;">
                                <i class="fa fa-reply small"></i>
                              </div>
                              <div>
                                <span class="fw-bold d-block small"><?php echo $ux->name." ".$ux->lastname; ?> <span class="badge bg-primary text-white ms-1 fw-normal">Vendedor</span></span>
                                <span class="text-muted smaller"><?php echo $ans->created_at; ?></span>
                              </div>
                            </div>
                            <div class="ms-5 p-3 bg-light rounded shadow-sm border-start border-3 border-primary mb-4 italic">
                              <?php echo nl2br($ans->message); ?>
                            </div>
                            <?php endforeach; ?>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                  <?php else: ?>
                    <div class="text-center py-5 text-muted border rounded bg-light">
                      <i class="fa fa-comments-o fa-3x mb-3 opacity-25"></i>
                      <p class="mb-0">Aun no hay preguntas para este producto. ¡Sé el primero en preguntar!</p>
                    </div>
                  <?php endif; ?>
                </div>

              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
