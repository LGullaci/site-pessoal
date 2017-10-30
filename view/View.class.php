<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author Lucas
 */
class View {
    
    private $page;
    private $pageAttributes = array();
    public $css;
    public $js;
    
    public function __construct($page = '')
    {
        $this->page = $page;
    }
    
    public function __get($key)
    {
       
        if(array_key_exists($key, $this->pageAttributes))
            return $this->pageAttributes[$key];
        
        return null;
    }
    
    public function __set($key,$value)
    {
        $this->pageAttributes[$key] = $value;
    }
    
    public function render()
    {
        $content = '';
        
        if($this->page != '')
        {
            ob_start();

            include $this->page.'.phtml';

            $content = ob_get_contents();

            ob_end_clean();
        }
        echo $content;
        
        
    }
    
    public static function ActionLink($NameLink, $ControllerName="", $ActionName= "", $parametros = array())
    {
        $url = "";
        if($ControllerName != "")
        {
            $url .= "{$ControllerName}";

            if($ActionName != "")
            {
                $url .= "/{$ActionName}";

                for($i = 0; $i < count($parametros) ; $i++)
                {
                    $url .= "/{$parametros[$i]}";
                }
            }
        }
        
        
        return "<a href='{$url}'>{$NameLink}</a>";
            
    }
}
