<?php
	header('Content-Type: application/json');

	
	$_pathSctipt	= "http://localhost/unity/ws/";
	$_delimiter 	= "index.php/";
	$_tabPath		= explode($_delimiter, getPathUrl());
	
	$_action		= "noRoute";
	
	if(count($_tabPath) > 1)
	{
		$_action		= $_tabPath[1];
	}
	
	switch ($_action) 
	{
		case 'user/add' :
		case 'user/add/' :
			rewrite('./user/add.php');
			break;

		case 'user/login' :
		case 'user/login/' :
			rewrite('./user/login.php');
			break;

		case 'user/update' :
		case 'user/update/' :
			rewrite('./user/update.php');
			break;

		case 'user/buy' :
		case 'user/buy/' :
			rewrite('./user/buy.php');
			break;


		case 'portal/list' :
		case 'portal/list/' :
			rewrite('./portals/list.php');
			break;

		case 'spaceship/list' :
		case 'spaceship/list/' :
			rewrite('./spaceship/list.php');
			break;
		
		case 'score/list' :
		case 'score/list/' :
			rewrite('./score/list.php');
			break;
			
		case 'spaceship/change' :
		case 'spaceship/change/' :
			rewrite('./spaceship/change.php');
			break;
	}
	
	
	
	function rewrite($__path)
	{
		include ($__path);
	}


	/**
	* Permet de transformer les variables POST en GET
	*
	*/
	function getVarGETfomVarPOST()
	{
		$_stringGET		= "";

		$_i = 0;
		foreach ($_POST as $var => $value) 
		{ 
		    if($_i == 0)
		    {
			    $_stringGET = "?".$var."=".$value;
		    }
		    else
		    {
			    $_stringGET = $_stringGET."&".$var."=".$value;
		    }
		    $_i ++;
		} 

		return $_stringGET;
	}


	/**
	* On récupère l'adresse de notre page
	*
	**/
    function getPathUrl() 
    {
		 $pageURL = 'http';
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") 
		 {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } 
		 else 
		 {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
	}

?>
