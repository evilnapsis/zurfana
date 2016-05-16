<?php
// print_r($_POST);
$product =  new ProductData();
foreach ($_POST as $k => $v) {
	$product->$k = $v;
	# code...
}

////////////////////////////////////// / / / / / / / / / / / / / / / / / / / / / / / / /
$handle = new Upload($_FILES['image']);
if ($handle->uploaded) {
	$url="admin/storage/products/";
	$handle->Process($url);
    $product->image = $handle->file_dst_name;
    $product->update_image();
}
$handle = new Upload($_FILES['image2']);
if ($handle->uploaded) {
	$url="admin/storage/products/";
	$handle->Process($url);
    $product->image2 = $handle->file_dst_name;
    $product->update_image2();
}
$handle = new Upload($_FILES['image3']);
if ($handle->uploaded) {
	$url="admin/storage/products/";
	$handle->Process($url);
    $product->image3 = $handle->file_dst_name;
    $product->update_image3();
}
$handle = new Upload($_FILES['image4']);
if ($handle->uploaded) {
	$url="admin/storage/products/";
	$handle->Process($url);
    $product->image4 = $handle->file_dst_name;
    $product->update_image4();
}

////////////////////////////////////// / / / / / / / / / / / / / / / / / / / / / / / / /

if(isset($_POST["is_public"])) { $product->is_public=1; }else{ $product->is_public=0; }
if(isset($_POST["in_existence"])) { $product->in_existence=1; }else{ $product->in_existence=0; }
if(isset($_POST["is_featured"])) { $product->is_featured=1; }else{ $product->is_featured=0; }

// $product->name = $_POST["name"];
 $product->update();
$_SESSION["product_updated"]= 1;
Core::redir("index.php?view=editproduct&product_id=".$_POST["id"]);

?>