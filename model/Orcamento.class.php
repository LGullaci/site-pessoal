<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Orcamento
 *
 * @author Lucas Gullaci
 */
class Orcamento {
    //put your code here
    
    
    public function Insert(){
        
        try{
            return DAOOrcamento.cadastrarOrcamento($this->ToJSON());
        } catch (Exception $ex) {
            return false;
        }
        
    }
    
    public function Update(){
        try{
            return DAOOrcamento.alterarOrcamento($this->ToJSON());
        } catch (Exception $ex) {
            return false;
        }
        
    }
    
    public function Search($args = null){
        try{
            
            $this->to = DAOOrcamento.selecionarOrcamento($args[0],$args[1]);
            
        } catch (Exception $ex) {
            return false;
        }
    }
    public function SearchList($args = null){
        
        $lista = array();
        try{
            $result = DAOOrcamento.listarOrcamentos($args[0],$args[1]);
            
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                
                $to = new TransferObject();
                $to->idOrcamento = $row["idOrcamento"];
                $to->status = $row["idStatus"];
                $to->idProposta = $row["idProposta"];
                $to->vlrOrcamento = $row["vlrOrcamento"];
                $to->arquivo = $row["arquivo"];
                
                $lista[] = $to;
            }
        } catch (Exception $ex) {
            return false;
        }
        
        return $lista;
    }
    
    public function listarStatusOrcamento(){
        $lista = array();
        try {
            $result = DAOOrcamento.listarStatusOrcamento();

            while($row = $result->fecth_array(MYSQLI_ASSOC)){

                $to = new TransferObject();

                $to->idStatus = $row["idStatusOrcamento"];
                $to->descricao = $row["strDescricaoStatus"];
            }
        }catch (Exception $ex){
            return false;
        }
        
        return $lista;
    }
}
