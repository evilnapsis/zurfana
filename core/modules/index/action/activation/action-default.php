<?php

if(isset($_GET["uid"]) && isset($_GET["code"])){

	if($_GET["uid"]!="" && $_GET["code"]!=""){
		$user = UserData::getById($_GET["uid"]);
		if($user->activation_code==$_GET["code"]){
			$user->activate();
			Core::alert("Activacion correcta! Ahora puedes acceder al sistema.");
			Core::redir("./?view=clientaccess");
		}else{			
			Core::alert("Activacion incorrecta!");
			Core::redir("./");
		}

	}else{
			Core::redir("./");
	}
}else{
	Core::redir("./");
}


?>