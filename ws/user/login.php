<?php

include_once(__DIR__.'/../utils/ConnexionDB.php');
include_once(__DIR__.'/../utils/Configuration.php');

$login 		= $_POST['login'];
$password 	= $_POST['password'];
$login = "mikda";
$password = "mika123";

if(isset($password) && isset($login))
{
	$conf 			= new Configuration();
	$connexion 		= new ConnexionDB($conf->pathBdd,$conf->bddEngineName, $conf->bddEngineLogin, $conf->bddEnginePassword);
		
	$sql = "SELECT *  FROM users WHERE login = '".$login."' AND password = '".md5($password)."'";
	$resultUser = $connexion->TabResSQL($sql);	
	if(count($resultUser)> 0 )
	{
		$user = array(
			'id'		=> $resultUser[0]['id'],
			'credit' 	=> $resultUser[0]['credit'],
			'login'		=> $resultUser[0]['login']
		);

		$sql = "SELECT user_spaceship.id as user_spaceship_id, spaceship.path as path,spaceship.name as name, spaceship.power as power, user_spaceship.life,user_spaceship.position_X,user_spaceship.position_Y,user_spaceship.position_Z 
		FROM user_spaceship as user_spaceship 
		INNER JOIN spaceship as spaceship
		ON user_spaceship.spaceship_id = spaceship.id
		WHERE user_spaceship.user_id=".$resultUser[0]['id'];
		
		$result = $connexion->TabResSQL($sql);		
		
		
		foreach ($result as $key => $value) {
			$spaceship[] = array(
				'id' => $value['user_spaceship_id'],
				'path' 	=> $value['path'],
				'name' 	=> $value['name'],
				'power'	=> $value['power'],
				'life' 	=> $value['life'],
				'position_X'	 	=> $value['position_X'],
				'position_Y'	 	=> $value['position_Y'],
				'position_Z'	 	=> $value['position_Z'],
				);
		}

		$_tabResult["status"]  = "ok"; 
	    $_tabResult["result"] = array(
	    	'listSpaceships' => $spaceship,
	    	'user' => $user
	    	);
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