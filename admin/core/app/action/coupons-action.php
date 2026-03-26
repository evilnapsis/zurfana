<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
    if(!empty($_POST)){
        $cup = new CouponData();
        $cup->name        = $_POST["name"];
        $cup->description = $_POST["description"];
        $cup->val         = $_POST["val"];
        $cup->product_id  = $_POST["product_id"] != "" ? $_POST["product_id"] : "NULL";
        $cup->is_multiple = isset($_POST["is_multiple"]) ? 1 : 0;
        $cup->start_at    = $_POST["start_at"];
        $cup->finish_at   = $_POST["finish_at"];
        $cup->is_active   = isset($_POST["is_active"]) ? 1 : 0;
        $cup->add();
        Core::alert("Cupón agregado!");
        Core::redir("./?view=coupons&opt=all");
    }
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
    if(!empty($_POST)){
        $cup = CouponData::getById($_POST["id"]);
        $cup->name        = $_POST["name"];
        $cup->description = $_POST["description"];
        $cup->val         = $_POST["val"];
        $cup->product_id  = $_POST["product_id"] != "" ? $_POST["product_id"] : "NULL";
        $cup->is_multiple = isset($_POST["is_multiple"]) ? 1 : 0;
        $cup->start_at    = $_POST["start_at"];
        $cup->finish_at   = $_POST["finish_at"];
        $cup->is_active   = isset($_POST["is_active"]) ? 1 : 0;
        $cup->update();
        Core::alert("Cupón actualizado!");
        Core::redir("./?view=coupons&opt=edit&id=".$_POST["id"]);
    }
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
    $cup = CouponData::getById($_GET["id"]);
    $cup->del();
    Core::alert("Cupón eliminado!");
    Core::redir("./?view=coupons&opt=all");
}
?>
