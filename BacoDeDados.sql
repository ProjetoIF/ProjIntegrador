-- MySQL Script generated by MySQL Workbench
-- seg 08 abr 2024 20:20:09
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projetoIntegrador
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projetoIntegrador` DEFAULT CHARACTER SET utf8mb4 ;
USE `projetoIntegrador` ;

-- -----------------------------------------------------
-- Table `projetoIntegrador`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoIntegrador`.`usuarios` (
                                                              `idUsuario` INT NOT NULL AUTO_INCREMENT,
                                                              `papel` ENUM('ADMINISTRADOR', 'PROFESSOR') NOT NULL,
    `login` VARCHAR(45) NOT NULL,
    `nomeCompleto` VARCHAR(200) NOT NULL,
    `senha` VARCHAR(200) NOT NULL,
    `telefone` VARCHAR(45) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `ativo` TINYINT NOT NULL,
    `caminhoImagem` VARCHAR(250) NOT NULL,
    PRIMARY KEY (`idUsuario`),
    UNIQUE INDEX `NomeUsuario_UNIQUE` (`login`))
    ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `projetoIntegrador`.`disciplinas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoIntegrador`.`disciplinas` (
                                                                 `idDisciplina` INT NOT NULL AUTO_INCREMENT,
                                                                 `nomeDisciplina` VARCHAR(45) NOT NULL,
    `cargaHoraria` INT NULL,
    PRIMARY KEY (`idDisciplina`))
    ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `projetoIntegrador`.`turmas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoIntegrador`.`turmas` (
                                                            `idTurma` INT NOT NULL AUTO_INCREMENT,
                                                            `nome` VARCHAR(45) NOT NULL,
    `anoInicio` YEAR NOT NULL,
    `semestre` INT NOT NULL,
    `idDisciplina` INT NOT NULL,
    `idProfessor` INT NOT NULL,
    PRIMARY KEY (`idTurma`),
    INDEX `fk_turmas_disciplinas1_idx` (`idDisciplina` ASC),
    INDEX `fk_turmas_usuarios1_idx` (`idProfessor` ASC),
    CONSTRAINT `fk_turmas_disciplinas1`
    FOREIGN KEY (`idDisciplina`)
    REFERENCES `projetoIntegrador`.`disciplinas` (`idDisciplina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_turmas_usuarios1`
    FOREIGN KEY (`idProfessor`)
    REFERENCES `projetoIntegrador`.`usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `projetoIntegrador`.`ingredientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoIntegrador`.`ingredientes` (
                                                                  `idIngrediente` INT NOT NULL AUTO_INCREMENT,
                                                                  `nome` VARCHAR(45) NOT NULL,
    `unidadeDeMedida` VARCHAR(3) NOT NULL,
    `descricao` VARCHAR(200) NOT NULL,
    `caminhoImagem` VARCHAR(200) NOT NULL,
    PRIMARY KEY (`idIngrediente`))
    ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `projetoIntegrador`.`requisicoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoIntegrador`.`requisicoes` (
                                                                 `idRequisicao` INT NOT NULL AUTO_INCREMENT,
                                                                 `descricao` VARCHAR(200) NULL,
    `dataAula` DATE NOT NULL,
    `statusRequisicao` ENUM('PREENCHIMENTO', 'ENVIADO', 'APROVADO', 'REJEITADO', 'CORRECAO') NOT NULL,
    `idTurma` INT NOT NULL,
    `motivoDevolucao` VARCHAR(300) NULL,
    PRIMARY KEY (`idRequisicao`),
    INDEX `fk_requisicoes_turmas1_idx` (`idTurma` ASC),
    CONSTRAINT `fk_requisicoes_turmas1`
    FOREIGN KEY (`idTurma`)
    REFERENCES `projetoIntegrador`.`turmas` (`idTurma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `projetoIntegrador`.`requisicoesIngredientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoIntegrador`.`requisicoesIngredientes` (
                                                                             `idRequisicaoIngrediente` INT NOT NULL AUTO_INCREMENT,
                                                                             `idRequisicao` INT NOT NULL,
                                                                             `idIngrediente` INT NOT NULL,
                                                                             `quantidade` INT NOT NULL,
                                                                             INDEX `fk_requisicoes_has_ingredientes_ingredientes1_idx` (`idIngrediente` ASC),
    INDEX `fk_requisicoes_has_ingredientes_requisicoes1_idx` (`idRequisicao` ASC),
    PRIMARY KEY (`idRequisicaoIngrediente`),
    CONSTRAINT `fk_requisicoes_has_ingredientes_requisicoes1`
    FOREIGN KEY (`idRequisicao`)
    REFERENCES `projetoIntegrador`.`requisicoes` (`idRequisicao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_requisicoes_has_ingredientes_ingredientes1`
    FOREIGN KEY (`idIngrediente`)
    REFERENCES `projetoIntegrador`.`ingredientes` (`idIngrediente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- Inserir um usuário administrador inicial
INSERT INTO projetoIntegrador.usuarios (papel, login, nomeCompleto, senha, telefone, email, ativo)
VALUES ('ADMINISTRADOR', 'admin', 'Administrador do Sistema', '$2y$10$PrnFrYArQJto/SlnMTFTpOSDKU9XS5PfeHHUvJlzMxeJH5KdnI/Sm', '55555', 'admin@example.com', 1);
