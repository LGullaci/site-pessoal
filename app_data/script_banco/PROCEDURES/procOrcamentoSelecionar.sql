DELIMITER $$

DROP PROCEDURE IF EXISTS procOrcamentoSelecionar $$

CREATE PROCEDURE procOrcamentoSelecionar (in IdOrcamento int)
BEGIN
	
    SELECT 
		*
	FROM ORCAMENTO 
    WHERE idOrcamento = IdOrcamento;
	
END $$

DELIMITER ;