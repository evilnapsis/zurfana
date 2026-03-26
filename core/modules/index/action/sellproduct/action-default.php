<?php
if(isset($_SESSION["client_id"])){
	$product = ProductData::getById($_POST["product_id"]);
	if($product && $product->user_id == $_SESSION["client_id"]){
		$product->client_id = $_POST["client_id"];
		$product->sell();
		Core::alert("¡Producto marcado como vendido!");
		Core::redir("./?view=myproducts");
	}else{
		Core::redir("./");
	}
}else{
	Core::redir("./");
}
?>
