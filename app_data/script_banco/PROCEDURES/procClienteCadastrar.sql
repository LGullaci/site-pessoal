DELIMITER $$

DROP PROCEDURE IF EXISTS procClienteCadastrar $$

CREATE PROCEDURE procClienteCadastrar (in dadosCliente json)
BEGIN
	

	DECLARE retorno JSON;
    DECLARE dadosContato JSON;
    
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION 
	BEGIN
		GET DIAGNOSTICS CONDITION 1
			@msgErro = message_text;
		
        SET retorno = JSON_SET(retorno,'$.resultCode', 1, '$.msg',concat('Falha ao incluir o cliente. <br/>',@msgErro) );
        select retorno;
        ROLLBACK;
    END;
    
    
	 SET retorno = '{
		"resultCode" : 0,
        "msg" : "Cliente incluido com sucesso"}';
    SET dadosContato = dadosCliente->'$.contato';
   
    
    START TRANSACTION;
    
		
        
		INSERT INTO CLIENTE(strNomeCompleto, strCpf, strCnpj, strRazaoSocial,fgAtivo)
		values (replace(dadosCliente->'$.nomeCompleto','"',''), dadosCliente->'$.cpf', dadosCliente->'$.cnpj', replace(dadosCliente->'$.razaoSocial','"',''),1);
		
        set dadosCliente = json_set(dadosCliente, '$.idCliente',LAST_INSERT_ID());
        
        
        
        INSERT INTO CONTATO(idCliente, strEmail, strTelefone1, strTelefone2)
        values(dadosCliente->'$.idCliente', replace(dadosContato->'$.email','"',''), dadosContato->'$.telefone1', dadosContato->'$.telefone2');
        
    COMMIT;
    
    
    select retorno;
END $$

DELIMITER ;