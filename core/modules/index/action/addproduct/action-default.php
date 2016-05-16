<?php
// print_r($_POST);
$client = UserData::getById($_SESSION["client_id"]);
$product =  new ProductData();
foreach ($_POST as $k => $v) {
	$product->$k = $v;
	# code...
}
$alphabeth ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
$code = "";
for($i=0;$i<11;$i++){
    $code .= $alphabeth[rand(0,strlen($alphabeth)-1)];
}
        $product->short_name= $code;
        $product->user_id = $_SESSION["client_id"];


    		$handle = new Upload($_FILES['image']);
        	if ($handle->uploaded) {
        		$url="admin/storage/products/";
            	$handle->Process($url);
                $product->image = $handle->file_dst_name;
    		}
            $handle = new Upload($_FILES['image2']);
            if ($handle->uploaded) {
                $url="admin/storage/products/";
                $handle->Process($url);
                $product->image2 = $handle->file_dst_name;
            }
            $handle = new Upload($_FILES['image3']);
            if ($handle->uploaded) {
                $url="admin/storage/products/";
                $handle->Process($url);
                $product->image3 = $handle->file_dst_name;
            }
            $handle = new Upload($_FILES['image4']);
            if ($handle->uploaded) {
                $url="admin/storage/products/";
                $handle->Process($url);
                $product->image4 = $handle->file_dst_name;
            }

if(isset($_POST["is_public"])) { $product->is_public=1; }else{ $product->is_public=0; }
if(isset($_POST["in_existence"])) { $product->in_existence=1; }else{ $product->in_existence=0; }
if(isset($_POST["is_featured"])) { $product->is_featured=1; }else{ $product->is_featured=0; }

// $product->name = $_POST["name"];

$p= $product->add();



//////////////////////////////////////////////////////////////////////////
$adminemail = ConfigurationData::getByPreffix("general_main_email")->val; // corregido

$message = '
<meta content="es-mx" http-equiv="Content-Language" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<body>

<p><span class="style3"><strong>Hola Administrador, se ha agregado un nuevo producto, en espera de aprobacion.</strong></span></p>
<h3>Datos</h3>
<table border="1">
<tr>
<td>Fecha del servidor</td>
<td>'.date("D d-M-Y h:i:s").'</td>
</tr>
<tr>
<td>Id del publicador</td>
<td>'.$client->id.'</td>
</tr>
<tr>
<td>Nombre del publicador</td>
<td>'.$client->name." ".$client->lastname.'</td>
</tr>
<tr>
<td>Email del publicador</td>
<td>'.$client->email.'</td>
</tr>

<tr>
<td>Id</td>
<td>'.$p[1].'</td>
</tr>

<tr>
<td>Nombre del producto</td>
<td>'.$product->name.'</td>
</tr>
<tr>
<td>Comentarios del producto</td>
<td>'.$product->comments.'</td>
</tr>
<tr>
<td>Categoria del producto</td>
<td>'.CategoryData::getById($product->category_id)->name.'</td>
</tr>
<tr>
<td>Destacado</td>
<td>'.($product->is_featured==1?"SI":"NO").'</td>
</tr>
</table>

<p>Saludos, Atte. El Sistema.</p>
</body>';

mail("$adminemail",
     "Nuevo Producto - Producto Id #$p[1]",
     "$message",
     "From: $client->email\nReply-To: $client->email\nContent-Type: text/html; charset=ISO-8859-1");
//////////////////////////////////////////////////////////////////////////

Core::redir("index.php?view=myproducts");

?>