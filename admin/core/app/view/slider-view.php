<?php
if(!isset($_SESSION["user_id"])){ Core::redir("./"); }
$user = UserData::getById($_SESSION["user_id"]);
if($user == null){ Core::redir("./"); }
?>

<?php if(isset($_GET["opt"]) && $_GET['opt']=="all"):
$slides = SlideData::getAll();
?>

<div class="card shadow mb-4 border-0">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-0">
    <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-images me-2"></i> Slides (Slider)</h6>
    <a href="./?view=slider&opt=new" class="btn btn-primary btn-sm rounded-pill px-3">
      <i class="bi bi-plus-lg me-1"></i> Agregar Slide
    </a>
  </div>

      <div class="card-body p-0">
        <?php if(count($slides)>0): ?>
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead class="table-light fw-semibold">
              <tr>
                <th>Título</th>
                <th class="text-center">Visible</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($slides as $cat): ?>
              <tr>
                <td><?php echo $cat->title; ?></td>
                <td class="text-center">
                  <?php echo $cat->is_public ? '<i class="bi-check-circle text-success"></i>' : '<i class="bi-x-circle text-danger"></i>'; ?>
                </td>
                <td>
                  <a href="./?view=slider&opt=edit&id=<?php echo $cat->id; ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
                  <a href="./?action=slider&opt=del&id=<?php echo $cat->id; ?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php else: ?>
        <div class="p-3"><h5>No hay slides</h5></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"): ?>

<div class="row">
  <div class="col-md-12">
    <h2>Agregar Slide</h2>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-header"><i class="bi-plus-circle"></i> Nuevo Slide</div>
      <div class="card-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="./?action=slider&opt=add">
          <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="title" class="form-control" placeholder="Título del slide">
          </div>
          <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="image" class="form-control">
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input type="checkbox" name="is_public" class="form-check-input" id="is_public">
              <label class="form-check-label" for="is_public">Es Visible</label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <button type="submit" class="btn btn-primary w-100">Agregar Slide</button>
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
$slide = SlideData::getById($_GET["id"]);
$url = "storage/slides/$slide->image";
?>

<div class="row">
  <div class="col-md-12">
    <h2><?php echo $slide->title; ?> <small class="text-muted">Editar</small></h2>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-header"><i class="bi-pencil-square"></i> Editar Slide</div>
      <div class="card-body">
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="./?action=slider&opt=update">
          <input type="hidden" name="id" value="<?php echo $slide->id; ?>">
          <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="title" value="<?php echo $slide->title; ?>" class="form-control" placeholder="Título">
          </div>
          <?php if($slide->image != ""): ?>
          <div class="mb-3">
            <img src="<?php echo $url; ?>" class="img-fluid" style="max-height:200px;">
          </div>
          <?php endif; ?>
          <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="image" class="form-control">
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input type="checkbox" name="is_public" class="form-check-input" id="is_public" <?php if($slide->is_public){ echo "checked"; } ?>>
              <label class="form-check-label" for="is_public">Es Visible</label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <button type="submit" class="btn btn-success w-100">Editar Slide</button>
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
