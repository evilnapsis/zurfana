<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
    if(!empty($_POST)){
        $cat = new CategoryData();
        $cat->name       = $_POST["name"];
        $cat->short_name = $_POST["short_name"];
        if(isset($_POST["is_active"])){ $cat->is_active = 1; }else{ $cat->is_active = 0; }
        $cat->add();
        Core::alert("Categoría agregada!");
        Core::redir("./?view=categories&opt=all");
    }
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
    if(!empty($_POST)){
        $cat = CategoryData::getById($_POST["id"]);
        $cat->name       = $_POST["name"];
        $cat->short_name = $_POST["short_name"];
        if(isset($_POST["is_active"])){ $cat->is_active = 1; }else{ $cat->is_active = 0; }
        $cat->update();
        Core::alert("Categoría actualizada!");
        Core::redir("./?view=categories&opt=all");
    }
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
    $cat = CategoryData::getById($_GET["id"]);
    $cat->del();
    Core::alert("Categoría eliminada!");
    Core::redir("./?view=categories&opt=all");
}
?>
