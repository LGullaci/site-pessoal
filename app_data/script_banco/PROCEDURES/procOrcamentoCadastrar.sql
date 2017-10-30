DELIMITER $$

DROP PROCEDURE IF EXISTS procOrcamentoCadastrar $$

CREATE PROCEDURE procOrcamentoCadastrar (in dadosOrcamento JSON)
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
    
		INSERT INTO Orcamento(idProposta, idStatus, vlrOrcamento, strArquivo)
		values (dadosOrcamento->'$.idProposta', dadosOrcamento->'$.idStatus', dadosOrcamento->'$.vlrOrcamento', dadosOrcamento->'$.strArquivo');
        
    COMMIT;
    
    
    select retorno;
END $$

DELIMITER ;