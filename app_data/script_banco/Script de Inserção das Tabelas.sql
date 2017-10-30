INSERT INTO TIPO_SOLUCAO (strDescricaoTipoSolucao)
VALUES ('E-commerce'),
	   ('Sistema Integrado'),
       ('Site de EAD'),
       ('Blog'),
       ('Site Institucional');
       
INSERT INTO TIPO_AVALIACAO (strDescricaoTipoAvaliacao)
VALUES ('Alta'),
	   ('Média'),
       ('Baixa');
       
INSERT INTO STATUS_ORCAMENTO (strDescricaoStatus)
VALUES ('Recusado'),
	   ('Aceito'),
       ('Enviado p/ Aprovação'),
       ('Em Análise'); 

INSERT INTO STATUS_PROPOSTA (strDescricaoStatus)
VALUES ('Aberta'),
	   ('Fechada'),
       ('Cancelada'),
       ('Em Orçamento');    

INSERT INTO SOLUCAO (idTipo,vlrMinimo,fgAtivo)
SELECT idTipo,
		3000.00,
		0
FROM TIPO_SOLUCAO
WHERE strDescricaoTipoSolucao = 'E-commerce';

INSERT INTO SOLUCAO (idTipo,vlrMinimo,fgAtivo)
SELECT idTipo,
		800.00,
		0
FROM TIPO_SOLUCAO
WHERE strDescricaoTipoSolucao = 'Site Institucional';

INSERT INTO SOLUCAO (idTipo,vlrMinimo,fgAtivo)
SELECT idTipo,
		1200.00,
		0
FROM TIPO_SOLUCAO
WHERE strDescricaoTipoSolucao = 'Blog';

INSERT INTO SOLUCAO (idTipo,vlrMinimo,fgAtivo)
SELECT idTipo,
		4000.00,
		0
FROM TIPO_SOLUCAO
WHERE strDescricaoTipoSolucao = 'Site de EAD';

INSERT INTO SOLUCAO (idTipo,vlrMinimo,fgAtivo)
SELECT idTipo,
		5000.00,
		0
FROM TIPO_SOLUCAO
WHERE strDescricaoTipoSolucao = 'Sistema Integrado';

