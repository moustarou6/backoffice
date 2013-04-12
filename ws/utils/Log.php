<?php

 include_once(__DIR__.'/ConnexionDB.php');
 include_once(__DIR__.'/Configuration.php');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Log
 *
 * @author nono
 */
class Log 
{
    public function __construct() 
    {
        
    }

    public function addLog($__message)
    {
        $filename = date('j').'-'.date('n').'-'.date('Y').'.txt';
        $pathFile = "./";
        $fileLog = fopen( $pathFile.$filename, "a+" );
        $logTime = date('H').'::'.date('i').'::'.date('s').'::';
        fwrite($fileLog,$logTime.$__message." \r\n");
        fclose($fileLog);
    }
}

?>
