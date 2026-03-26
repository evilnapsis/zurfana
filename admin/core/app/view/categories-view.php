<?php
if(!isset($_SESSION["user_id"])){ Core::redir("./"); }
$user = UserData::getById($_SESSION["user_id"]);
if($user == null){ Core::redir("./"); }
?>

<?php if(isset($_GET["opt"]) && $_GET['opt']=="all"):
$categories = CategoryData::getAll();
?>

<div class="card shadow mb-4 border-0">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-0">
    <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-tags me-2"></i> Categorías</h6>
    <a href="./?view=categories&opt=new" class="btn btn-primary btn-sm rounded-pill px-3">
      <i class="bi bi-plus-lg me-1"></i> Agregar Categoría
    </a>
  </div>

      <div class="card-body p-0">
        <?php if(count($categories)>0): ?>
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead class="table-light fw-semibold">
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Nombre Corto</th>
                <th class="text-center">Productos</th>
                <th class="text-center">Activo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($categories as $cat): ?>
              <tr>
                <td><?php echo $cat->id; ?></td>
                <td><?php echo $cat->name; ?></td>
                <td><?php echo $cat->short_name; ?></td>
                <td class="text-center"><span class="badge bg-secondary rounded-pill"><?php echo $cat->getProductCount(); ?></span></td>
                <td class="text-center"><?php echo $cat->is_active ? '<i class="bi-check-circle text-success"></i>' : '<i class="bi-x-circle text-danger"></i>'; ?></td>

                <td>
                  <a href="./?view=categories&opt=edit&id=<?php echo $cat->id; ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
                  <a href="./?action=categories&opt=del&id=<?php echo $cat->id; ?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php else: ?>
        <div class="p-3">
          <p class="alert alert-warning">No hay categorías registradas.</p>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"): ?>

<div class="row">
  <div class="col-md-12">
    <h2>Nueva Categoría</h2>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-5">
    <div class="card mb-4">
      <div class="card-header"><i class="bi-tag"></i> Nueva Categoría</div>
      <div class="card-body">
        <form class="form-horizontal" method="post" action="./?action=categories&opt=add">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" required name="name" class="form-control" placeholder="Nombre de la categoría">
          </div>
          <div class="mb-3">
            <label class="form-label">Nombre Corto</label>
            <input type="text" required name="short_name" class="form-control" placeholder="Nombre corto">
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input type="checkbox" name="is_active" class="form-check-input" id="is_active">
              <label class="form-check-label" for="is_active">Categoría Activa</label>
            </div>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Agregar Categoría</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$cat = CategoryData::getById($_GET["id"]);
?>

<div class="row">
  <div class="col-md-12">
    <h2>Editar Categoría</h2>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-5">
    <div class="card mb-4">
      <div class="card-header"><i class="bi-pencil-square"></i> Editar Categoría</div>
      <div class="card-body">
        <form class="form-horizontal" method="post" action="./?action=categories&opt=update">
          <input type="hidden" name="id" value="<?php echo $cat->id; ?>">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" required name="name" value="<?php echo $cat->name; ?>" class="form-control" placeholder="Nombre de la categoría">
          </div>
          <div class="mb-3">
            <label class="form-label">Nombre Corto</label>
            <input type="text" required name="short_name" value="<?php echo $cat->short_name; ?>" class="form-control" placeholder="Nombre corto">
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input type="checkbox" name="is_active" class="form-check-input" id="is_active" <?php if($cat->is_active){ echo "checked"; } ?>>
              <label class="form-check-label" for="is_active">Categoría Activa</label>
            </div>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-success">Actualizar Categoría</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>
