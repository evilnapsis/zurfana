<?php
if(!isset($_SESSION["user_id"])){ Core::redir("./"); }
$user = UserData::getById($_SESSION["user_id"]);
if($user == null){ Core::redir("./"); }
?>

<?php if(isset($_GET["opt"]) && $_GET['opt']=="all"):
$coupons = CouponData::getAll();
?>

<div class="card shadow mb-4 border-0">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-0">
    <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-ticket-perforated me-2"></i> Cupones</h6>
    <a href="./?view=coupons&opt=new" class="btn btn-primary btn-sm rounded-pill px-3">
      <i class="bi bi-plus-lg me-1"></i> Agregar Cupón
    </a>
  </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead class="table-light fw-semibold">
              <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Valor</th>
                <th>Inicio / Fin</th>
                <th class="text-center">Activo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if(count($coupons)>0): ?>
              <?php foreach($coupons as $cat): ?>
              <tr>
                <td><?php echo $cat->name; ?></td>
                <td><?php if($cat->product_id==null){ echo "CUALQUIERA"; }else{ echo $cat->getProduct()->name;} ?></td>
                <td><?php echo $cat->val; ?></td>
                <td>
                  <?php echo $cat->start_at!="0000-00-00" ? date("d-M-Y",strtotime($cat->start_at)):"----"; ?>
                  /
                  <?php echo $cat->finish_at!="0000-00-00" ? date("d-M-Y",strtotime($cat->finish_at)):"----"; ?>
                </td>
                <td class="text-center">
                  <?php echo $cat->is_active ? '<i class="bi-check-circle text-success"></i>' : '<i class="bi-x-circle text-danger"></i>'; ?>
                </td>
                <td>
                  <a href="./?view=coupons&opt=edit&id=<?php echo $cat->id; ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
                  <a href="./?action=coupons&opt=del&id=<?php echo $cat->id; ?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php else: ?>
              <tr><td colspan="6"><p class="alert alert-warning m-2">No hay cupones registrados.</p></td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"): ?>

<div class="row">
  <div class="col-md-12">
    <h2>Nuevo Cupón</h2>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-7">
    <div class="card mb-4">
      <div class="card-header"><i class="bi-plus-circle"></i> Nuevo Cupón</div>
      <div class="card-body">
        <form class="form-horizontal" method="post" action="./?action=coupons&opt=add">
          <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="text" name="name" class="form-control" placeholder="Código del cupón">
          </div>
          <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" rows="3" name="description" placeholder="Descripción"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Valor</label>
            <input type="text" name="val" class="form-control" placeholder="Valor del cupón">
          </div>
          <div class="mb-3">
            <label class="form-label">Producto</label>
            <?php $products = ProductData::getAll(); if(count($products)>0): ?>
            <select name="product_id" class="form-control">
              <option value="">-- CUALQUIERA --</option>
              <?php foreach($products as $p): ?>
              <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
              <?php endforeach; ?>
            </select>
            <p class="form-text">Al seleccionar un producto, el descuento solo se aplica a una pieza.</p>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input type="checkbox" name="is_multiple" class="form-check-input" id="is_multiple">
              <label class="form-check-label" for="is_multiple">Es múltiple</label>
              <p class="form-text">Habilita descuento para N piezas.</p>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Inicio</label>
              <input type="date" name="start_at" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Fin</label>
              <input type="date" name="finish_at" class="form-control">
            </div>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input type="checkbox" name="is_active" class="form-check-input" id="is_active">
              <label class="form-check-label" for="is_active">Activar</label>
              <p class="form-text">El cupón está listo para usar.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <button type="submit" class="btn btn-primary w-100">Agregar Cupón</button>
            </div>
            <div class="col-md-4">
              <button type="reset" class="btn btn-secondary w-100">Limpiar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$coupon = CouponData::getById($_GET["id"]);
?>

<div class="row">
  <div class="col-md-12">
    <h2>Editar Cupón</h2>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-7">
    <div class="card mb-4">
      <div class="card-header"><i class="bi-pencil-square"></i> Editar Cupón</div>
      <div class="card-body">
        <form class="form-horizontal" method="post" action="./?action=coupons&opt=update">
          <input type="hidden" name="id" value="<?php echo $coupon->id; ?>">
          <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="text" name="name" value="<?php echo $coupon->name; ?>" class="form-control" placeholder="Código del cupón">
          </div>
          <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" rows="3" name="description" placeholder="Descripción"><?php echo $coupon->description; ?></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Valor</label>
            <input type="text" name="val" value="<?php echo $coupon->val; ?>" class="form-control" placeholder="Valor del cupón">
          </div>
          <div class="mb-3">
            <label class="form-label">Producto</label>
            <?php $products = ProductData::getAll(); if(count($products)>0): ?>
            <select name="product_id" class="form-control">
              <option value="">-- CUALQUIERA --</option>
              <?php foreach($products as $p): ?>
              <option value="<?php echo $p->id; ?>" <?php if($p->id==$coupon->product_id){ echo "selected"; } ?>><?php echo $p->name; ?></option>
              <?php endforeach; ?>
            </select>
            <p class="form-text">Al seleccionar un producto, el descuento solo se aplica a una pieza.</p>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input type="checkbox" name="is_multiple" class="form-check-input" id="is_multiple" <?php if($coupon->is_multiple){ echo "checked"; } ?>>
              <label class="form-check-label" for="is_multiple">Es múltiple</label>
              <p class="form-text">Habilita descuento para N piezas.</p>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Inicio</label>
              <input type="date" name="start_at" value="<?php echo $coupon->start_at; ?>" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Fin</label>
              <input type="date" name="finish_at" value="<?php echo $coupon->finish_at; ?>" class="form-control">
            </div>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input type="checkbox" name="is_active" class="form-check-input" id="is_active" <?php if($coupon->is_active){ echo "checked"; } ?>>
              <label class="form-check-label" for="is_active">Activar</label>
              <p class="form-text">El cupón está listo para usar.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <button type="submit" class="btn btn-success w-100">Actualizar Cupón</button>
            </div>
            <div class="col-md-4">
              <button type="reset" class="btn btn-secondary w-100">Limpiar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>
