<?php

/**
 * Description of FuncoesGerais
 * 
 * Classe onde estão todas as rotinas que serão usadas
 * com mais frequencia em varias partes do sistema 
 * 
 * @author Lucas
 */
class Util {
    
    
    public static function routerURL()
    {
        //echo $_REQUEST["url"];
        $parameters = self::getParameter();
        
        $controller = new $parameters["controller"]($parameters["acao"]);
        $controller->parametros = $parameters["parametros"];
        
        $controller->executarAcao();
    }
    
    public static function getController()
    {
        
    }
    
    public static function getParameter()
    {
        $config = Config::GetInstance();
        
        $array = array("controller" => $config->preferences["controller_default"]."Controller","acao" => "", "parametros" => array());
        $url = "";
        if(!isset($_REQUEST["url"]))
        {
            return $array;
        }

        if(isset($_REQUEST["ajax_request"])){
            header('Location:controller/ClienteController.class.php');
        }
        
        
        $url = $_REQUEST["url"];
        
       
        
        $params = explode("/", $url);
        
        
        if(count($params) > 0)
        {
            $array["controller"] = $params[0] . "Controller";
            if(count($params) > 1)
            {
                $array["acao"] = $params[1];
            }
                
            $aux = array();
            
            for($i = 2; $i < count($params); $i++)
            {
                $aux[] = $params[$i];
            }
            $array["parametros"] = $aux;
        }
        
        return $array;
        
    }
    
    public static function JSONtoObject($jsonObject, $className = '')
    {
        return self::ArrayToObject(json_decode($jsonObject, true));
    }
    
    public static function ArrayToObject($array)
    {
        $object = self::newClass();
        $object->setAttr($array);
        return $object;
    }
    
    public static function newClass()
    {
       return new class{

                public $attr;

                public function __get($name) {

                    if(array_key_exists($name,$this->attr))
                        return $this->attr[$name];
                   return null;
                }

                public function __set($name, $value) {

                    $this->attr[$name] = $value;
                }

               public function getAttr()
               {
                   return $this->attr;
               }

               public function setAttr($a)
               {
                   $this->attr = $a;
               }

            };;
    }
}

?>
