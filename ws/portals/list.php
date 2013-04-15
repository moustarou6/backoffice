<?php

include_once(__DIR__.'/../utils/ConnexionDB.php');
include_once(__DIR__.'/../utils/Configuration.php');

$conf 			= new Configuration();
$connexion 		= new ConnexionDB($conf->pathBdd,$conf->bddEngineName, $conf->bddEngineLogin, $conf->bddEnginePassword);
	
$sql = "SELECT *  FROM portal";
$result = $connexion->TabResSQL($sql);

foreach ($result as $key => $value) {

	$portal[] = array(
		'X'		=> $value['x'],
		'Y'		=> $value['y'],
		'Z'		=> $value['z'],
		'code'	=> $value['code']
		);
	}	

$_tabResult['status'] = "ok";
$_tabResult['result'] = $portal;

echo json_encode($_tabResult);

?>