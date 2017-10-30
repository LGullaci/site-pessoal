<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Solucao
 *
 * @author Lucas Gullaci
 */
class Solucao extends Model{
    //put your code here
    
    public function __construct(){
        parent::__construct();
        
        $this->idSolucao = -1;
        $this->tipo = -1;
        $this->valorMinimo = 0.0;
        $this->ativo = 1;
        $this->linkBase = '';
    }
    
   public function Search($args = null){
        try
        {
            $this->to = DAOSolucao.selecionarSolucao($args[0],$args[1]);
        } catch (Exception $ex) {
            return false;
        }
    }
    public function SearchList($args = null){
        
        $lista = array();
        try{
            
            $result = DAOSolucao.listarSolucoes();
            
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                
                $to = new TransferObject();
                
                $to->idSolucao = $row["idSolucao"];
                $to->tipo = $row["idTipo"];
                $to->valorMinimo = $row["vlrMinimo"];
                $to->ativo = $row["fgAtivo"];
                $to->linkBase = $row["strLinkDataBase"];
                
                $lista[]= $to;
            }
            
        } catch (Exception $ex) {
            return false;
        }
        return $lista;
    }
    
    public function listarTipoSolucoes(){
        
        $lista = array();
        try{
            
            $result = DAOSolucao.listarTipoSolucoes();
            
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                
                $to = new TransferObject();
                
                $to->idTipo = $row["idTipo"];
                $to->descricao = $row["strDescricaoTipoSolucao"];
                
                $lista[]= $to;
            }
            
        } catch (Exception $ex) {
            return false;
        }
        return $lista;
    }
}
