<?php

include_once(__DIR__.'/../utils/ConnexionDB.php');
include_once(__DIR__.'/../utils/Configuration.php');

$conf 			= new Configuration();
$connexion 		= new ConnexionDB($conf->pathBdd,$conf->bddEngineName, $conf->bddEngineLogin, $conf->bddEnginePassword);
	
$sql = "SELECT *  FROM spaceship";
$result = $connexion->TabResSQL($sql);

foreach ($result as $key => $value) {

	$portal[] = array(
		'id' 		=> $value['id'],
		'name'		=> $value['name'],
		'path'		=> $value['path'],
		'price'		=> $value['price'],
		'module_limit'	=> $value['construct_time'],
		'power'	=> $value['power']
		
		);
	}	

$_tabResult['status'] = "ok";
$_tabResult['result'] = $portal;

echo json_encode($_tabResult);

?>