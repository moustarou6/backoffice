<?php

include_once(__DIR__.'/../utils/ConnexionDB.php');
include_once(__DIR__.'/../utils/Configuration.php');

$user_spaceship_id 	= $_POST['user_spaceship_id'];
$position_X 		= $_POST['position_X'];
$position_Y 		= $_POST['position_Y'];
$position_Z 		= $_POST['position_Z'];
$life_spaceship 	= $_POST['life_spaceship'];


if(isset($user_spaceship_id) && isset($position_X) && isset($position_Y) && isset($position_Z)&& isset($life_spaceship) )
{
	$conf 			= new Configuration();
	$connexion 		= new ConnexionDB($conf->pathBdd,$conf->bddEngineName, $conf->bddEngineLogin, $conf->bddEnginePassword);
	
	$sql = "UPDATE user_spaceship SET position_X = ".$position_X.",position_Y = ".$position_Y.",position_Z = ".$position_Z.", life=".$life_spaceship." WHERE id = ".$user_spaceship_id;
	$connexion->ExecuteSQL($sql);		

	$_tabResult["status"]  = "ok"; 
	$_tabResult["result"] = "ok";
	
}
else
{
	$_tabResult["status"]  = "error"; 
    $_tabResult["result"] = "missing params";
	
}

echo json_encode($_tabResult);

	




?>