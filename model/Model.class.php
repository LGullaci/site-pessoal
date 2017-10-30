<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author Lucas
 */
class Model  {
    //put your code here
    
    private $to;
    
    public function __construct()
    {
        $this->to = new TransferObject();
    }
    
    public function __get($key)
    {
        if($key != "to")
            return $this->to->$key;
        else
            return $this->to;
    }
    
    public function __set($key,$value)
    {
        if($key != "to")        
        {   
            $this->to->$key = $value;
        
        }else
            $this->to = $value;
    }
    
     public function Insert(){}
     public function Update(){}
     public function Search($args = null){}
     public function SearchList($args = null){}
    
     public function ToJSON()
     {
         return json_encode($this->to);
     }
}
?>
