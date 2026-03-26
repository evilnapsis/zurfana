<?php if(isset($_SESSION["client_id"])):
$client = UserData::getById($_SESSION["client_id"]);
$coin_symbol = ConfigurationData::getByPreffix("general_coin")->val;
$img_default = ConfigurationData::getByPreffix("general_img_default")->val;
$products = ProductData::getBoughtByUserId($_SESSION["client_id"]);
?>
<div class="container py-4">
  <div class="row mb-4 align-items-center">
    <div class="col-md-8">
      <h1 class="h3 fw-bold mb-0">Mis Compras</h1>
      <p class="text-muted mb-0">Historial de productos que has adquirido en la plataforma.</p>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-12">
      <div class="d-flex flex-wrap gap-2 mb-4 p-3 bg-light rounded border">
        <a href="./?view=client" class="btn btn-outline-dark"><i class="fa fa-envelope-o me-1"></i> Bandeja</a>
        <a href="./?view=myorders" class="btn btn-dark active"><i class="fa fa-shopping-bag me-1"></i> Mis Compras</a>
        <a href="./?view=myproducts" class="btn btn-outline-dark"><i class="fa fa-th me-1"></i> Mis Productos</a>
        <a href="./?view=myquestions" class="btn btn-outline-dark"><i class="fa fa-question-circle me-1"></i> Mis Preguntas</a>
      </div>

      <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white py-3 border-0">
          <h2 class="h5 mb-0 fw-bold"><i class="fa fa-check-square-o me-2"></i> Productos Adquiridos</h2>
        </div>
        <div class="card-body p-0">
          <?php if(count($products)>0): ?>
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th class="ps-3" style="width: 100px;">Producto</th>
                  <th>Detalles</th>
                  <th>Vendedor</th>
                  <th>Fecha de Venta</th>
                  <th class="text-center">Estado</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($products as $buy): 
                  $img = "admin/storage/products/".$buy->image;
                  if($buy->image == "" || !file_exists($img)){ $img = $img_default; }
                  $seller = UserData::getById($buy->user_id);
                ?>
                <tr>
                  <td class="ps-3">
                    <img src="<?php echo $img; ?>" class="rounded border shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                  </td>
                  <td>
                    <div class="fw-bold fs-6 text-primary mb-0"><?php echo $buy->name; ?></div>
                    <div class="small fw-bold text-dark"><?php echo $coin_symbol." ".number_format($buy->price,2,".",","); ?></div>
                  </td>
                  <td>
                    <?php if($seller): ?>
                      <div class="fw-bold small"><?php echo $seller->name." ".$seller->lastname; ?></div>
                      <div class="text-muted small italic"><?php echo $seller->email; ?></div>
                    <?php else: ?>
                      <span class="text-muted small">Desconocido</span>
                    <?php endif; ?>
                  </td>
                  <td><span class="small text-muted"><?php echo $buy->created_at; ?></span></td>
                  <td class="text-center">
                    <span class="badge bg-success rounded-pill text-uppercase px-3">
                      Completada
                    </span>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php else: ?>
          <div class="text-center py-5 text-muted">
            <i class="fa fa-shopping-bag fa-4x mb-3 opacity-25"></i>
            <h2 class="h4 fw-bold">Aún no has realizado compras.</h2>
            <p class="mb-0">Cuando adquieras un producto, aparecerá en este listado.</p>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
