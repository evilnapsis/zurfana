<?php if(isset($_SESSION["client_id"])):
$client = UserData::getById($_SESSION["client_id"]);
$coin_symbol = ConfigurationData::getByPreffix("general_coin")->val;

?>
<div class="container">
<div class="row">

<div class="col-md-12">
<h3>Bienvenido, <?php echo $client->name." ".$client->lastname; ?></h3>
</div>

</div>
</div>
<?php

$products = ProductData::getAllByUserId($_SESSION["client_id"]);


?>
<div class="container">
<div class="row">
	<div class="col-md-12">
	<h2>Mis Productos</h2>
	<a href="./?view=client" class="btn btn-default">Bandeja de Entrada</a>
	<a href="./?view=myorders" class="btn btn-default">Mis Compras</a>
	<a href="./?view=myproducts" class="btn btn-default">Mis Productos</a>
	<a href="./?view=myquestions" class="btn btn-default">Mis Preguntas</a>
	<a href="./?view=newproduct" class="btn btn-default">Agregar Producto</a>
<?php if(count($products)>0):?>
<table class="table table-bordered">
	<thead>

		<th></th>
		<th>Producto</th>
		<th>Estado</th>
		<th>Fecha</th>
			<th></th>
	</thead>
	<?php foreach($products as $buy):
	$discount = 0;
	?>
	<tr>

		<td>Id #<?php echo $buy->id; ?></td>
		<td><?php echo $buy->name; ?></td>
		<td><?php echo $buy->getS()->name; ?></td>
		<td><?php echo $buy->created_at; ?></td>
		<td>

		<a href="index.php?view=editproduct&product_id=<?php echo $buy->id; ?>" class="btn btn-warning btn-xs">Editar</a>
		<a href="index.php?action=delproduct&id=<?php echo $buy->id; ?>" class="btn btn-danger btn-xs">Eliminar</a>
		</td>
	</tr>

	<?php endforeach; ?>
</table>
<?php else:?>
	<div class="jumbotron">
	<h2>No hay Productos</h2>

	</div>
<?php endif; ?>
	</div>
</div>
</div>



<?php endif; ?>
