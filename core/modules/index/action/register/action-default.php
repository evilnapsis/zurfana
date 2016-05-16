<?php

if(isset($_POST["accept"])){
$c= ClientData::getByEmail($_POST["email"]);
if($c==null){

	$alpha = "abcdefgihjklmnopqrstuvwxyz123456780";
	$activation_code = "";
	for($i=0;$i<10;$i++){
		$activation_code.= $alpha[rand(0,strlen($alpha)-1)];

	}

	$user = new UserData();
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
//	$user->username = $_POST["username"];
	$user->email = $_POST["email"];
	$user->address = $_POST["address"];
	$user->phone = $_POST["phone"];
	$user->activation_code = $activation_code;
	$user->is_admin=0;
	$user->password = sha1(md5($_POST["password"]));
	$u= $user->register();






						function clean_input_4email($value, $check_all_patterns = true)
						{
						 $patterns[0] = '/content-type:/';
						 $patterns[1] = '/to:/';
						 $patterns[2] = '/cc:/';
						 $patterns[3] = '/bcc:/';
						 if ($check_all_patterns)
						 {
						  $patterns[4] = '/\r/';
						  $patterns[5] = '/\n/';
						  $patterns[6] = '/%0a/';
						  $patterns[7] = '/%0d/';
						 }
						 //NOTE: can use str_ireplace as this is case insensitive but only available on PHP version 5.0.
						 return preg_replace($patterns, "", strtolower($value));
						}

						$name = clean_input_4email($_POST["name"]);
						$lastname = clean_input_4email($_POST["lastname"]);
						$email = clean_input_4email($_POST["email"]);
						$address = clean_input_4email($_POST["address"]);
						$phone = clean_input_4email($_POST["phone"]);
//						$message = clean_input_4email($_POST["message"], false);
$adminemail = ConfigurationData::getByPreffix("general_main_email")->val; // corregido
$base = ConfigurationData::getByPreffix("general_base")->val; 
$activation_url = $base."?action=activation&uid=".$u[1]."&code=".$activation_code;
$replyemail = $adminemail;
$success_sent_msg='
<body style="background:#2b2b2b; text-align:center; margin-top:40px">
Registro exitoso.
</body>

';

$replymessage = '
<meta content="es-mx" http-equiv="Content-Language" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<body>

<p><span class="style3"><strong>Estimado '. utf8_decode($name) .'</strong></span></p>
<p>Gracias por registrarte el el sistema de tienda en linea.</p>
<p>Para activar tu cuenta debes dar click al siguiente link, o copiar/pegar la direccion en la barra de tu navegador.</p>
<p><a href="'.$activation_url.'">'.$activation_url.'</a></p>
<p>Tan pronto como actives tu cuenta podras tener acceso al sistema.</p>
</body>';



$themessage = '
<html>
<meta content="es-mx" http-equiv="Content-Language" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<body>
<table align="center" cellspacing="4" class="style2" style="width: 700">
	<tr>
		<td class="style5" style="width: 204px; height: 10;" valign="top"><strong>
		Nombre del Cliente:</strong></td>
		<td class="style5" style="width: 4px; height: 10;" valign="top">&nbsp;</td>
		<td class="style3" style="width: 550;" valign="top">'. utf8_decode($name." ".$lastname) .'</td>
	</tr>
	<tr>
		<td class="style5" style="height: 1;" valign="top" colspan="3">
		<hr class="style28" style="height: 1; width: 98%" /></td>
	</tr>
	<tr>
		<td class="style5" style="width: 204px; height: 10;" valign="top"><strong>
		Correo Electronico:</strong></td>
		<td class="style5" style="width: 4px; height: 10;" valign="top">&nbsp;</td>
		<td class="style3" style="width: 550;" valign="top">'. $email .'</td>
	</tr>
	<tr>
		<td class="style5" style="height: 1;" valign="top" colspan="3">
		<hr class="style28" style="height: 1; width: 98%" /></td>
	</tr>
	<tr>
		<td class="style5" style="width: 204px; height: 10;" valign="top"><strong>
		Direccion:</strong></td>
		<td class="style5" style="width: 4px; height: 10;" valign="top">&nbsp;</td>
		<td class="style3" style="width: 550;" valign="top">'. utf8_decode($address) .'</td>
	</tr>
	<tr>
		<td class="style5" style="height: 1;" valign="top" colspan="3">
		<hr class="style28" style="height: 1; width: 98%" /></td>
	</tr>
	<tr>
		<td class="style5" style="width: 204px; height: 10;" valign="top"><strong>
		Telefono:</strong></td>
		<td class="style5" style="width: 4px; height: 10;" valign="top">&nbsp;</td>
		<td class="style3" style="width: 550;" valign="top">'. $phone .'</td>
	</tr>
	
</table>

</body> 
</html>  ';

mail("$replyemail",
     "Katana - Nuevo registro",
     "$themessage",
	 "From: $email\nReply-To: $email\nContent-Type: text/html; charset=ISO-8859-1");

mail("$email",
     "Katana - Registro Exitoso",
     "$replymessage",
	 "From: $replyemail\nReply-To: $replyemail\nContent-Type: text/html; charset=ISO-8859-1");
echo $success_sent_msg;



Core::redir("index.php?view=clientaccess");
}else{
Core::alert("Ya existe un usuario registrado con esta direccion email.");
Core::redir("./?view=register");

}
}
?>