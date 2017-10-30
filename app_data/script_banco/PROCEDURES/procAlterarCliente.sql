DELIMITER $$

DROP PROCEDURE IF EXISTS procAlterarCliente $$

CREATE PROCEDURE procAlterarCliente(in dadosCliente JSON)
BEGIN

	DECLARE retorno JSON;
    DECLARE dadosContato JSON;
    
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION 
	BEGIN
		GET DIAGNOSTICS CONDITION 1
			@msgErro = message_text;
		
        SET retorno = JSON_SET(retorno,'$.resultCode', 1, '$.msg',concat('Falha ao alterar o cliente. <br/>',@msgErro) );
        select retorno;
        ROLLBACK;
    END;
    
    
    
	 SET retorno = '{
		"resultCode" : 0,
        "msg" : "Cliente incluido com sucesso"}';
    SET dadosContato = dadosCliente->'$.contato';
   
    
    START TRANSACTION;
    
		
        
		UPDATE CLIENTE SET
			strNomeCompleto = dadosCliente->'$.nomeCompleto', 
			strCpf = dadosCliente->'$.cpf', 
			strCnpj = dadosCliente->'$.cnpj', 
            strRazaoSocial = dadosCliente->'$.razaoSocial',
            fgAtivo = dadosCliente->'$.ativo'
		WHERE idCliente = dadosCliente->'$.id';
		
        DELETE FROM CONTATO WHERE idCliente = dadosCliente->'$.id';
        
        INSERT INTO CONTATO(idCliente, strEmail, strTelefone1, strTelefone2)
        values(dadosCliente->'$.idCliente',dadosContato->'$.email', dadosContato->'$.telefone1', dadosContato->'$.telefone2');
        
    COMMIT;
    
    
    select retorno;
END $$