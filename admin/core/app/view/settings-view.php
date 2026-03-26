<?php if(isset($_GET["opt"]) && $_GET["opt"]=="all"):
$settings = ConfigurationData::getAll();
?>
<div class="card shadow mb-4 border-0">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-0">
    <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-gear me-2"></i> Ajustes Generales</h6>
    <a href="./?view=settings&opt=new" class="btn btn-primary btn-sm rounded-pill px-3">
      <i class="bi bi-plus-lg me-1"></i> Nueva Variable
    </a>
  </div>
  <div class="card-body">
    <form method="post" action="./?action=settings&opt=update">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th style="width: 40%;">Propiedad</th>
              <th>Valor</th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($settings)>0): ?>
            <?php foreach($settings as $cat): ?>
            <tr>
              <td class="fw-bold text-muted"><?php echo $cat->label; ?></td>
              <td>
                <input type="text" name="<?php echo $cat->name; ?>" class="form-control" value="<?php echo $cat->val; ?>">
              </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <tr>
              <td></td>
              <td class="text-end py-4">
                <button type="submit" class="btn btn-success px-5 fw-bold shadow-sm">
                  <i class="bi bi-save me-2"></i> ACTUALIZAR AJUSTES
                </button>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </form>
  </div>
</div>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):?>
  <div class="container">
<div class="row">
<div class="col-md-12">
<h2>Nueva Variable en Ajustes</h2>


<form method="post" action="./?action=settings&opt=add">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre corto / slug</label>
    <input type="text" required name="name" class="form-control" id="exampleInputEmail1" placeholder="Nombre corto /slug">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre / Etiqueta</label>
    <input type="text" required name="label" class="form-control" id="exampleInputEmail1" placeholder="Nombre / Etiqueta">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Valor</label>
    <input type="text" required name="val" class="form-control" id="exampleInputEmail1" placeholder="Valor">
  </div>

  <div class="d-grid gap-2">
  <button type="submit" class="btn btn-primary ">Guardar</button>
</div>
</form>

</div>
</div>
</div>
<?php endif; ?>