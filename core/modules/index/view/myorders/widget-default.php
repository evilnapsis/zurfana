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

$products = ContactData::getOrdersByUserId($_SESSION["client_id"]);


?>
<div class="container">
<div class="row">
	<div class="col-md-12">
	<h2>Mis Compras</h2>
	<a href="./?view=client" class="btn btn-default">Bandeja de Entrada</a>
	<a href="./?view=myorders" class="btn btn-default">Mis Compras</a>
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
		<th></th>
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
<a href="" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal">Responder</a>
<!--			<a href="./?action=msgs&opt=del&id=<?php echo $buy->id; ?>" class="btn btn-danger btn-xs">Eliminar</a> -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Responder ...</h4>
      </div>
      <div class="modal-body">
<form class="form-horizontal" role="form" method="post" action="index.php?action=productcontact3&msgid=<?php echo $buy->id; ?>">

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">*Mensaje</label>
    <div class="col-lg-10">
      <textarea required name="message" class="form-control" id="inputEmail1" placeholder="Mensaje" rows="5"></textarea>
    </div>
  </div>
  <input type="hidden" name="product_id" value="<?php echo $buy->product_id; ?>">


  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-block btn-default">Responder</button>
    </div>
  </div>
</form>
      </div>
    </div>
  </div>
</div>

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
