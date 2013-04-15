<?php



/**
 * Description of Configuration
 *
 * @author nono
 */
class Configuration 
{

    // General
    public $pathBdd         = "localhost";
    public $pathMysqlDump   = "C:/wamp/bin/mysql/mysql5.1.41/bin/mysqldump";
    //public $pathMysqlDump   = "mysqldump";
    public $pathMysql       = "mysql";
    

    // Box BDD
    public $bddEngineName      = "engine";
    public $bddEngineLogin     = "planetProjet";
    public $bddEnginePassword  = "mika123";

    
        // SMTP
    public $smtpName          = 'appiswap.com';
    public $smtpLogin         = 'contact@appiswap.com';
    public $smtpPaswword      = 'e2e9e';
    
    public function __construct() 
    {
    }

    public function createRandomKeyStats()
    {
        $valid_chars = "0123456789";
        $length = 7;
        $random_string = "";
        $num_valid_chars = strlen($valid_chars);
        
        for ($i = 0; $i < $length; $i++)
        {
            $random_pick = mt_rand(1, $num_valid_chars);
            $random_char = $valid_chars[$random_pick-1];
            $random_string .= $random_char;
        }

        return $random_string;
    }
}

?>
