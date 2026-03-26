<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
    if(!empty($_POST)){
        $client = new ClientData();
        $client->name     = $_POST["name"];
        $client->lastname = $_POST["lastname"];
        $client->email    = $_POST["email"];
        $client->address  = $_POST["address"];
        @$client->password = crypt($_POST["password"]);
        $client->phone    = $_POST["phone"];
        $client->add();
        Core::alert("Cliente agregado!");
        Core::redir("./?view=clients&opt=all");
    }
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
    if(!empty($_POST)){
        $client = ClientData::getById($_POST["id"]);
        $client->name     = $_POST["name"];
        $client->lastname = $_POST["lastname"];
        $client->email    = $_POST["email"];
        $client->address  = $_POST["address"];
        $client->phone    = $_POST["phone"];
        $client->update();
        if($_POST["password"] != ""){
            @$client->password = crypt($_POST["password"]);
            $client->update_passwd();
        }
        Core::alert("Cliente actualizado!");
        Core::redir("./?view=clients&opt=all");
    }
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
    $client = ClientData::getById($_GET["id"]);
    $client->del();
    Core::alert("Cliente eliminado!");
    Core::redir("./?view=clients&opt=all");
}
?>
