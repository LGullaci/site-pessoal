DELIMITER $$

DROP PROCEDURE IF EXISTS procListarUsuarios $$

CREATE PROCEDURE procListarUsuarios()
BEGIN
		SELECT u.*,
			   c.idCliente,
               c.strNomeCompleto,
               c.strCpf
		FROM USUARIO u
			INNER JOIN CLIENTE c on u.idCliente = c.idCliente
		WHERE c.fgAtivo = 1;
END $$

DELIMITER ;