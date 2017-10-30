<?php

//define("HOSTNAME","localhost",true);
//    define("DATABASE","test",true);
//    define("user_bd","root",true);
//    define("password","",true);
    

class Config
{
    
    
    static $instancia;
    
    private $attr = array();
    
    public function __construct()
    {
        $this->preferences = array();
        
        $this->preferences = json_decode(file_get_contents(__DIR__ .DIRECTORY_SEPARATOR. "preferences.json"),true);
    }
    
    public static function GetInstance()
    {
        
        if(!isset(self::$instancia));
            self::$instancia = new Config();

        return self::$instancia;
    }
    
    public function __get($key)
    {
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
        return null;
    }
    
    public function __set($key, $val)
    {
        $_SESSION[$key] = $val;
    }
    
    public static function CompilerLess()
    {
        $lessc = new lessc();
        
        $dir = dir("/view/less");
        
        if(false !== $dir)
        {
            
        }
    }
}
?>
