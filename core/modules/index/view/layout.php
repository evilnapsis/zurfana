<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zurfana - Sistema de Tienda en Linea</title>
  <link rel="stylesheet" type="text/css" href="admin/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="res/lib/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="res/btn-label.css">
  <script src="res/lib/jquery/jquery.min.js"></script>
</head>
<body>
<section class="py-4">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-3 col-6">
        <h1>Zurfana</h1>
      </div>
      <div class="col-md-7 col-6">
        <form class="form-horizontal" action="./">
          <div class="input-group">
            <input type="hidden" name="view" value="productos">
            <input type="hidden" name="act" value="search">
            <input type="text" name="q" placeholder="Buscar productos ..." class="form-control">
            <button class="btn btn-primary" type="submit">&nbsp;<i class="fa fa-search"></i>&nbsp;</button>
          </div>
        </form>
      </div>
      <div class="col-md-2 d-none d-md-block">
        <!-- cart button placeholder -->
      </div>
    </div>
  </div>
</section>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="./"><i class="fa fa-home"></i> Inicio</a></li>
        <?php $cats = CategoryData::getPublics(); ?>
        <?php if(count($cats)>0): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-th-list"></i> Productos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php foreach($cats as $cat): ?>
            <li><a class="dropdown-item" href="index.php?view=productos&cat=<?php echo $cat->short_name; ?>"><?php echo $cat->name; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav">
        <?php if(!isset($_SESSION["client_id"])): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-user"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="index.php?view=clientaccess">Iniciar Sesion</a></li>
            <li><a class="dropdown-item" href="index.php?view=register">Registrarse</a></li>
          </ul>
        </li>
        <?php else: $client = UserData::getById($_SESSION["client_id"]); ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="loggedDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-user"></i> &nbsp; <?php echo $client->name." ".$client->lastname; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="loggedDropdown">
            <li><a class="dropdown-item" href="index.php?view=client">Mi Inicio</a></li>
            <li><a class="dropdown-item" href="index.php?view=myproducts">Mis Productos</a></li>
            <li><a class="dropdown-item" href="index.php?view=myprofile">Mi Perfil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Salir</a></li>
          </ul>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<main class="py-5">
  <?php View::load("index"); ?>
</main>

<footer class="mt-auto py-5 border-top">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p class="mb-2"><b>Zurfana</b> &copy; 2026</p>
        <ul class="list-inline mb-0">
          <li class="list-inline-item text-muted">An <a href="http://evilnapsis.com/" class="text-decoration-none">Evilnapsis</a> Production</li>
          <li class="list-inline-item"><a href="http://evilnapsis.com/services/support/" class="text-decoration-none">Soporte</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<script src="admin/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
  $(function () {
    $('[data-bs-toggle="tooltip"]').tooltip();
  });
</script>
</body>
</html>
</body>
</html>