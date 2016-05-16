<?php

$base = new Database();
$con = $base->connect();
$sql = "delete from product_view where product_id=$_GET[id]";
$query = $con->query($sql);


$cat = ProductData::getById($_GET["id"]);
$cat->del();

Core::redir("index.php?view=myproducts");
?>