<?php

include_once(__DIR__.'/../utils/ConnexionDB.php');
include_once(__DIR__.'/../utils/Configuration.php');

$user_spaceship_id 	= $_POST['user_spaceship_id'];
$spaceship_id 		= $_POST['spaceship_id'];

if(isset($user_spaceship_id) && isset($spaceship_id))
{
	$conf 			= new Configuration();
	$connexion 		= new ConnexionDB($conf->pathBdd,$conf->bddEngineName, $conf->bddEngineLogin, $conf->bddEnginePassword);
		
	$sql = "UPDATE user_spaceship SET spaceship_id =".$spaceship_id." WHERE id = ".$user_spaceship_id;
	$connexion->ExecuteSQL($sql);
	
	$_tabResult['status'] = "ok";
	$_tabResult['result'] = "ok";
}
else
{
	$_tabResult['status'] = "error";
	$_tabResult['result'] = "missing params";
}

echo json_encode($_tabResult);

?>