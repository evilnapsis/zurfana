<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
    if(count($_POST)>0){
        $is_admin = 0;
        if(isset($_POST["is_admin"])){ $is_admin = 1; }
        $user = new UserData();
        $user->name     = $_POST["name"];
        $user->lastname = $_POST["lastname"];
        $user->email    = $_POST["email"];
        $user->is_admin = $is_admin;
        $user->password = sha1(md5($_POST["password"]));
        $user->add();
        Core::alert("Usuario agregado!");
        Core::redir("./?view=users&opt=all");
    }
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
    if(count($_POST)>0){
        $is_admin  = 0;
        if(isset($_POST["is_admin"])){ $is_admin = 1; }
        $is_active = 0;
        if(isset($_POST["is_active"])){ $is_active = 1; }
        $user = UserData::getById($_POST["user_id"]);
        $user->name     = $_POST["name"];
        $user->lastname = $_POST["lastname"];
        $user->email    = $_POST["email"];
        $user->is_admin  = $is_admin;
        $user->is_active = $is_active;
        $user->update();
        if($_POST["password"] != ""){
            $user->password = sha1(md5($_POST["password"]));
            $user->update_passwd();
        }
        Core::alert("Usuario actualizado!");
        Core::redir("./?view=users&opt=all");
    }
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
    $user = UserData::getById($_GET["id"]);
    $user->del();
    Core::alert("Usuario eliminado!");
    Core::redir("./?view=users&opt=all");
}
?>