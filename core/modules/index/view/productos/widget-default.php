<?php 
if(isset($_GET["cat"])){
  $cat = CategoryData::getByPreffix($_GET["cat"]);
  $products = ProductData::getPublicsByCategoryId($cat->id);
  $title = $cat->name;
} else if(isset($_GET["opt"])){
  if($_GET["opt"]=="news"){
    $products = ProductData::getNews();
    $title = "Novedades";
  } else if($_GET["opt"]=="offers"){
    $products = ProductData::getOffers();
    $title = "Ofertas";
  }
} else if(isset($_GET["act"]) && $_GET["act"]=="search"){
  $products = ProductData::getLike($_GET["q"]);
  $title = "Busqueda: ".$_GET["q"];
}

$coin = ConfigurationData::getByPreffix("general_coin")->val;
$img_default = ConfigurationData::getByPreffix("general_img_default")->val;
?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="bg-dark text-white p-3 mb-4 rounded">
          <h2 class="h4 mb-0 text-center text-uppercase fw-bold"><?php echo $title; ?></h2>
        </div>

        <?php if(count($products)>0): ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <?php foreach($products as $p): 
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
            <h2 class="display-5 fw-bold">No hay productos</h2>
            <p class="col-md-8 fs-4 mx-auto">No hay productos por mostrar en esta sección.</p>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
