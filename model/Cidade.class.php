<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cidade
 *
 * @author Lucas
 */
class Cidade extends Model{
    
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function Insert()
    {
       $dao = new CidadeDAO();
       
       if($dao->insert($this->to)) 
           return "Registro incluido com sucesso";
       else {
           return "Erro ao incluir o registro";
       }
    }
    
     public function Update()
    {
        $dao = new CidadeDAO();
        
        return $dao->update($this->to);
        
    }
     
    public function Search($args = null)
    {
        $dao = new CidadeDAO();
        $dados = $dao->buscarCidade((int)$args);
        
        
        $row =  $dados->fetch_array(MYSQLI_ASSOC);
        
        $this->id = $row["id"];
        $this->nome = $row["nome"];
    } 
    
    public function SearchList()
    {
        $dao = new CidadeDAO();
        
        $dados = $dao->listarCidades();
        $lista = array();
        
        
        while($row = $dados->fetch_array(MYSQLI_ASSOC))
        {            
            $to = new TransferObject();
           
            $to->nome = $row["nome"];
            $to->id = $row["id"];
            $lista[] = $to;
        }

        
       return $lista;
    }
    
    
}
