<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Lucas
 */

class Controller {
    
    private $acao;
    public $parametros = null;
    protected $pastaView;
    
    public function __construct($a = "") {
        
        $this->acao = $a;
        
        if($this->acao == "")
            $this->acao = "Index";
        if(strcmp(get_class($this),"Controller") == 0)
        {
            $this->pastaView = "";
        }else if( stripos("Controller", get_class($this)) > 0)   
        {
            $this->pastaView = str_ireplace("Controller", "", get_class($this)) . "/";
        }
    }
    
    public function __call($name, $arguments) {
        if(strpos($name, "get"))
        {
            return $this->acao;
        }else if(strpos($name, "set"))
        {
            $this->acao = $arguments;
        }
    }
    
    public function Index()
    {
        $_SESSION["View"] = new View();
    }
    
    public function Edit($args)
    {
        
    }
    
    public function Search($args)
    {
        
    }
    
    public function Create($args = null)
    {
        
    }
    
    public function SearchList()
    {
        
    }
    
    public function executarAcao()
    {
        if(!method_exists($this, $this->acao))
        {
            
            trigger_error("Method {$this->acao} not exists in the class: {get_class($this)}");
        }
        
        if($this->parametros != null && count($this->parametros) > 0)
        {
            $this->{$this->acao}($this->parametros);
        }else
        {
            $this->{$this->acao}();
        }
    }
}
