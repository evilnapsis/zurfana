<?php 
$coin = ConfigurationData::getByPreffix("general_coin")->val;
$img_default = ConfigurationData::getByPreffix("general_img_default")->val;
$cnt=0;
$slides = SlideData::getPublics();
$featureds = ProductData::getFeatureds();
?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php if(count($slides)>0): ?>
        <div id="carouselHome" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <?php foreach($slides as $index => $s): ?>
            <button type="button" data-bs-target="#carouselHome" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index == 0 ? 'active' : ''; ?>" aria-current="<?php echo $index == 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $index + 1; ?>"></button>
            <?php endforeach; ?>
          </div>
          <div class="carousel-inner">
            <?php foreach($slides as $index => $s): $url = "admin/storage/slides/".$s->image; ?>
            <div class="carousel-item <?php echo $index == 0 ? 'active' : ''; ?>">
              <img src="<?php echo $url; ?>" class="d-block w-100" alt="<?php echo $s->title; ?>">
              <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                <h2 class="mb-0"><?php echo $s->title; ?></h2>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselHome" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselHome" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
          </button>
        </div>
        <br><br>
        <?php endif; ?>

        <?php if(count($featureds)>0): ?>
        <div class="bg-dark text-white p-3 mb-4 rounded">
          <h2 class="h4 mb-0 text-center text-uppercase fw-bold">Productos Destacados</h2>
        </div>
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <?php foreach($featureds as $p): 
            $img = "admin/storage/products/".$p->image;
            if($p->image == "") { $img = $img_default; }
          ?>
          <div class="col">
            <div class="card h-100 text-center shadow-sm">
              <div class="p-4 bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                <img src="<?php echo $img; ?>" class="img-fluid" style="max-height: 100%;" alt="<?php echo $p->name; ?>">
              </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $p->name; ?></h5>
                <p class="card-text text-primary h4 fw-bold">
                  <?php echo $coin; ?> <?php echo number_format($p->price, 2, ".", ","); ?>
                </p>
              </div>
              <div class="card-footer bg-transparent border-0 pb-3">
                <a href="index.php?view=producto&product_id=<?php echo $p->id; ?>" class="btn btn-outline-secondary">
                  Detalles <i class="fa fa-arrow-right ms-1"></i>
                </a>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="p-5 mb-4 bg-light rounded-3 text-center border">
          <div class="container-fluid py-5">
            <h2 class="display-5 fw-bold">No hay productos destacados.</h2>
            <p class="col-md-8 fs-4 mx-auto">En la página principal solo se muestran productos marcados como destacados.</p>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
