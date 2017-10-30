<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proposta
 *
 * @author Lucas Gullaci
 */
class Proposta {
    //put your code here
    
    public function Insert(){
        
        return DAOProposta.cadastrarProposta($this->ToJSON());
    }
    
    public function Update(){
        
        return DAOProposta.alterarProposta($this->ToJSON());
    }
    
    public function Search($args = null){
        
        $this->to = DAOProposta.selecionarProposta($args);
    }
    public function SearchList($args = null){
        
        $result = DAOProposta.listarPropostas($args);
        
        $lista = array();
        while($row = $result->fecth_array(MYSQLI_ASSOC)) {
            
            $to = new TransferObjet();
            $to->idProposta = $row["idProposta"];
            $to->status = $row["idStatus"];
            $to->idCliente = $row["idCliente"];
            $to->valorProposta = $row["vlrProposta"];
            $to->arquivo = $row["arquivo"];
            $to->orcamentoLivre = $row["fgOrcamentoLivre"];
            $to->tipoAvalicao = $row["idTipoAvalicao"];
            $to->proposta = $row["strProposta"];
            $to->idSolucao = $row["idSolucao"];
            
            $lista[] = $to;
        }
        
        return $lista;
    }
    
    public function listarStatusProposta(){
     
        $lista = array();
        try {
            $result = DAOProposta.listarStatusProposta();

            while($row = $result->fecth_array(MYSQLI_ASSOC)){

                $to = new TransferObject();

                $to->idStatus = $row["idStatusProposta"];
                $to->descricao = $row["strDescricaoStatus"];
            }
        }catch (Exception $ex){
            return false;
        }
        
        return $lista;
    }
    
    public function listarTipoAvaliacao(){
        
        $lista = array();
        try {
            $result = DAOProposta.listarTipoAvaliacao();

            while($row = $result->fecth_array(MYSQLI_ASSOC)){

                $to = new TransferObject();

                $to->idStatus = $row["idTipoAvaliacao"];
                $to->descricao = $row["strDescricaoTipoAvaliacao"];
            }
        }catch (Exception $ex){
            return false;
        }
        
        return $lista;
        
    }

    public function enviarProposta($proposta){
       // var_dump($proposta->txtNomeCliente);
        //Email::enviarEmailProposta($proposta->txtNomeCliente, $proposta->txtEmail, $proposta->txTelefone1, $proposta->txTelefone2, $proposta->txtProposta) ;
        return Email::enviarEmailProposta($proposta->txtNomeCliente, $proposta->txtEmail, $proposta->txTelefone1, $proposta->txTelefone2, $proposta->txtProposta) ;
            
    }
}
