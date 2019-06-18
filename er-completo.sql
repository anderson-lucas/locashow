-- -----------------------------------------------------
-- Schema db_locashow
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_locashow` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `db_locashow` ;

-- -----------------------------------------------------
-- Table `db_locashow`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_locashow`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cpf_cnpj` VARCHAR(14) NOT NULL,
  `email` VARCHAR(100) NULL,
  `telefone` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf_cnpj_UNIQUE` (`cpf_cnpj` ASC)
);


-- -----------------------------------------------------
-- Table `db_locashow`.`cliente_endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_locashow`.`cliente_endereco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cliente_id` INT NOT NULL,
  `cep` VARCHAR(45) NOT NULL,
  `logradouro` VARCHAR(45) NOT NULL,
  `complemento` VARCHAR(45) NULL,
  `bairro` VARCHAR(45) NOT NULL,
  `localidade` VARCHAR(45) NOT NULL,
  `uf` VARCHAR(2) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_cliente_endereco_cliente1_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_cliente_endereco_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `db_locashow`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);


-- -----------------------------------------------------
-- Table `db_locashow`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_locashow`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)
);


-- -----------------------------------------------------
-- Table `db_locashow`.`imovel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_locashow`.`imovel` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cliente_id` INT NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `cep` VARCHAR(45) NOT NULL,
  `logradouro` VARCHAR(45) NOT NULL,
  `complemento` VARCHAR(100) NULL,
  `bairro` VARCHAR(45) NOT NULL,
  `localidade` VARCHAR(45) NOT NULL,
  `uf` VARCHAR(2) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_imovel_cliente1_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_imovel_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `db_locashow`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);


-- -----------------------------------------------------
-- Table `db_locashow`.`imovel_imagem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_locashow`.`imovel_imagem` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `imovel_id` INT NOT NULL,
  `full_path` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `full_path_UNIQUE` (`full_path` ASC),
  INDEX `fk_imovel_imagem_imovel1_idx` (`imovel_id` ASC),
  CONSTRAINT `fk_imovel_imagem_imovel1`
    FOREIGN KEY (`imovel_id`)
    REFERENCES `db_locashow`.`imovel` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);


-- -----------------------------------------------------
-- Table `db_locashow`.`contrato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_locashow`.`contrato` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cliente_id` INT NOT NULL,
  `imovel_id` INT NOT NULL,
  `tipo` ENUM('L', 'V') NOT NULL COMMENT 'L = Locação / V = Venda',
  `valor` DECIMAL(19,2) NOT NULL,
  `dt_vencimento` DATE NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT 'A',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_contrato_cliente1_idx` (`cliente_id` ASC),
  INDEX `fk_contrato_imovel1_idx` (`imovel_id` ASC),
  CONSTRAINT `fk_contrato_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `db_locashow`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contrato_imovel1`
    FOREIGN KEY (`imovel_id`)
    REFERENCES `db_locashow`.`imovel` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);


-- -----------------------------------------------------
-- Table `db_locashow`.`menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_locashow`.`menu` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `link` VARCHAR(45) NOT NULL,
  `icone` VARCHAR(45) NOT NULL,
  `ordem` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);


-- -----------------------------------------------------
-- Table `db_locashow`.`grupo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_locashow`.`grupo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);


-- -----------------------------------------------------
-- Table `db_locashow`.`usuario_grupo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_locashow`.`usuario_grupo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `grupo_id` INT NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`, `grupo_id`),
  INDEX `fk_usuario_grupo_usuario1_idx` (`usuario_id` ASC),
  INDEX `fk_usuario_grupo_grupo1_idx` (`grupo_id` ASC),
  CONSTRAINT `fk_usuario_grupo_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `db_locashow`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_grupo_grupo1`
    FOREIGN KEY (`grupo_id`)
    REFERENCES `db_locashow`.`grupo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);


-- -----------------------------------------------------
-- Table `db_locashow`.`grupo_menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_locashow`.`grupo_menu` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `grupo_id` INT NOT NULL,
  `menu_id` INT NOT NULL,
  PRIMARY KEY (`id`, `grupo_id`, `menu_id`),
  INDEX `fk_grupo_menu_grupo1_idx` (`grupo_id` ASC),
  INDEX `fk_grupo_menu_menu1_idx` (`menu_id` ASC),
  CONSTRAINT `fk_grupo_menu_grupo1`
    FOREIGN KEY (`grupo_id`)
    REFERENCES `db_locashow`.`grupo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupo_menu_menu1`
    FOREIGN KEY (`menu_id`)
    REFERENCES `db_locashow`.`menu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);


-- -----------------------------------------------------
-- Table `db_locashow`.`log_acesso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_locashow`.`log_acesso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`, `usuario_id`),
  INDEX `fk_log_acesso_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_log_acesso_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `db_locashow`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);


-- -----------------------------------------------------
-- Table `db_locashow`.`boleto_cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_locashow`.`boleto_cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `contrato_id` INT NOT NULL,
  `cliente_id` INT NOT NULL,
  `valor` DECIMAL(19,2) NOT NULL,
  `dt_vencimento` DATE NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_boleto_cliente_contrato1_idx` (`contrato_id` ASC),
  CONSTRAINT `fk_boleto_cliente_contrato1`
    FOREIGN KEY (`contrato_id`)
    REFERENCES `db_locashow`.`contrato` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

INSERT INTO `usuario` (`login`, `password`, `email`, `nome`)
VALUES
('anderson.rosa', md5(123), 'anderson.lucasrosa@gmail.com', 'Anderson Lucas'),
('gabriel.deluca', md5(123), 'gabriel.deluca@gmail.com', 'Gabriel De Luca'),
('admin', md5('admin'), 'admin@gmail.com', 'Administrador');

INSERT INTO `cliente` (`nome`,`cpf_cnpj`,`email`,`telefone`) 
VALUES
("Plato Humphrey","1618072242699","risus.Donec@Maurisblandit.ca","1-161-453-9021"),
("Joshua Hampton","1653072298199","in.magna@vulputateveliteu.ca","1-673-796-6928"),
("Emmanuel Buck","1698092317599","Nunc.mauris.sapien@at.com","1-111-579-8046"),
("Austin Mcbride","1614011673199","in.molestie.tortor@velquam.net","1-504-899-3085"),
("Oliver Aguirre","1610101484599","euismod.mauris@dictumsapien.co.uk","1-960-991-8951"),
("Jack Mcintosh","1630100463199","eu.tellus@Fuscealiquetmagna.org","1-591-882-4797"),
("Alden Wooten","1641051989199","sed@consequatauctornunc.net","1-684-572-9713"),
("Valentine Dyer","1690062490799","tempus.non@diamat.com","1-595-698-3431"),
("Yuli Mcdowell","1685061310399","pellentesque@incursus.net","1-699-571-3232"),
("Lawrence Romero","1672052236999","egestas@ipsumportaelit.com","1-802-141-6294");

INSERT INTO `menu` (`nome`,`link`,`icone`,`ordem`) 
VALUES
("Home", "home",  "fas fa-home", 1),
("Clientes", "clientes",  "fas fa-users", 2),
("Imóveis", "imoveis", "fas fa-building", 3),
("Contratos", "contratos", "fas fa-file-contract", 4),
("Configurações", "configuracoes", "fas fa-cog", 5),
("Teste Api", "teste_api", "fas fa-code", 6);

INSERT INTO `grupo` (`nome`) 
VALUES
("Admin"),
("Gerente"),
("Usuário");

INSERT INTO `grupo_menu` (`grupo_id`, `menu_id`)
VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 2);

INSERT INTO `usuario_grupo` (`usuario_id`, `grupo_id`)
VALUES
(3, 1),
(3, 2),
(3, 3),
(2, 3),
(1, 2),
(1, 3);

-- ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';