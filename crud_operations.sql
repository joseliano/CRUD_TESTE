  
CREATE DATABASE `teste_crud`;
 
USE `teste_crud`;

/*Table structure for table `localidade` */

DROP TABLE IF EXISTS `localidade`;

CREATE TABLE `localidade` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(44) DEFAULT NULL,
  `uf` CHAR(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=49451 DEFAULT CHARSET=latin1;

/*Data for the table `localidade` */

LOCK TABLES `localidade` WRITE;

INSERT  INTO `localidade`(`id`,`nome`,`uf`) VALUES (1,'SAO PAULO','SP'),(775,'RIO DAS PEDRAS','SP'),(1371,'BANANAL','SP'),(6901,'CAMPOS DOS GOYTACAZES','RJ'),(7291,'AREAL','RJ'),(7457,'ANGRA DOS REIS','RJ'),(10428,'BANANEIRAS','RJ'),(34700,'APARECIDINHA','SP'),(49450,'ALDEIA','RJ');

UNLOCK TABLES;

/*Table structure for table `uf` */

DROP TABLE IF EXISTS `uf`;

CREATE TABLE `uf` (
  `UF` CHAR(2) NOT NULL,
  `LOCALIDADE` VARCHAR(30) DEFAULT NULL,
  PRIMARY KEY (`UF`),
  KEY `uf` (`UF`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;

/*Data for the table `uf` */

LOCK TABLES `uf` WRITE;

INSERT  INTO `uf`(`UF`,`LOCALIDADE`) VALUES ('RJ','RIO DE JANEIRO'),('SP','SAO PAULO');

UNLOCK TABLES;

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `idcliente` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) DEFAULT NULL,
  `dtnascimento` VARCHAR(10) DEFAULT NULL,
  `email` VARCHAR(45) DEFAULT NULL,
  `id_localidade` INT(11) DEFAULT NULL,
  `UF` CHAR(2) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=INNODB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `usuario` */

LOCK TABLES `usuario` WRITE;

UNLOCK TABLES;

/*Table structure for table `usuariotelefone` */

DROP TABLE IF EXISTS `usuariotelefone`;

CREATE TABLE `usuariotelefone` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) DEFAULT NULL,
  `contato` VARCHAR(62) DEFAULT NULL,
  `numero_tel` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `usuariotelefone` */

LOCK TABLES `usuariotelefone` WRITE;

UNLOCK TABLES; 