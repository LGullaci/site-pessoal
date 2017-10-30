DELIMITER $$

DROP PROCEDURE IF EXISTS procUsuarioSelecionar $$

CREATE PROCEDURE procUsuarioSelecionar (in IdUsuario int)
BEGIN
	
    SELECT 
		*
	FROM usuario 
    WHERE dUsuario = IdUsuario;
    
    Select
		*
	FROM usuario_solucao
    WHERE idUsuario = IdUsuario;
	
END $$

DELIMITER ;