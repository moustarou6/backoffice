<?php

include_once(__DIR__.'/../utils/ConnexionDB.php');
include_once(__DIR__.'/../utils/Configuration.php');

$user_id 	= $_POST['user_id'];
$credit 	= $_POST['credit'];


if(isset($user_id) && isset($credit))
{
	$conf 			= new Configuration();
	$connexion 		= new ConnexionDB($conf->pathBdd,$conf->bddEngineName, $conf->bddEngineLogin, $conf->bddEnginePassword);
	
	$sql = "UPDATE users SET credit = ".$credit." WHERE id = ".$user_id;
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