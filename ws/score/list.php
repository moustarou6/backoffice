<?php

include_once(__DIR__.'/../utils/ConnexionDB.php');
include_once(__DIR__.'/../utils/Configuration.php');

$conf 			= new Configuration();
$connexion 		= new ConnexionDB($conf->pathBdd,$conf->bddEngineName, $conf->bddEngineLogin, $conf->bddEnginePassword);
	
$sql = "SELECT id,login,credit,score  FROM users ORDER BY score DESC";
$result = $connexion->TabResSQL($sql);

foreach ($result as $key => $value) {

	$portal[] = array(
		'id' 				=> $value['id'],
		'login' 			=> $value['login'],
		'credit'			=> $value['credit'],
		'score'				=> $value['score'],
		);
	}	
	
$_tabResult['status'] = "ok";
$_tabResult['result'] = $portal;

echo json_encode($_tabResult);

?>