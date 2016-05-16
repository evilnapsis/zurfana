<?php
$msg = ContactData::getById($_GET["msgid"]);

$client = UserData::getById($_SESSION["client_id"]);
$product=ProductData::getById($msg->product_id);
$user = UserData::getById($product->user_id);

$product = ProductData::getById($_POST["product_id"]);
$user = $product->getUser();

$contact = new ContactData();
$contact->fullname = "";
$contact->email = "";
$contact->message = $_POST["message"];
$contact->product_id = $msg->product_id; //["product_id"];
$contact->user_id = $msg->user_id;// $_SESSION["client_id"];
$contact->add();

///////////// emailing ///////////////////////////////////////////
/*
$replymessage = '
<meta content="es-mx" http-equiv="Content-Language" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<body>
<p><span class="style3"><strong>Estimado '. utf8_decode($client->name." ".$client->lastname) .'</strong></span></p>
<p>Gracias por contactarnos.</p>
</body>';
*/


$themessage = '
<html>
<meta content="es-mx" http-equiv="Content-Language" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<body>
<table align="center" cellspacing="4" class="style2" style="width: 700">
	<tr>
		<td class="style5" style="width: 204px; height: 10;" valign="top"><strong>
		Producto:</strong></td>
		<td class="style5" style="width: 4px; height: 10;" valign="top">&nbsp;</td>
		<td class="style3" style="width: 550;" valign="top">#'. $product->id." - ".utf8_decode($product->name) .'</td>
	</tr>

	<tr>
		<td class="style5" style="height: 1;" valign="top" colspan="3">
		<hr class="style28" style="height: 1; width: 98%" /></td>
	</tr>
	<tr>
		<td class="style5" style="width: 204px; height: 10;" valign="top"><strong>
		Mensaje:</strong></td>
		<td class="style5" style="width: 4px; height: 10;" valign="top">&nbsp;</td>
		<td class="style3" style="width: 550;" valign="top">'. utf8_decode($_POST["message"]) .'</td>
	</tr>
	
</table>

</body> 
</html>  ';

mail("$user->email",
     "[Katana PRO] - Contacto - $product->name",
     "$themessage",
	 "From: $client->email\nReply-To: $client->email\nContent-Type: text/html; charset=ISO-8859-1");
/*
mail("$client->email",
     "[Katana PRO]- Contacto - #$product->id $product->name",
     "$replymessage",
	 "From: $user->email\nReply-To: $user->email\nContent-Type: text/html; charset=ISO-8859-1");
*/
//////////////////////////////////////////////////////////////////

Core::redir("./?view=myorders");

?>