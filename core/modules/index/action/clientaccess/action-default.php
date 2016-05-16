<?php


// print_r($_POST);
$users = UserData::getByEmail($_POST["email"]);
$found = false;
$no_active=false;
// print_r($user);

foreach ($users as $user) {

	if(sha1(md5($_POST["password"]))==$user->password){
		if($user->is_active){
		$_SESSION["client_id"]=$user->id;
		$found=true;
		}else{
		$found=true;
			$no_active=true;
		}
	}
}

if($found &&$no_active){
	Core::alert("Cuenta inactiva");
	Core::redir("index.php?view=clientaccess");
}

if($found){
	Core::redir("index.php?view=client");
}else{
	Core::redir("index.php?view=clientaccess");
}

?>

