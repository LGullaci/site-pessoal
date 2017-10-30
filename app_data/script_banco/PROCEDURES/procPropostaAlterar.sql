DELIMITER $$

DROP PROCEDURE IF EXISTS procPropostaAlterar $$

CREATE PROCEDURE procPropostaAlterar (in dadosProposta JSON)
BEGIN
	

	DECLARE retorno JSON;
    
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION 
	BEGIN
		GET DIAGNOSTICS CONDITION 1
			@msgErro = message_text;
		
        SET retorno = JSON_SET(retorno,'$.resultCode', 1, '$.msg',concat('Falha ao alterar a proposta. <br/>',@msgErro) );
        select retorno;
        ROLLBACK;
    END;
    
    
    
	 SET retorno = '{
		"resultCode" : 0,
        "msg" : "Proposta alterada com sucesso"}';
   
    
    START TRANSACTION;
    
		UPDATE PROPOSTA SET
			idSolucao = dadosProposta->'$.idSolucao', 
            idStatus = dadosProposta->'$.idStatus', 
            strProposta = dadosProposta->'$.strProposta',
            vlrProposta = dadosProposta->'$.vlrProposta',
            fgOrcamentoLivre = dadosProposta->'$.fgOrcamentoLivre',
            idCliente = dadosProposta->'$.idCliente'
		WHERE idProposta = dadosProposta->'$.idProposta';
        
    COMMIT;
    
    
    select retorno;
END $$

DELIMITER ;