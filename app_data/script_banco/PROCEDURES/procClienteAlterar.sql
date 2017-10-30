DELIMITER $$

DROP PROCEDURE IF EXISTS procClienteAlterar $$

CREATE PROCEDURE procClienteAlterar(in dadosCliente JSON)
BEGIN

	DECLARE retorno JSON;
    DECLARE dadosContato JSON;
    
    
  
    
    
    
	 SET retorno = '{
		"resultCode" : 0,
        "msg" : "Cliente alterado com sucesso"}';
    SET dadosContato = dadosCliente->'$.contato';
   
    
    START TRANSACTION;
    
		SET @idCliente = dadosCliente->'$.idCliente';
        
		UPDATE CLIENTE SET
			strNomeCompleto = replace(dadosCliente->'$.nomeCompleto','"','') ,
		 	strCpf = dadosCliente->'$.cpf',
		 	strCnpj = dadosCliente->'$.cnpj', 
            strRazaoSocial = replace(dadosCliente->'$.razaoSocial','"',''),
            fgAtivo = dadosCliente->'$.fgAtivo'
		 WHERE idCliente =dadosCliente->'$.idCliente';
		
       DELETE FROM CONTATO WHERE idCliente = dadosCliente->'$.idCliente';
       
     
        INSERT INTO CONTATO(idCliente, strEmail, strTelefone1, strTelefone2)
        values( dadosCliente->'$.idCliente' ,REPLACE(dadosContato->'$.email','"',''), dadosContato->'$.telefone1', dadosContato->'$.telefone2');
		
        
    COMMIT;
    
    
    select retorno;
END $$