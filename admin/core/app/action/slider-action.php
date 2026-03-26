<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
    $slide = new SlideData();
    foreach($_POST as $k => $v){
        $slide->$k = $v;
    }
    $handle = new Upload($_FILES['image']);
    if($handle->uploaded){
        $url = "storage/slides/";
        $handle->Process($url);
        $slide->image = $handle->file_dst_name;
    }
    if(isset($_POST["is_public"])){ $slide->is_public = 1; }else{ $slide->is_public = 0; }
    $slide->add();
    Core::alert("Slide agregado!");
    Core::redir("./?view=slider&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
    $slide = new SlideData();
    foreach($_POST as $k => $v){
        $slide->$k = $v;
    }
    $handle = new Upload($_FILES['image']);
    if($handle->uploaded){
        $url = "storage/slides/";
        $handle->Process($url);
        $slide->image = $handle->file_dst_name;
        $slide->update_image();
    }
    if(isset($_POST["is_public"])){ $slide->is_public = 1; }else{ $slide->is_public = 0; }
    $slide->update();
    Core::alert("Slide actualizado!");
    Core::redir("./?view=slider&opt=edit&id=".$_POST["id"]);
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
    $slide = SlideData::getById($_GET["id"]);
    $slide->del();
    Core::alert("Slide eliminado!");
    Core::redir("./?view=slider&opt=all");
}
?>
