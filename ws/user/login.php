<?php

include_once(__DIR__.'/../utils/ConnexionDB.php');
include_once(__DIR__.'/../utils/Configuration.php');

$login 		= $_POST['login'];
$password 	= $_POST['password'];

if(isset($password) && isset($login))
{
	$conf 			= new Configuration();
	$connexion 		= new ConnexionDB($conf->pathBdd,$conf->bddEngineName, $conf->bddEngineLogin, $conf->bddEnginePassword);
		
	$sql = "SELECT COUNT(*) as count FROM users WHERE login = '".$login."' AND password = '".$password."'";
	$result = $connexion->TabResSQL($sql);
	
	if($result[0]['count']> 0 )
	{
		$_tabResult["status"]  = "ok"; 
	    $_tabResult["result"] = "ok";
	}
	else
	{
		$_tabResult["status"]  = "error"; 
    	$_tabResult["result"] = "error login";
	}	
}
else
{
	$_tabResult["status"]  = "error"; 
    $_tabResult["result"] = "missing params";
	
}

echo json_encode($_tabResult);

	




?>