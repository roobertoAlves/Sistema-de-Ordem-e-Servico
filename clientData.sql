
USE techrequest;

-- DROP DATABASE  IF EXISTS clientData;
-- CREATE DATABASE  IF NOT EXISTS clientData CHARSET utf8;

DROP TABLE IF EXISTS clientData;
CREATE TABLE clientData(

	requestID  INT NOT NULL AUTO_INCREMENT,
    status char(15) DEFAULT "Aberto" COMMENT '{ "Aberto" , "Em andamento", "Ordem de espera", "Liberado" }',
	clientName VARCHAR (45), 
    dispositive VARCHAR(11),
    telefone 	varchar(15),
	cpf VARCHAR(14) NOT NULL UNIQUE,
	email 	VARCHAR(100) NOT NULL UNIQUE,
	problemDescription VARCHAR(600), 
    
	PRIMARY KEY  (requestID)

);

SELECT * FROM clientData;

