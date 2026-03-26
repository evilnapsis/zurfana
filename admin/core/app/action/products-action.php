<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
    $product = new ProductData();
    foreach($_POST as $k => $v){
        $product->$k = $v;
    }
    $alphabeth = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
    $code = "";
    for($i=0; $i<11; $i++){
        $code .= $alphabeth[rand(0,strlen($alphabeth)-1)];
    }
    $product->short_name = $code;

    $handle = new Upload($_FILES['image']);
    if($handle->uploaded){
        $url = "storage/products/";
        $handle->Process($url);
        $product->image = $handle->file_dst_name;
    }
    if(isset($_POST["is_public"]))    { $product->is_public    = 1; } else { $product->is_public    = 0; }
    if(isset($_POST["in_existence"])) { $product->in_existence = 1; } else { $product->in_existence = 0; }
    if(isset($_POST["is_featured"]))  { $product->is_featured  = 1; } else { $product->is_featured  = 0; }

    $product->add();
    Core::alert("Producto agregado!");
    Core::redir("./?view=products&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
    $product = new ProductData();
    foreach($_POST as $k => $v){
        $product->$k = $v;
    }
    $handle = new Upload($_FILES['image']);
    if($handle->uploaded){
        $url = "storage/products/";
        $handle->Process($url);
        $product->image = $handle->file_dst_name;
        $product->update_image();
    }
    if(isset($_POST["is_public"]))    { $product->is_public    = 1; } else { $product->is_public    = 0; }
    if(isset($_POST["in_existence"])) { $product->in_existence = 1; } else { $product->in_existence = 0; }
    if(isset($_POST["is_featured"]))  { $product->is_featured  = 1; } else { $product->is_featured  = 0; }

    $product->update();
    Core::alert("Producto actualizado!");
    Core::redir("./?view=products&opt=edit&id=".$_POST["id"]);
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="setsid"){
    $product = ProductData::getById($_GET["id"]);
    $product->s_id = $_GET["sid"];
    $product->update_sid();

    $s = SData::getById($_GET["sid"]);
    $user = UserData::getById($product->user_id);

    $adminemail = ConfigurationData::getByPreffix("general_main_email")->val;
    $base = ConfigurationData::getByPreffix("general_base")->val;
    $url = $base."?view=producto&id=product_id=".$product->id;
    
    $message = '
    <meta content="es-mx" http-equiv="Content-Language" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <body>
    <p><strong>Hola, '. utf8_decode($user->name) .'</strong></p>
    <p>Por medio de este email te informamos que el estado de tu producto <b>'.$product->name.'</b> ha cambiado al estado <b>'.$s->name.'</b>.</p>
    <p>Link al producto: <a href="'.$url.'">'.$url.'</a></p>
    <p>Si tienes dudas y/o comentarios contacta al administrador.</p>
    </body>';

    if($user && $user->email!=""){
        mail("$user->email",
            "Producto #$product->id - Cambio de Estado [$s->name]",
            "$message",
            "From: $adminemail\nReply-To: $adminemail\nContent-Type: text/html; charset=ISO-8859-1");
    }

    Core::alert("Cambio de estado exitoso!");
    Core::redir("./?view=products&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
    $product = ProductData::getById($_GET["id"]);
    $product->del();
    Core::alert("Producto eliminado!");
    Core::redir("./?view=products&opt=all");
}
?>
