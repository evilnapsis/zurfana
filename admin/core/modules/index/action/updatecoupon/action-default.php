<?php
/**
* Editar cupon
* @author evilnapsis
**/
if(!empty($_POST)){
$cup = CouponData::getById($_POST["id"]);
$cup->name = $_POST["name"];
$cup->description = $_POST["description"];
$cup->val = $_POST["val"];
$cup->product_id = $_POST["product_id"]!=""?$_POST["product_id"]:"NULL";
$cup->is_multiple = isset($_POST["is_multiple"])?1:0;
$cup->start_at = $_POST["start_at"];
$cup->finish_at = $_POST["finish_at"];
$cup->is_active = isset($_POST["is_active"])?1:0;
$cup->update();
Core::alert("Actualizado Exitosamente!");
Core::redir("./?view=editcoupon&id=$_POST[id]");
}
?>