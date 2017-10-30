DELIMITER $$

DROP PROCEDURE IF EXISTS procListarClientes $$

CREATE PROCEDURE procListarClientes(in nomeCliente varchar(80), in razaoSocial varchar(170), in cpf varchar(15), in email varchar(150))
BEGIN
		SELECT strNomeCompleto,
			strRazaoSocial,
			strCpf,
			strTelefone1
			strEmail
		FROM CLIENTE c
			INNER JOIN CONTATO cc on c.idCliente = cc.idCliente
		WHERE (strNomeCompleto like nomeCliente or nomeCliente = '')
			AND (strRazaoSocial like razaoSocial or razaoSocial = '')
			AND (strCpf = cpf or cpf = '')
			AND (strEmail like email or email = '');
END $$

DELIMITER ;