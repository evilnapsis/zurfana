<?php if(isset($_SESSION["client_id"])):
$client = UserData::getById($_SESSION["client_id"]);
$coin_symbol = ConfigurationData::getByPreffix("general_coin")->val;

?>
<div class="container">
<div class="row">

<!-- <div class="col-md-12">
<h3>Bienvenido, <?php echo $client->name." ".$client->lastname; ?></h3>
</div>
-->
</div>
</div>
<?php

$products = ContactData::getAnswersByUserId($_SESSION["client_id"]);


?>
<div class="container">
<div class="row">
	<div class="col-md-12">
	<h2>Mis Respuestas</h2>
	<a href="./?view=client" class="btn btn-default">Bandeja de Entrada</a>
	<a href="./?view=myorders" class="btn btn-default">Mis Compras</a>
	<a href="./?view=myanswers" class="btn btn-default">Mis Respuestas</a>
	<a href="./?view=myproducts" class="btn btn-default">Mis Productos</a>
	<a href="./?view=myquestions" class="btn btn-default">Mis Preguntas</a>
	<a href="./?view=newproduct" class="btn btn-default">Agregar Producto</a>
<?php if(count($products)>0):?>
<table class="table table-bordered">
	<thead>
	<th></th>
		<th></th>
		<th>Nombre</th>
		<th>Correo</th>
		<th>Mensaje</th>
		<th>Fecha</th>
		<th>Producto</th>
	</thead>
	<?php foreach($products as $buy):
	$discount = 0;
	?>
	<tr>
		<td></td>
		<td>Id #<?php echo $buy->product_id; ?></td>
		<td><?php echo $buy->fullname; ?></td>
		<td><?php echo $buy->email; ?></td>
		<td><?php echo $buy->message; ?></td>
		<td><?php echo $buy->created_at; ?></td>
		<td>
		<?php 
		$p = ProductData::getById($buy->product_id);
		echo $p->name; 
		?>

		</td>
	</tr>

	<?php endforeach; ?>
</table>
<?php else:?>
	<div class="jumbotron">
	<h2>No hay Mensajes</h2>

	</div>
<?php endif; ?>
	</div>
</div>
</div>



<?php endif; ?>
