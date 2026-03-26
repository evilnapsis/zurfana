<?php if(isset($_SESSION["client_id"])):
$client = UserData::getById($_SESSION["client_id"]);
$coin_symbol = ConfigurationData::getByPreffix("general_coin")->val;
$img_default = ConfigurationData::getByPreffix("general_img_default")->val;
$products = ProductData::getAllByUserId($_SESSION["client_id"]);
?>
<div class="container py-4">
  <div class="row mb-4 align-items-center">
    <div class="col-md-8">
      <h1 class="h3 fw-bold mb-0">Mis Productos</h1>
      <p class="text-muted mb-0">Administra el inventario de tus artículos publicados.</p>
    </div>
    <div class="col-md-4 text-md-end">
      <a href="./?view=newproduct" class="btn btn-primary shadow-sm">
        <i class="fa fa-plus me-1"></i> Publicar Nuevo
      </a>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-12">
      <div class="d-flex flex-wrap gap-2 mb-4 p-3 bg-light rounded border">
        <a href="./?view=client" class="btn btn-outline-dark"><i class="fa fa-envelope-o me-1"></i> Bandeja</a>
        <a href="./?view=myorders" class="btn btn-outline-dark"><i class="fa fa-shopping-bag me-1"></i> Compras</a>
        <a href="./?view=myproducts" class="btn btn-dark active"><i class="fa fa-th me-1"></i> Mis Productos</a>
        <a href="./?view=myquestions" class="btn btn-outline-dark"><i class="fa fa-question-circle me-1"></i> Preguntas</a>
      </div>

      <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white py-3">
          <h2 class="h5 mb-0 fw-bold"><i class="fa fa-cube me-2"></i> Mi Inventario Público</h2>
        </div>
        <div class="card-body p-0">
          <?php if(count($products)>0): ?>
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th class="ps-3" style="width: 100px;">ID / Imagen</th>
                  <th>Detalles del Producto</th>
                  <th class="text-center">Estado</th>
                  <th>Fecha de Publicación</th>
                  <th class="text-center" style="width: 180px;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($products as $buy): 
                  $img = "admin/storage/products/".$buy->image;
                  if($buy->image == "" || !file_exists($img)){ $img = $img_default; }
                ?>
                <tr>
                  <td class="ps-3 text-center">
                    <div class="mb-1 small fw-bold text-muted">#<?php echo $buy->id; ?></div>
                    <img src="<?php echo $img; ?>" class="rounded border shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                  </td>
                  <td>
                    <div class="fw-bold fs-6 text-primary mb-0"><?php echo $buy->name; ?></div>
                    <div class="small fw-bold text-dark"><?php echo $coin_symbol." ".number_format($buy->price,2,".",","); ?></div>
                  </td>
                  <td class="text-center">
                    <?php 
                      $s = $buy->getS();
                      $badge_class = "bg-secondary";
                      if($s->id == 3){ $badge_class = "bg-success shadow-sm"; } // Aceptado/Publicado
                      if($s->id == 4){ $badge_class = "bg-danger shadow-sm"; }  // Rechazado
                      if($s->id == 1){ $badge_class = "bg-warning text-dark shadow-sm"; } // Pendiente
                      if($s->id == 5){ $badge_class = "bg-info text-white shadow-sm border"; } // Vendido
                    ?>
                    <span class="badge <?php echo $badge_class; ?> rounded-pill text-uppercase" style="font-size: 0.75rem;">
                      <?php echo $s->name; ?>
                    </span>
                  </td>
                  <td><span class="small text-muted"><?php echo $buy->created_at; ?></span></td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <?php if($buy->s_id != 5): ?>
                      <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#sellModal-<?php echo $buy->id; ?>" title="Marcar como Vendido">
                        <i class="fa fa-shopping-cart me-1"></i> Vendido
                      </button>
                      <?php endif; ?>
                      <a href="index.php?view=editproduct&product_id=<?php echo $buy->id; ?>" class="btn btn-outline-warning btn-sm" title="Editar">
                        <i class="fa fa-pencil me-1"></i> Editar
                      </a>
                      <a href="index.php?action=delproduct&id=<?php echo $buy->id; ?>" class="btn btn-outline-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                        <i class="fa fa-trash me-1"></i> Borrar
                      </a>
                    </div>

                    <!-- Modal Vendido -->
                    <?php if($buy->s_id != 5): ?>
                    <div class="modal fade text-start" id="sellModal-<?php echo $buy->id; ?>" tabindex="-1" aria-labelledby="sellModalLabel-<?php echo $buy->id; ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header bg-success text-white">
                            <h5 class="modal-title fw-bold" id="sellModalLabel-<?php echo $buy->id; ?>">Marcar como Vendido</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body p-4 text-center">
                            <i class="fa fa-check-circle fa-4x text-success mb-3"></i>
                            <h6 class="fw-bold mb-3">¿A quién le vendiste este producto?</h6>
                            <p class="text-muted small">Selecciona al comprador de la lista de personas que te contactaron.</p>
                            
                            <form method="post" action="./?action=sellproduct">
                              <input type="hidden" name="product_id" value="<?php echo $buy->id; ?>">
                              <div class="mb-4">
                                <?php 
                                $contacts = ContactData::getContactsByProductId($buy->id); 
                                ?>
                                <select name="client_id" class="form-select border-success mb-2">
                                  <option value="">-- VENDIDO FUERA DE LA PLATAFORMA --</option>
                                  <?php if(count($contacts)>0): ?>
                                    <optgroup label="Compradores que te contactaron">
                                      <?php foreach($contacts as $con): 
                                        $cu = $con->getUser();
                                      ?>
                                      <option value="<?php echo $cu->id; ?>"><?php echo $cu->name." ".$cu->lastname." (".$cu->email.")"; ?></option>
                                      <?php endforeach; ?>
                                    </optgroup>
                                  <?php endif; ?>
                                </select>
                                <?php if(count($contacts)==0): ?>
                                <div class="alert alert-info py-2 small">No has recibido contactos registrados por este producto, se marcará como <strong>venta externa</strong>.</div>
                                <?php endif; ?>
                              </div>

                              <div class="d-grid shadow-sm">
                                <button type="submit" class="btn btn-success fw-bold">Confirmar Venta</button>
                              </div>
                            </form>

                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endif; ?>
                  </td>

                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php else: ?>
          <div class="text-center py-5 text-muted">
            <i class="fa fa-dropbox fa-4x mb-3 opacity-25"></i>
            <h2 class="h4 fw-bold">Sin productos publicados.</h2>
            <p class="mb-0">¿A qué esperas para subir tu primer artículo?</p>
            <a href="./?view=newproduct" class="btn btn-primary mt-3">Comenzar Ahora</a>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
