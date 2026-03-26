<?php
if(!isset($_SESSION["user_id"])){ Core::redir("./"); }
$user = UserData::getById($_SESSION["user_id"]);
if($user == null){ Core::redir("./"); }
?>

<?php if(isset($_GET["opt"]) && $_GET['opt']=="all"):
$clients = ClientData::getAll();
?>

<div class="card shadow mb-4 border-0">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white border-0">
    <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-people me-2"></i> Clientes</h6>
    <a href="./?view=clients&opt=new" class="btn btn-primary btn-sm rounded-pill px-3">
      <i class="bi bi-plus-lg me-1"></i> Nuevo Cliente
    </a>
  </div>

      <div class="card-body">
        <?php if(count($clients)>0): ?>
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead class="table-light fw-semibold">
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($clients as $c): ?>
              <tr>
                <td><?php echo $c->id; ?></td>
                <td><?php echo $c->getFullname(); ?></td>
                <td><?php echo $c->email; ?></td>
                <td>
                  <a href="./?view=clients&opt=edit&id=<?php echo $c->id; ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
                  <a href="./?action=clients&opt=del&id=<?php echo $c->id; ?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php else: ?>
        <p class="alert alert-warning">No hay clientes por mostrar. Agrega uno o espera a que se registren.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"): ?>

<div class="row">
  <div class="col-md-12">
    <h2>Nuevo Cliente</h2>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-header"><i class="bi-person-plus"></i> Nuevo Cliente</div>
      <div class="card-body">
        <form class="form-horizontal" method="post" action="./?action=clients&opt=add">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" required class="form-control" placeholder="Nombre">
          </div>
          <div class="mb-3">
            <label class="form-label">Apellido</label>
            <input type="text" name="lastname" required class="form-control" placeholder="Apellido">
          </div>
          <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="phone" class="form-control" placeholder="Teléfono">
          </div>
          <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="address" class="form-control" placeholder="Dirección">
          </div>
          <div class="mb-3">
            <label class="form-label">Correo Electrónico</label>
            <input type="email" name="email" required class="form-control" placeholder="Correo Electrónico">
          </div>
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" required class="form-control" placeholder="Contraseña">
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Agregar Cliente</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$client = ClientData::getById($_GET["id"]);
?>

<div class="row">
  <div class="col-md-12">
    <h2>Editar Cliente</h2>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-header"><i class="bi-pencil-square"></i> Editar Cliente</div>
      <div class="card-body">
        <form class="form-horizontal" method="post" action="./?action=clients&opt=update">
          <input type="hidden" name="id" value="<?php echo $client->id; ?>">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" required value="<?php echo $client->name; ?>" class="form-control" placeholder="Nombre">
          </div>
          <div class="mb-3">
            <label class="form-label">Apellido</label>
            <input type="text" name="lastname" required value="<?php echo $client->lastname; ?>" class="form-control" placeholder="Apellido">
          </div>
          <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="phone" value="<?php echo $client->phone; ?>" class="form-control" placeholder="Teléfono">
          </div>
          <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="address" value="<?php echo $client->address; ?>" class="form-control" placeholder="Dirección">
          </div>
          <div class="mb-3">
            <label class="form-label">Correo Electrónico</label>
            <input type="email" name="email" required value="<?php echo $client->email; ?>" class="form-control" placeholder="Correo Electrónico">
          </div>
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" placeholder="Contraseña">
            <p class="text-warning">Al dejar este campo en blanco no se modificará la contraseña actual.</p>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success">Actualizar Cliente</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>
