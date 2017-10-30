<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Lucas Gullaci
 */
class Usuario extends Model {
    //put your code here
    
    public function __construct(){
        parent::__construct();
        
        $this->idUsuario = -1;
        $this->idCliente = -1;
        $this->login = '';
        $this->senha = '';
        $this->demonstracoes = array();
    }
    
    public function Insert(){
        
        return DAOUsuario.cadastrarUsuario($this->ToJSON());
    }
    
    public function Update(){
        
        return DAOUsuario.alterarUsuario($this->ToJSON());
    }
    
    public function login(){
        
        try {
            
            $validado = DAOUsuario.validaUsuario(array("login"=>$this->login, "senha"=> $this->senha));
            
            if($validado === true)
                $this->Search();
            
            return $validado;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function logout(){
        
        $class = get_class($this);
        
        return new $class();
    }
    
    public function Search($args = null){
          
        try {
            
              $dados = DAOUsuario.selecionarUsuario($this->idUsuario,$this->login);
            
            $this->to = $dados;
            
            return '';
            
        } catch (Exception $ex) {
            
            return 'Usuário não encontrado';
        }
    }
}
