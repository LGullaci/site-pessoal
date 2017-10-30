CREATE DATABASE IF NOT EXISTS GULLACICONSULTORIA
DEFAULT CHARACTER SET latin1
COLLATE latin1_swedish_ci;

USE GULLACICONSULTORIA;

CREATE TABLE IF NOT EXISTS CLIENTE
(
	idCliente int not null primary key auto_increment,
    strNomeCompleto varchar(60) not null,
    strCpf varchar(15) not null,
    strCpnj varchar(15) not null,
    strRazaoSocial varchar(60) not null
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS CONTATO
(
	idContato int not null primary key auto_increment,
    idCliente int not null,
    strEmail varchar(30) not null,
    strTelefone1 varchar(20) not null,
    strTelefone2 varchar(20),
    FOREIGN KEY(idCliente) REFERENCES CLIENTE(idCLiente)
    
)ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS USUARIO
(
	idUsuario int not null primary key auto_increment,
	idCliente int null,
    strLogin varchar(45) UNIQUE,
    strSenha varchar(100),
    FOREIGN KEY (idCliente) REFERENCES CLIENTE(idCliente)
    
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS STATUS_PROPOSTA
(
	idStatusProposta int primary key auto_increment,
    strDescricaoStatus varchar(45)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS STATUS_ORCAMENTO
(
	idStatusOrcamento int primary key auto_increment,
    strDescricaoStatus varchar(45)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS TIPO_AVALIACAO
(
	idTipoAvaliacao int primary key auto_increment,
    strDescricaoTipoAvaliacao varchar(45)
)ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS TIPO_SOLUCAO
(
	idTipo int primary key auto_increment,
    strDescricaoTipoSolucao varchar(45)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS SOLUCAO
(
	idSolucao int primary key auto_increment,
    vlrMinimo decimal(12,2),
    fgAtivo bool,
    strLinkDataBase varchar(300),
    idTipo int,
    
    FOREIGN KEY(idTipo) REFERENCES TIPO_SOLUCAO(idTipo)
    
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS PROPOSTA
(
	idProposta int primary key auto_increment,
    idStatus int,
    idCliente int,
    fgOrcamentoLivre bool,
    vlrProposta decimal(12,2),
    idTipoAvaliacao int,
    idSolucao int,
    
    FOREIGN KEY(idStatus) REFERENCES STATUS_PROPOSTA(idStatusProposta),
    FOREIGN KEY(idCliente) REFERENCES CLIENTE(idCliente),
    FOREIGN KEY(idTipoAvaliacao) REFERENCES TIPO_AVALIACAO(idTipoAvaliacao),
	FOREIGN KEY(idSolucao) REFERENCES SOLUCAO(idSolucao)
    
)ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS ORCAMENTO
(
	idOrcamento int primary key auto_increment,
	idProposta int,
    idStatus int,
    vlrOrcamento decimal(12,2),
    strArquivo varchar(300),
    FOREIGN KEY(idProposta) REFERENCES PROPOSTA(idProposta),
    FOREIGN KEY(idStatus) REFERENCES STATUS_ORCAMENTO(idStatusOrcamento)
    
)ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS USUARIO_SOLUCAO
(
	idUsuarioSolucao int primary key auto_increment,
	idSolucao int,
    idUsuario int,
   
    FOREIGN KEY(idUsuario) REFERENCES USUARIO(idUsuario),
	FOREIGN KEY(idSolucao) REFERENCES SOLUCAO(idSolucao)
    
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS SOLICITACAO_DEMONSTRACAO
(
	idSolicitacaoDemonstracao int primary key auto_increment,
	idSolucao int,
    idCliente int,
   
    FOREIGN KEY(idCliente) REFERENCES CLIENTE(idCliente),
	FOREIGN KEY(idSolucao) REFERENCES SOLUCAO(idSolucao)
    
)ENGINE = InnoDB;

