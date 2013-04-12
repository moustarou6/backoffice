<?php

include_once(__DIR__.'/../utils/ConnexionDB.php');
include_once(__DIR__.'/../utils/Configuration.php');


class User 
{

	public function __construct()
	{
		$conf 					= new Configuration();
		$this->connexion 		= new ConnexionDB($conf->pathBdd,$conf->bddShareName, $conf->bddShareLogin, $conf->bddSharePassword);
	}

	public function AddUser($login, $email, $password)
	{
		$sql = "INSERT INTO user (login,password,email) VALUES ('".$login."','".$password."','".$email."')";

		
	}


}


?>