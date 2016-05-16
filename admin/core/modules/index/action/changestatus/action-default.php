<?php

if(isset($_SESSION["admin_id"])){

$buy =  BuyData::getById($_GET["id"]);
$buy->status_id = $_GET["status"];
$buy->change_status();

$h = new HistoryData();
$h->buy_id = $_GET["id"];
$h->status_id=$_GET["status"];
$h->add();

/////////////////////////////////// emailing
$adminemail = 	$paypal_business = ConfigurationData::getByPreffix("general_main_email")->val;
$client = ClientData::getById($buy->client_id);
$status = StatusData::getById($_GET["status"]);
$replymessage = '
<html>
<meta content="es-mx" http-equiv="Content-Language" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>
<h2>Tienda en Linea</h2>
<h3>Notificacion de Estado de Compra</h3>
<p><span class="style3"><strong>Estimado '.( $client->getFullname()) .':</strong></span></p>
<p>Se te notifica que tu compra con folio <b>#'.$buy->id.'</b> cambio de estado a '.$status->name.' </b>.</p>
<p>Muchas gracias.</p>
<hr>
<p>Powered By <a href="http://evilnapsis.com/product/katana/" target="_blank"> Katana PRO</a></p>
</body>
</html>
';

mail("$client->email",
     "Compra #$buy->id - Notificacion",
     "$replymessage",
	 "From: $adminemail\nReply-To: $adminemail\nContent-Type: text/html; charset=ISO-8859-1");

///////////////////////////////////

Core::redir("index.php?view=sells");
}
?>