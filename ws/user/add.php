<?php

include_once(__DIR__.'/../utils/ConnexionDB.php');
include_once(__DIR__.'/../utils/Configuration.php');
require_once dirname(__FILE__).'/../utils/mail/swiftMailer/lib/swift_required.php';
include_once(__DIR__.'/../utils/mail/twig/lib/Twig/Autoloader.php');


$login 		= $_POST['login'];
$password 	= $_POST['password'];
$email 		= $_POST['email'];

/*$login 			= "mikda";
$email			= "mickael.hamour@gmail.com";
$password       = "mika123";
*/
if(isset($login) && isset($password) && isset($email))
{
	$conf 			= new Configuration();
	$connexion 		= new ConnexionDB($conf->pathBdd,$conf->bddEngineName, $conf->bddEngineLogin, $conf->bddEnginePassword);
	
	$sql = "SELECT COUNT(*) as count FROM users WHERE login = '".$login."' AND password = '".md5($password)."'";
	$result = $connexion->TabResSQL($sql);
	
	if($result[0]['count'] == 0 )
	{
		$sql = "INSERT INTO users (login,password,email,credit) VALUES ('".$login."','".md5($password)."','".$email."',300)";
		$connexion->ExecuteSQL($sql);

		/*$subject 	= "Game";
		$from 		= "game@appiswap.com";
		$extra = array(
			'login'		=>$login,
			'email'		=> $email,
			'credit'	=> '300',
			'password' 	=> $password
			);


		$transport = Swift_SmtpTransport::newInstance($conf->smtpName)
        	->setUsername($conf->smtpLogin)
            ->setPassword($conf->smtpPaswword);

        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../utils/mail/Templates/'); // Dossier contenant les templates
        $twig 	= new Twig_Environment($loader, array(
          'cache' => false
        ));

		$mailer = Swift_Mailer::newInstance($transport);
        $message = Swift_Message::newInstance();
        $message->setSubject($subject);
        $message->setFrom(array($from));
        $message->setTo($email);
        $message->setBody(' ');       
    	$message->addPart(html_entity_decode($twig->render('default.html', $extra)),'text/html');
                
            
        $headers = $message->getHeaders();
	   
	    $type = $message->getHeaders()->get('Content-Type');
		$type->setValue('text/html');
		$type->setParameter('charset', 'utf-8');
	   
	    $result = $mailer->send($message);	
	*/
		
		$_tabResult["status"] = "ok"; 
    	$_tabResult["result"] = "ok";

	}
	else
	{
		$_tabResult["status"] = "error"; 
    	$_tabResult["result"] = "user exist";
	}	
}
else
{
	$_tabResult["status"] = "error"; 
    $_tabResult["result"] = "missing params";
	
}

echo json_encode($_tabResult);

	




?>