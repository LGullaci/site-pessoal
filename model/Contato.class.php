<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contato
 *
 * @author Lucas Gullaci
 */
class Contato extends Model{
    //put your code here
    
    public function __construct(){
        parent::__construct();
        
        $this->email = '';
        $this->telefone1 = '';
        $this->telefone2 = '';
    }
}
