DELIMITER $$

DROP PROCEDURE IF EXISTS procPropostaSelecionar $$

CREATE PROCEDURE procPropostaSelecionar (in IdProposta int)
BEGIN
	
    SELECT p.idProposta,
		   p.idCliente,
		   p.idTipoAvaliacao,
           p.fgOrcamentoLivre,
           p.idStatus,
           p.vlrProposta,
           p.strProposta,
           s.idTipo,
           c.strCnpj,
           c.strRazaoSocial
	FROM PROPOSTA p
    INNER JOIN SOLUCAO s on s.idSolucao = p.idSolucao
    WHERE p.idProposta = IdProposta;
	
END $$

DELIMITER ;