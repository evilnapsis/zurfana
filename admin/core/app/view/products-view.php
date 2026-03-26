<?php
if(!isset($_SESSION["user_id"])){ Core::redir("./"); }
$user = UserData::getById($_SESSION["user_id"]);
if($user == null){ Core::redir("./"); }
?>

<?php if(isset($_GET["opt"]) && $_GET['opt']=="all"):
$products = ProductData::getAll();
?>

<div class="card shadow mb-4 border-0">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-0">
    <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-box-seam me-2"></i> Productos</h6>
    <a href="./?view=products&opt=new" class="btn btn-primary btn-sm rounded-pill px-3">
      <i class="bi bi-plus-lg me-1"></i> Agregar Producto
    </a>
  </div>

      <div class="card-body p-0">
        <?php if(count($products)>0): ?>
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead class="table-light fw-semibold">
              <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th class="text-center">Visible</th>
                <th class="text-center">Destacado</th>
                <th>Fecha</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($products as $cat): 
                $u = $cat->getUser();
              ?>
              <tr>
                <td><?php echo $cat->name; ?></td>
                <td>
                  <?php if($u): ?>
                    <div class="small fw-bold"><?php echo $u->name." ".$u->lastname; ?></div>
                    <div class="small text-muted"><?php echo $u->email; ?></div>
                  <?php else: ?>
                    <span class="badge bg-secondary">Sin usuario</span>
                  <?php endif; ?>
                </td>
                <td><?php echo $cat->getS()->name; ?></td>
                <td class="text-center"><?php echo $cat->is_public ? '<i class="bi-check-circle text-success"></i>' : '<i class="bi-x-circle text-danger"></i>'; ?></td>
                <td class="text-center"><?php echo $cat->is_featured ? '<i class="bi-check-circle text-success"></i>' : '<i class="bi-x-circle text-danger"></i>'; ?></td>
                <td><span class="small text-muted"><?php echo $cat->created_at; ?></span></td>

                <td style="min-width: 160px;">
                  <a href="./?action=products&opt=setsid&sid=3&id=<?php echo $cat->id; ?>" class="btn btn-success btn-sm" title="Publicar"><i class="bi-check-lg"></i></a>
                  <a href="./?action=products&opt=setsid&sid=4&id=<?php echo $cat->id; ?>" class="btn btn-secondary btn-sm" title="Rechazar"><i class="bi-x-lg"></i></a>
                  <a href="./?view=products&opt=edit&id=<?php echo $cat->id; ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
                  <a href="./?action=products&opt=del&id=<?php echo $cat->id; ?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php else: ?>
        <div class="p-3">
          <p class="alert alert-warning">No hay productos. Puedes empezar agregando tu lista de productos.</p>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):
$coin = ConfigurationData::getByPreffix("general_coin")->val;
?>

<div class="row">
  <div class="col-md-12">
    <h2>Nuevo Producto</h2>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-8">
    <div class="card mb-4">
      <div class="card-header"><i class="bi-plus-circle"></i> Nuevo Producto</div>
      <div class="card-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="./?action=products&opt=add">
          <div class="row mb-3">
            <div class="col-md-3">
              <label class="form-label">Código</label>
              <input type="text" name="code" class="form-control" placeholder="Código">
            </div>
            <div class="col-md-9">
              <label class="form-label">Nombre</label>
              <input type="text" name="name" class="form-control" placeholder="Nombre del producto">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" rows="5" name="description" placeholder="Descripción"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Precio</label>
            <div class="input-group">
              <span class="input-group-text"><?php echo $coin; ?></span>
              <input type="text" name="price" required class="form-control" placeholder="Precio">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="image" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Unidad</label>
            <?php $units = UnitData::getAll(); if(count($units)>0): ?>
            <select name="unit_id" class="form-control" required>
              <option value="">-- SELECCIONE UNIDAD --</option>
              <?php foreach($units as $u): ?>
              <option value="<?php echo $u->id; ?>"><?php echo $u->name; ?></option>
              <?php endforeach; ?>
            </select>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Categoría</label>
            <?php $categories = CategoryData::getAll(); if(count($categories)>0): ?>
            <select name="category_id" class="form-control" required>
              <option value="">-- SELECCIONE CATEGORÍA --</option>
              <?php foreach($categories as $cat): ?>
              <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
              <?php endforeach; ?>
            </select>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <div class="form-check form-check-inline">
              <input type="checkbox" name="is_public" class="form-check-input" id="is_public">
              <label class="form-check-label" for="is_public">Es Visible</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" name="in_existence" class="form-check-input" id="in_existence">
              <label class="form-check-label" for="in_existence">En Existencia</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured">
              <label class="form-check-label" for="is_featured">Producto Destacado</label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <button type="submit" class="btn btn-primary w-100">Agregar Producto</button>
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
$product = ProductData::getById($_GET["id"]);
$url = "storage/products/$product->image";
$coin = ConfigurationData::getByPreffix("general_coin")->val;
?>

<div class="row">
  <div class="col-md-12">
    <h2><?php echo $product->name; ?> <small class="text-muted">Editar</small></h2>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-8">
    <div class="card mb-4">
      <div class="card-header"><i class="bi-pencil-square"></i> Editar Producto</div>
      <div class="card-body">
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="./?action=products&opt=update">
          <input type="hidden" name="id" value="<?php echo $product->id; ?>">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" value="<?php echo $product->name; ?>" class="form-control" placeholder="Nombre del producto">
          </div>
          <div class="mb-3">
            <label class="form-label">Comentarios</label>
            <textarea class="form-control" rows="5" name="comments" placeholder="Comentarios"><?php echo $product->comments; ?></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Precio</label>
            <div class="input-group">
              <span class="input-group-text"><?php echo $coin; ?></span>
              <input type="text" name="price" value="<?php echo $product->price; ?>" required class="form-control" placeholder="Precio">
            </div>
          </div>
          <?php if($product->image!="" && file_exists($url)): ?>
          <div class="mb-3">
            <img src="<?php echo $url; ?>" class="img-fluid" style="max-height:200px;">
          </div>
          <?php endif; ?>
          <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="image" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Categoría</label>
            <?php $categories = CategoryData::getAll(); if(count($categories)>0): ?>
            <select name="category_id" class="form-control">
              <option value="">-- SELECCIONE CATEGORÍA --</option>
              <?php foreach($categories as $cat): ?>
              <option value="<?php echo $cat->id; ?>" <?php if($product->category_id==$cat->id){ echo "selected";} ?>><?php echo $cat->name; ?></option>
              <?php endforeach; ?>
            </select>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <div class="form-check form-check-inline">
              <input type="checkbox" name="is_public" class="form-check-input" id="is_public" <?php if($product->is_public){ echo "checked";} ?>>
              <label class="form-check-label" for="is_public">Es Visible</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" name="in_existence" class="form-check-input" id="in_existence" <?php if($product->in_existence){ echo "checked";} ?>>
              <label class="form-check-label" for="in_existence">En Existencia</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" <?php if($product->is_featured){ echo "checked";} ?>>
              <label class="form-check-label" for="is_featured">Producto Destacado</label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <button type="submit" class="btn btn-success w-100">Actualizar Producto</button>
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
