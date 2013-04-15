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
		
	$sql = "SELECT COUNT(*) as count FROM users WHERE login = '".$login."' AND password = '".md5($password)."'";
	$result = $connexion->TabResSQL($sql);
	
	if($result[0]['count']> 0 )
	{

		$sql = "SELECT users.id as user_id, user_spaceship.id as user_spaceship_id, spaceship.path as path,spaceship.name as name, spaceship.power as power, user_spaceship.life,user_spaceship.position_X,user_spaceship.position_Y,user_spaceship.position_Z 
		FROM users as users 
		INNER JOIN user_spaceship as user_spaceship 
		ON user_spaceship.user_id = users.id 
		INNER JOIN spaceship as spaceship
		ON user_spaceship.spaceship_id = spaceship.id
		WHERE login = '".$login."' AND password = '".md5($password)."'";
		
		$result = $connexion->TabResSQL($sql);		

		foreach ($result as $key => $value) {
			$spaceship = array(
				'user_id'		 	=> $value['user_id'],
				'user_spaceship_id' => $value['user_spaceship_id'],
				'path_spaceship' 	=> $value['path'],
				'name_spaceship' 	=> $value['name'],
				'power_spaceship'	=> $value['power'],
				'life_spaceship' 	=> $value['life'],
				'position_X'	 	=> $value['position_X'],
				'position_Y'	 	=> $value['position_Y'],
				'position_Z'	 	=> $value['position_Z'],
				);
		}

		$_tabResult["status"]  = "ok"; 
	    $_tabResult["result"] = array(
	    	'listSpaceshipt' => $spaceship,
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