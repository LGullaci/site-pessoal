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



class CidadeController extends Controller {
    
  
    public function __construct($a = "") {
        
        parent::__construct($a);
    }
    
   
    
    public function Index()
    {
        $view = new View("Cidade/index");
        $_SESSION["View"] = $view;
       
    }
    
    public function Edit($args)
    {
        $cidade = new Cidade();
        $view = new View("Cidade/update");
        
        $cidade->Search($args[0]);
        
        if(isset($_REQUEST["Nome"]))
        {
            $cidade->nome = $_REQUEST["Nome"];
           if($cidade->Update() === true)
               $view->MensagemAlteracao = "Alteração Feita com sucesso";
           else
               $view->MensagemAlteracao = "Alteração Feita com sucesso";
               
        }
        $view->dadosCidade = $cidade->to;
        
        $_SESSION["View"] = $view;
    }
    
    public function Search($args)
    {
        
    }
    
    public function Create()
    {
       // echo array_values($_POST);
        
        $view = new View("Cidade/insert");
       
        
        
        if(isset($_REQUEST["Nome"]))
        {
            $cidade = new Cidade();
            
            $cidade->nome = $_REQUEST["Nome"];
            $view->Mensagem = $cidade->Insert();
        }
        
         $_SESSION["View"] = $view;
        
    }
    
    public function SearchList()
    {
        $view = new View("Cidade/list");
        
        $cidade = new Cidade();
        
        $view->listaCidades = $cidade->SearchList();
        
        $_SESSION["View"] = $view;
        
    }
    
    
}
