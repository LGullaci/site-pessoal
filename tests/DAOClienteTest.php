<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PHPUnit_Framework_TestCase as PHPUnit;

require_once '/../dao/DAO.class';
require_once '/../app_data/Config.class';
require_once '/../dao/DAOCliente.class';
require_once '/../transferobject/TransferObject.class';


class DAOClienteTest extends PHPUnit{
    
    
    public function testInserirCliente()
   {
       $dao =  new DAOCliente();
       $dadosCliente = '{
               "idCliente":0,
               "nomeCompleto":"Teste Inclusao",
               "razaoSocial":"aasdasdasd",
               "cpf": 1231231231,
            "cnpj": 3245345,
             "contato":{
                       "email": "teste@teste.com.br",
                       "telefone1": 56756756,
                        "telefone2": 56756758
              }
       }';
       
       $this->assertEquals(true,$dao->inserirCliente($dadosCliente));
     //  var_dump($dao->error);
        
    }
  
    public function testSelecionarClientes()
    {
         $dao =  new DAOCliente();
         $to = $dao->selecionarCliente(32);

        $propriedades = (count($to->getAttr()) > 0);
        
        $this->assertEquals(true, $propriedades);

    }
    
    public function testAlterarCliente()
    {
         $dao =  new DAOCliente();
        
        $dadosCliente = '{"idCliente":32,"nomeCompleto":"Teste alteração 03","razaoSocial":"aasdasdasd","cpf": 1231231231,"fgAtivo":0,"cnpj": "3245345","contato":{"email": "alteracao@altera.com","telefone1": 56756756,"telefone2": 56756758}}';
        
         
        $v = $dao->AlterarCliente($dadosCliente);
      //  var_dump($dao->error);
        $this->assertEquals(true,$v);
       
       
    }
    
    public function testListarClientes()
    {
    }
    
    public function testVerificarCliente()
    {
        $dao = new DAOCliente();
       $this->assertEquals(true,$dao->verficarCliente(array("filtro"=>"strCpf" ,"strCpf" => 1231231231)));
      // var_dump($dao->error);
    }
}
