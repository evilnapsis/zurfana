<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
    if(isset($_SESSION["user_id"]) && !empty($_POST)){
        foreach($_POST as $p => $k){
            ConfigurationData::updateValFromName($p, $k);
        }
        Core::alert("Ajustes actualizados!");
        Core::redir("./?view=settings&opt=general");
    }else{
        Core::redir("./");
    }
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="updatepm"){
    if(isset($_SESSION["user_id"]) && !empty($_POST)){
        foreach($_POST as $p => $k){
            ConfigurationData::updateValFromName($p, $k);
        }
        Core::alert("Ajustes de pago actualizados!");
        Core::redir("./?view=settings&opt=payment");
    }else{
        Core::redir("./");
    }
}
?>
