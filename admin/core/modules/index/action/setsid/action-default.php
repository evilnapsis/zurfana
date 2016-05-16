<?php

$product = ProductData::getById($_GET["product_id"]);
$product->s_id = $_GET["sid"];
$product->update_sid();

$s= SData::getById($_GET["sid"]);
$user = UserData::getById($product->user_id);

$adminemail = ConfigurationData::getByPreffix("general_main_email")->val; // corregido
$base = ConfigurationData::getByPreffix("general_base")->val; // corregido
$url = $base."?view=producto&id=product_id="$product->id;
$message = '
<meta content="es-mx" http-equiv="Content-Language" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<body>

<p><span class="style3"><strong>Hola, '. utf8_decode($user->name) .'</strong></span></p>
<p>Por medio de este email te informamos que el estado de tu producto <b>'.$product->name.'</b> ha cambiado al estado <b>'.$s->name.'</b>.</p>
<p>Link al producto: <a href="'.$url.'">'.$url.'</a></p>
<p>Si tienes dudas y/o comentarios contacta al administrador.</p>
</body>';

mail("$user->email",
     "Producto #$product->id - Cambio de Estado [$s->name]",
     "$message",
	 "From: $adminemail\nReply-To: $adminemail\nContent-Type: text/html; charset=ISO-8859-1");

//Core::alert("Cambio de estado exitoso!")
Core::redir("./?view=products");


?>