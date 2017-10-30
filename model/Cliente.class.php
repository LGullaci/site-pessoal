<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cliente
 *
 * @author Lucas Gullaci
 */
class Cliente extends Model{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        
        $this->idCliente = -1;
        $this->nomeCompleto = '';
        $this->cpf = '';
        $this->cnpj = '';
        $this->razaoSocial = '';
        $this->Contato = new Contato();
    }
    
    public function Insert(){
        
        return DAOCliente.cadastrarCliente($this->ToJSON());
    }
    
    public function Update(){
        return DAOCliente.alterarCliente($this->ToJSON());
    }
    
    public function Search($args = null){
        
        if($args == null)
            throw new Exception("Argumento passado não pode ser nulo.");
        
        $dadosCliente = DAOCliente.selecionarCliente($args);
        
         $this->idCliente = $dadosCliente->idCliente;
        $this->nomeCompleto = $dadosCliente->nomeCompleto;
        $this->cpf = $dadosCliente->cpf;
        $this->cnpj = $dadosCliente->cnpj;
        $this->razaoSocial = $dadosCliente->razaoSocial;
        
        $contato = new Contato();
        $contato->email = $dadosCliente->contato->email;
        $contato->telefone1 = $dadosCliente->contato->telefone1;
        $contato->telefone2 = $dadosCliente->contato->telefone2;
        
        $this->contato = $contato;
    }
    
    public function SearchList($args = null){
        
        $clientes = DAOCliente.listarClientes($args[0], $args[1], $args[2], $args[3]);
        $listaClientes = array();
        
        while($row = $clientes->fetch_array(MYSQLI_ASSOC)){
            
            $to = new TransferObject();
            
            $to->nomeCompleto = $row["strNomeCompleto"];
            $to->cpf = $row["strCpf"];
            $to->razaoSocial = $row["strRazaoSocial"];
            $to->email = $row["strEmail"];
            
            $listaCliente[] = $to;
        }
        
        return $listaClientes;
    }
    
    public function VerificarCliente($filtro)
    {
        return DAOCliente.verificarCliente($filtro);
    }
    
}
