-- ***
-- TABELA CATEGORIA

CREATE TABLE IF NOT EXISTS categoria (
  idcategoria int(9) NOT NULL AUTO_INCREMENT,
  nome varchar(150) NOT NULL,
  ativo enum('S', 'N'),
  data_cadastro datetime NOT NULL,
  PRIMARY KEY (idcategoria)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS alimento (
  idalimento int(9) NOT NULL AUTO_INCREMENT,
  idcategoria int(9) NULL,
  nome varchar(150) NOT NULL,
  carboidrato decimal(2,2) NOT NULL,
  proteina decimal(2,2) NOT NULL,
  lipidio decimal(2,2) NOT NULL,
  data_cadastro datetime NOT NULL,
  PRIMARY KEY (idalimento)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

ALTER TABLE alimento ADD CONSTRAINT alimento_fk_categoria FOREIGN KEY (idcategoria) REFERENCES categoria (idcategoria);

CREATE TABLE IF NOT EXISTS dieta (
  iddieta int(9) NOT NULL AUTO_INCREMENT,
  idnutricionista int(9) NOT NULL,
  caloria decimal(4,2),
  ativo enum('S', 'N'), 
  data_cadastro datetime NOT NULL,
  PRIMARY KEY (iddieta)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

ALTER TABLE dieta ADD CONSTRAINT dieta_fk_nutricionista FOREIGN KEY (idnutricionista) REFERENCES nutricionista (idnutricionista) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS dieta_alimento (
  iddieta_alimento int(9) NOT NULL AUTO_INCREMENT,
  iddieta int(9) NOT NULL,
  idalimento int(9) NOT NULL,
  PRIMARY KEY (iddieta_alimento)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

ALTER TABLE dieta_alimento ADD CONSTRAINT dieta_alimento_fk_dieta FOREIGN KEY (iddieta) REFERENCES dieta (iddieta) ON DELETE CASCADE;
ALTER TABLE dieta_alimento ADD CONSTRAINT dieta_alimento_fk_alimento FOREIGN KEY (idalimento) REFERENCES alimento (idalimento) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS dieta_historico (
  iddieta_historico int(9) NOT NULL AUTO_INCREMENT,
  iddieta int(9) NOT NULL,
  idcliente int(9) NOT NULL,
  PRIMARY KEY (iddieta_historico)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

ALTER TABLE dieta_historico ADD CONSTRAINT historico_fk_dieta FOREIGN KEY (iddieta) REFERENCES dieta (iddieta) ON DELETE CASCADE;
ALTER TABLE dieta_historico ADD CONSTRAINT historico_fk_cliente FOREIGN KEY (idcliente) REFERENCES cliente (idcliente) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS nutricionista (
  idnutricionista int(9) NOT NULL AUTO_INCREMENT,
  nome varchar(255) NOT NULL,
  cnpj varchar(14) NOT NULL,
  email varchar(80) NOT NULL,
  estado varchar(60) NOT NULL,
  cidade varchar(80) NOT NULL,
  bairro varchar(80) NOT NULL,
  complemento varchar(100) NULL,
  ativo enum('S', 'N') NOT NULL,
  login varchar(80) NOT NULL,
  senha varchar(30) NOT NULL,
  data_cadastro datetime NOT NULL,
  PRIMARY KEY (idnutricionista)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS cliente (
  idcliente int(9) NOT NULL AUTO_INCREMENT,
  idnutricionista int(9) NOT NULL,
  nome varchar(120) NOT NULL,
  data_nascimento DATE NOT NULL,
  ativo enum('S', 'N') NOT NULL,
  altura decimal(3,2) NULL,
  peso decimal(3, 2) NULL,
  data_cadastro datetime NOT NULL,
  PRIMARY KEY (idcliente)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

ALTER TABLE cliente ADD CONSTRAINT cliente_fk_nutricionista FOREIGN KEY (idnutricionista) REFERENCES nutricionista (idnutricionista) ON DELETE CASCADE;

create table sessao (
id         varchar(40) NOT NULL,
ip_address varchar(45) NOT NULL,
timestamp  int(10) unsigned DEFAULT 0 NOT NULL,
data       blob DEFAULT '' NOT NULL,
primary key (id),
key ci_sessions_timestamp (timestamp)
) engine=innodb default charset=latin1 collate=latin1_general_ci;

alter table sessao add constraint ci_sessions_id_ip unique (id, ip_address);