<?php
if(!isset($_SESSION["user_id"])){ Core::redir("./"); }
$user = UserData::getById($_SESSION["user_id"]);
if($user == null){ Core::redir("./"); }
?>

<?php if(isset($_GET["opt"]) && $_GET['opt']=="all"):
$buys = BuyData::getAll();
$coin = ConfigurationData::getByPreffix("general_coin")->val;
?>

<div class="row">
  <div class="col-md-12">
    <h2>Ventas</h2>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header"><i class="bi-cart"></i> Ventas</div>
      <div class="card-body p-0">
        <?php if(count($buys)>0): ?>
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead class="table-light fw-semibold">
              <tr>
                <th></th>
                <th>Operación</th>
                <th>Cliente</th>
                <th>SubTotal</th>
                <th>Descuento</th>
                <th>Total</th>
                <th>Método de Pago</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($buys as $b):
              $discount = 0;
              ?>
              <tr>
                <td>
                  <a href="./?view=sells&opt=open&id=<?php echo $b->id; ?>" class="btn btn-sm btn-secondary">Detalles</a>
                  <a target="_blank" href="../invoice.php?code=<?php echo $b->code; ?>" class="btn btn-sm btn-secondary">Imprimir</a>
                </td>
                <td>#<?php echo $b->id; ?></td>
                <td><?php echo $b->getClient()->getFullname(); ?></td>
                <td><?php echo $coin; ?> <?php echo number_format($b->getTotal(),2,".",","); ?></td>
                <td><?php echo $coin; ?>
                  <?php if($b->coupon_id!=null){
                    $coupon = CouponData::getById($b->coupon_id);
                    $discount = $coupon->val;
                    echo number_format($discount,2,".",",");
                  }else{
                    echo number_format($discount,2,".",",");
                  } ?>
                </td>
                <td><?php echo $coin; ?> <?php echo number_format($b->getTotal()-$discount,2,".",","); ?></td>
                <td><?php echo $b->getPaymethod()->name; ?></td>
                <td><?php echo $b->getStatus()->name; ?></td>
                <td><?php echo $b->created_at; ?></td>
                <td>
                  <?php if($b->status_id!=3): ?>
                    <a href="./?action=sells&opt=history&id=<?php echo $b->id;?>" class="btn btn-secondary btn-sm"><i class="bi-clock"></i></a>
                    <?php if($b->status_id!=5): ?>
                      <a href="./?action=sells&opt=status&id=<?php echo $b->id;?>&status=2" class="btn btn-info btn-sm"><i class="bi-currency-dollar"></i></a>
                      <a href="./?action=sells&opt=status&id=<?php echo $b->id;?>&status=4" class="btn btn-success btn-sm"><i class="bi-truck"></i></a>
                      <a href="./?action=sells&opt=status&id=<?php echo $b->id;?>&status=5" class="btn btn-primary btn-sm"><i class="bi-check"></i></a>
                      <a href="./?action=sells&opt=status&id=<?php echo $b->id;?>&status=3" class="btn btn-danger btn-sm"><i class="bi-x"></i></a>
                    <?php else: ?><i class="bi-check-circle text-success"></i><?php endif; ?>
                  <?php else: ?><i class="bi-x-circle text-danger"></i><?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php else: ?>
        <div class="p-3"><h5>No hay operaciones</h5></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="open"):
$buy = BuyData::getById($_GET["id"]);
$products = BuyProductData::getAllByBuyId($_GET["id"]);
$client = ClientData::getById($buy->client_id);
$paymethod = $buy->getPaymethod();
$iva = ConfigurationData::getByPreffix("general_iva")->val;
$coin = ConfigurationData::getByPreffix("general_coin")->val;
$ivatxt = ConfigurationData::getByPreffix("general_iva_txt")->val;
?>

<div class="row">
  <div class="col-md-12">
    <a href="./?view=sells&opt=all" class="btn btn-secondary btn-sm mb-3"><i class="bi-arrow-left"></i> Volver</a>
    <h2>Compra #<?php echo $buy->id; ?> [<?php echo $buy->getStatus()->name; ?>]</h2>
    <h5>Cliente: <?php echo $client->getFullname(); ?></h5>
    <h5>Método de pago: <?php echo $paymethod->name; ?></h5>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header"><i class="bi-bag"></i> Productos</div>
      <div class="card-body p-0">
        <?php if(count($products)>0): ?>
        <table class="table table-bordered mb-0">
          <thead class="table-light fw-semibold">
            <tr>
              <th></th>
              <th>Código</th>
              <th>Producto</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($products as $p):
            $px = $p->getProduct();
            ?>
            <tr>
              <td><a target="_blank" href="../index.php?view=producto&product_id=<?php echo $px->id; ?>">Detalles</a></td>
              <td><?php echo $px->code; ?></td>
              <td><?php echo $px->name; ?></td>
              <td><?php echo $coin; ?> <?php echo number_format($px->price*$p->q,2,".",","); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<div class="row justify-content-end">
  <div class="col-md-4">
    <table class="table table-bordered">
      <tr><td>Subtotal</td><td><?php echo $coin; ?> <?php echo number_format($buy->getTotal()-($buy->getTotal()*($iva/100)),2,".",","); ?></td></tr>
      <tr><td><?php echo $ivatxt; ?></td><td><?php echo $coin; ?> <?php echo number_format($buy->getTotal()*($iva/100),2,".",","); ?></td></tr>
      <tr><td><strong>Total</strong></td><td><strong><?php echo $coin; ?> <?php echo number_format($buy->getTotal(),2,".",","); ?></strong></td></tr>
    </table>
  </div>
</div>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="report"): ?>

<div class="row">
  <div class="col-md-12">
    <h2>Reporte de Ventas</h2>
  </div>
</div>
<br>
<p class="alert alert-info">Módulo de reporte en construcción.</p>

<?php endif; ?>
