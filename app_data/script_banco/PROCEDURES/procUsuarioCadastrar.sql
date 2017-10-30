DELIMITER $$

DROP PROCEDURE IF EXISTS procUsuarioCadastrar $$

CREATE PROCEDURE procUsuarioCadastrar (in dadosUsuario JSON)
BEGIN
	

	DECLARE retorno JSON;
    DECLARE dadosCliente JSON;
    
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION 
	BEGIN
		GET DIAGNOSTICS CONDITION 1
			@msgErro = message_text;
		
        SET retorno = JSON_SET(retorno,'$.resultCode', 1, '$.msg',concat('Falha ao incluir o usuario. <br/>',@msgErro) );
        select retorno;
        ROLLBACK;
    END;
    
	 SET retorno = '{
		"resultCode" : 0,
        "msg" : "Usuario incluido com sucesso"}';
   
    
    START TRANSACTION;
		
        SET dadosCliente = dadosUsuario->'$.cliente';
        SET @idCliente = dadosCliente->'$.idCliente';
        
        IF( @idCliente = -1) THEN
			create table result(r JSON);
            
            insert into result(r) 
			value(procClienteCadastrar(dadosCliente));
            
			SELECT @idCliente := idCliente from CLIENTE where cpf = dadosCliente->'$.cpf';
        END IF;
    
		INSERT INTO Usuario(idCliente, strLogin, strSenha, dtInclusao)
		values (idCliente,dadosUsuario->'$.login', dadosUsuario->'$.senha', now());
        
    COMMIT;
    
    
    select retorno;
END $$

DELIMITER ;