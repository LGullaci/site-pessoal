DELIMITER $$

DROP PROCEDURE IF EXISTS procOrcamentoAlterar $$

CREATE PROCEDURE procOrcamentoAlterar (in dadosOrcamento JSON)
BEGIN
	

	DECLARE retorno JSON;
    
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION 
	BEGIN
		GET DIAGNOSTICS CONDITION 1
			@msgErro = message_text;
		
        SET retorno = JSON_SET(retorno,'$.resultCode', 1, '$.msg',concat('Falha ao incluir o orcamento. <br/>',@msgErro) );
        select retorno;
        ROLLBACK;
    END;
    
    
    
	 SET retorno = '{
		"resultCode" : 0,
        "msg" : "Orcamento incluido com sucesso"}';
   
    
    START TRANSACTION;
    
		UPDATE Orcamento SET
			idProposta = dadosOrcamento->'$.idProposta', 
            idStatus = dadosOrcamento->'$.idStatus', 
            vlrOrcamento = dadosOrcamento->'$.vlrOrcamento', 
            strArquivo = dadosOrcamento->'$.strArquivo'
		WHERE idOrcamento = dadosOrcamento->'$.idOrcamento';
		
    COMMIT;
    
    
    select retorno;
END $$

DELIMITER ;