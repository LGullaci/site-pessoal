<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutoLoad
 *
 * @author Lucas
 */
class AutoLoad {
    //put your code here
    
    private $directories = array("transferobject","controller","model","view","app_data","dao");
    
    private $rootPath;
    public function __construct($root = false) {
    
        $this->rootPath = $root;
    }
    
   public function register()
   {
       spl_autoload_register(array($this,"load"));
   }
   
   public function load($className)
   {
       for($i = 0; $i < count($this->directories); $i++)
       {
           //echo ($this->rootPath === true ? __DIR__. DIRECTORY_SEPARATOR:'') .$this->directories[$i] . DIRECTORY_SEPARATOR."{$className}.class\n";
         
           
           if(file_exists( ($this->rootPath === true ?  __DIR__.DIRECTORY_SEPARATOR:'') .$this->directories[$i] . DIRECTORY_SEPARATOR . $className . ".class.php"))
           { 
               require_once ($this->rootPath === true ?  __DIR__.DIRECTORY_SEPARATOR:'') .$this->directories[$i] . DIRECTORY_SEPARATOR . $className . ".class.php";
               
               if(class_exists($className))
               {
                   return;
               }
           }
           
            if(file_exists( ($this->rootPath === true ?  __DIR__.DIRECTORY_SEPARATOR:'') .$this->directories[$i] . DIRECTORY_SEPARATOR . $className . ".class"))
           { 
               require_once ($this->rootPath === true ?  __DIR__.DIRECTORY_SEPARATOR:'') .$this->directories[$i] . DIRECTORY_SEPARATOR . $className . ".class";
               
               if(class_exists($className))
               {
                   return;
               }
           }

            if(file_exists( ($this->rootPath === true ?  __DIR__.DIRECTORY_SEPARATOR:'') .$this->directories[$i] . DIRECTORY_SEPARATOR . $className . ".php"))
           { 
               require_once ($this->rootPath === true ?  __DIR__.DIRECTORY_SEPARATOR:'') .$this->directories[$i] . DIRECTORY_SEPARATOR . $className . ".php";
               
               if(class_exists($className))
               {
                   return;
               }
           }

           if(file_exists( ($this->rootPath === true ?  __DIR__.DIRECTORY_SEPARATOR:'') .$this->directories[$i] . DIRECTORY_SEPARATOR . 'class.'.strtolower($className) . ".php"))
           { 
               require_once ($this->rootPath === true ?  __DIR__.DIRECTORY_SEPARATOR:'') .$this->directories[$i] . DIRECTORY_SEPARATOR . 'class.'. strtolower($className) . ".php";
               
               if(class_exists($className))
               {
                   return;
               }
           }
               
       }
      die("Class {$className} not be founded");
   }
}
