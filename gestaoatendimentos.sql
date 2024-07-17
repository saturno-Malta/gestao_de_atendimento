-- Definir o modo SQL padrão
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';

-- Usar o esquema existente
USE `gestaoatendimentos`;

-- Tabela `perfil`
CREATE TABLE IF NOT EXISTS `perfil` (
  `idPerfil` INT NOT NULL AUTO_INCREMENT,
  `nomePerfil` VARCHAR(255) NOT NULL,
  `dataCadastro` DATETIME NULL,
  `ativo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  PRIMARY KEY (`idPerfil`)
) ENGINE = InnoDB;

-- Inserir dados iniciais na tabela `perfil`, se não existirem
INSERT IGNORE INTO `perfil` (`idPerfil`, `nomePerfil`, `dataCadastro`, `ativo`) VALUES 
(1, 'Administrador', NOW(), 'S');

-- Tabela `usuario`
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nomeUsuario` VARCHAR(255) NOT NULL,
  `emailUsuario` VARCHAR(255) NOT NULL,
  `loginUsuario` VARCHAR(255) NOT NULL,
  `senhaUsuario` VARCHAR(255) NOT NULL,
  `dataCadastro` DATETIME NULL,
  `telefoneCelular` VARCHAR(45) NULL,
  `ativo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  `idPerfil` INT NOT NULL,
  PRIMARY KEY (`idUsuario`),
  INDEX `fk_usuario_perfil1_idx` (`idPerfil` ASC),
  CONSTRAINT `fk_usuario_perfil1`
    FOREIGN KEY (`idPerfil`)
    REFERENCES `perfil` (`idPerfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- Tabela `sessao`
CREATE TABLE IF NOT EXISTS `sessao` (
  `idSessao` INT NOT NULL AUTO_INCREMENT,
  `nomeSessao` VARCHAR(255) NOT NULL,
  `dataCadastro` DATETIME NULL,
  PRIMARY KEY (`idSessao`)
) ENGINE = InnoDB;

-- Tabela `perfilsessao`
CREATE TABLE IF NOT EXISTS `perfilsessao` (
  `idPerfil` INT NOT NULL,
  `idSessao` INT NOT NULL,
  PRIMARY KEY (`idPerfil`, `idSessao`),
  INDEX `fk_perfil_has_sessao_sessao1_idx` (`idSessao` ASC),
  INDEX `fk_perfil_has_sessao_perfil1_idx` (`idPerfil` ASC),
  CONSTRAINT `fk_perfil_has_sessao_perfil1`
    FOREIGN KEY (`idPerfil`)
    REFERENCES `perfil` (`idPerfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfil_has_sessao_sessao1`
    FOREIGN KEY (`idSessao`)
    REFERENCES `sessao` (`idSessao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- Tabela `formaatendimento`
CREATE TABLE IF NOT EXISTS `formaatendimento` (
  `idFormaAtendimento` INT NOT NULL AUTO_INCREMENT,
  `idUsuario` INT NOT NULL,
  `nomeAtendimento` VARCHAR(255) NOT NULL,
  `dataCadastro` DATETIME NOT NULL,
  `ativo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  PRIMARY KEY (`idFormaAtendimento`),
  INDEX `fk_formaatendimento_usuario1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_formaatendimento_usuario1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;



-- Tabela `publico`
CREATE TABLE IF NOT EXISTS `publico` (
  `idPublico` INT NOT NULL AUTO_INCREMENT,
  `idUsuario` INT NOT NULL,
  `nomePublico` VARCHAR(255) NOT NULL,
  `dataCadastro` DATETIME NOT NULL,
  `ativo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  PRIMARY KEY (`idPublico`, `idUsuario`),
  INDEX `fk_publico_usuario1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_publico_usuario1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- Tabela `perguntapublico`
CREATE TABLE IF NOT EXISTS `perguntapublico` (
  `idPerguntaPublico` INT NOT NULL AUTO_INCREMENT,
  `idPublico` INT NOT NULL,
  `idUsuario` INT NOT NULL,
  `descricaoPergunta` TEXT NOT NULL,
  `dataCadastro` DATETIME NOT NULL,
  `ativo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  PRIMARY KEY (`idPerguntaPublico`, `idPublico`, `idUsuario`),
  INDEX `fk_perguntapublico_publico1_idx` (`idPublico` ASC),
  INDEX `fk_perguntapublico_usuario1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_perguntapublico_publico1`
    FOREIGN KEY (`idPublico`)
    REFERENCES `publico` (`idPublico`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_perguntapublico_usuario1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- Tabela `atendimento`
CREATE TABLE IF NOT EXISTS `atendimento` (
  `idAtendimento` INT NOT NULL AUTO_INCREMENT,
  `idFormaAtendimento` INT NOT NULL,
  `idPerguntaPublico` INT NOT NULL,
  `idUsuario` INT NOT NULL,
  `dataCadastro` DATETIME NOT NULL,
  `ativo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  `respostaAtendimento` TEXT NOT NULL,
  PRIMARY KEY (`idAtendimento`),
  INDEX `fk_atendimento_formaatendimento1_idx` (`idFormaAtendimento` ASC),
  INDEX `fk_atendimento_perguntapublico1_idx` (`idPerguntaPublico` ASC),
  INDEX `fk_atendimento_usuario1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_atendimento_formaatendimento1`
    FOREIGN KEY (`idFormaAtendimento`)
    REFERENCES `formaatendimento` (`idFormaAtendimento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_atendimento_perguntapublico1`
    FOREIGN KEY (`idPerguntaPublico`)
    REFERENCES `perguntapublico` (`idPerguntaPublico`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_atendimento_usuario1`usuario
    FOREIGN KEY (`idUsuario`)
    REFERENCES `usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- Tabela `tipoatendimento`
CREATE TABLE IF NOT EXISTS `tipoatendimento` (
  `idTipoAtendimento` INT NOT NULL AUTO_INCREMENT,
  `nomeTipo` VARCHAR(255) NOT NULL,
  `dataCadastro` DATETIME NULL,
  `ativo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  PRIMARY KEY (`idTipoAtendimento`)
) ENGINE = InnoDB;




