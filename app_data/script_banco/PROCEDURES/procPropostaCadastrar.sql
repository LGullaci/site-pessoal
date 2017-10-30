DELIMITER $$

DROP PROCEDURE IF EXISTS procPropostaCadastrar $$

CREATE PROCEDURE procPropostaCadastrar (in dadosProposta JSON)
BEGIN
	

	DECLARE retorno JSON;
    
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION 
	BEGIN
		GET DIAGNOSTICS CONDITION 1
			@msgErro = message_text;
		
        SET retorno = JSON_SET(retorno,'$.resultCode', 1, '$.msg',concat('Falha ao incluir a proposta. <br/>',@msgErro) );
        select retorno;
        ROLLBACK;
    END;
    
    
    
	 SET retorno = '{
		"resultCode" : 0,
        "msg" : "Proposta incluida com sucesso"}';
   
    
    START TRANSACTION;
    
		INSERT INTO PROPOSTA(idSolucao, idStatus, strProposta, vlrProposta,fgOrcamentoLivre,idCliente)
		values (dadosProposta->'$.idSolucao', dadosProposta->'$.idStatus', dadosProposta->'$.strProposta', dadosProposta->'$.vlrProposta', dadosProposta->'$.fgOrcamentoLivre', dadosCliente->'$.idCliente');
        
    COMMIT;
    
    
    select retorno;
END $$

DELIMITER ;