-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.22-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela vexpenses.agenda
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `rua` varchar(50) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela vexpenses.agenda: ~1 rows (aproximadamente)
REPLACE INTO `agenda` (`id`, `nome`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `uf`, `telefone`, `id_usuario`) VALUES
	(5, 'Luís Fernando', 'Guaíra', 'Rua 18 de Abril', '123', 'Centro', 'Guaíra', 'SP', '(16) 99998-9999', 1),
	(6, 'Pedro Neves', 'São Joaqui', 'Rua XV de Novembro', '1010', 'Centro', 'São Joaquim da Barra', 'SP', '16 99999-1546', 1),
	(7, 'Caroline Cristina', 'São Paulo', 'Viela 16', '159', 'Parque São José', 'São Paulo', 'SP', '16 3811-1187', 1);

-- Copiando estrutura para tabela vexpenses.endereco_secundario
CREATE TABLE IF NOT EXISTS `endereco_secundario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cep` varchar(10) DEFAULT NULL,
  `rua` varchar(50) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `FK_endereco_secundario_agenda` FOREIGN KEY (`id_user`) REFERENCES `agenda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela vexpenses.endereco_secundario: ~2 rows (aproximadamente)
REPLACE INTO `endereco_secundario` (`id`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `uf`, `id_user`) VALUES
	(4, 'São Paulo', 'Viela 16', '120', 'Parque São José', 'São Paulo', 'SP', 5),
	(5, 'Guaíra', 'Rua Alvorada', '123', 'Parque São José', 'Guaíra', 'SP', 7);

-- Copiando estrutura para tabela vexpenses.telefone_secundario
CREATE TABLE IF NOT EXISTS `telefone_secundario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telefone` varchar(30) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`) USING BTREE,
  CONSTRAINT `FK_telefone_secundario_agenda` FOREIGN KEY (`usuario_id`) REFERENCES `agenda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela vexpenses.telefone_secundario: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela vexpenses.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `rua` varchar(50) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela vexpenses.usuario: ~2 rows (aproximadamente)
REPLACE INTO `usuario` (`id`, `nome`, `email`, `senha`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `uf`, `telefone`) VALUES
	(1, 'Luís Fernando', 'luis@glv.com', 'e10adc3949ba59abbe56e057f20f883e', 'São Joaqui', 'José Espanha', '381', 'João Paulo II', 'São Joaquim da Barra', 'SP', '16991618839'),
	(2, 'Dorival', 'dorival@glv.com', 'e10adc3949ba59abbe56e057f20f883e', 'Morro Agud', 'Rua da Saudade', '123', 'Centro', 'Morro Agudo', 'SP', '16 3811-1187');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
