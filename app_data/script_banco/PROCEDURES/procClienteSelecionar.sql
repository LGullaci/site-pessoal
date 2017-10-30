DELIMITER $$

DROP PROCEDURE IF EXISTS procClienteSelecionar $$

CREATE PROCEDURE procClienteSelecionar (in IdCliente int)
BEGIN
	
    SELECT c.idCliente,
		   c.strNomeCompleto,
		   cc.strEmail,
           cc.strTelefone1,
           cc.strTelefone2,
           c.strCpf,
           c.strCnpj,
           c.strRazaoSocial
	FROM CLIENTE c
    INNER JOIN CONTATO cc on cc.idCliente = c.idCliente
    WHERE c.idCliente = IdCliente;
	
END $$

DELIMITER ;