-- MySQL Script generated by MySQL Workbench
-- Mon Apr 11 10:29:21 2016
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema cake3_demoapp
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `cms_content_statues`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_content_statues` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `params` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cms_content_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_content_types` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NULL DEFAULT NULL,
  `description` LONGTEXT NULL DEFAULT NULL,
  `params` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cms_sites`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_sites` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `domain` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cms_contents`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_contents` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `parent_id` INT(11) NULL DEFAULT '0',
  `name` VARCHAR(255) NOT NULL,
  `content_title` VARCHAR(255) NOT NULL,
  `content_description` LONGTEXT NULL DEFAULT NULL,
  `content_excerpt` TEXT NULL DEFAULT NULL,
  `content_expiry` DATETIME NULL DEFAULT NULL,
  `content_password` VARCHAR(255) NULL DEFAULT NULL,
  `cms_content_status_id` INT(11) NOT NULL DEFAULT '1',
  `content_path` VARCHAR(255) NULL DEFAULT NULL,
  `cms_content_type_id` INT(11) NOT NULL DEFAULT '1',
  `content_mime_type` VARCHAR(255) NULL DEFAULT NULL,
  `publish_start` DATETIME NOT NULL,
  `publish_end` DATETIME NOT NULL,
  `cms_site_id` INT(11) NOT NULL DEFAULT '1',
  `guid` VARCHAR(255) NULL,
  `author_id` INT NULL DEFAULT '0',
  `menu_order` INT(11) NULL DEFAULT '0',
  `created` TIMESTAMP NULL DEFAULT NULL,
  `created_by` INT NULL DEFAULT '0',
  `modified` DATETIME NULL DEFAULT NULL,
  `modified_by` INT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `cms_content_statues_key1_idx` (`cms_content_status_id` ASC),
  INDEX `cms_content_types_key1_idx` (`cms_content_type_id` ASC),
  INDEX `fk_cms_sites1_idx` (`cms_site_id` ASC),
  CONSTRAINT `fk_cms_contents_cms_content_statues`
    FOREIGN KEY (`cms_content_status_id`)
    REFERENCES `cms_content_statues` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cms_contents_cms_content_types`
    FOREIGN KEY (`cms_content_type_id`)
    REFERENCES `cms_content_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cms_contents_cms_sites`
    FOREIGN KEY (`cms_site_id`)
    REFERENCES `cms_sites` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cms_content_options`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_content_options` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `cms_content_id` BIGINT(20) NOT NULL,
  `option_key` VARCHAR(255) NOT NULL,
  `option_value` LONGTEXT NOT NULL,
  `menu_order` INT(11) NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `fk_cms_contents2_idx` (`cms_content_id` ASC),
  CONSTRAINT `fk_cms_contents_cms_content_options`
    FOREIGN KEY (`cms_content_id`)
    REFERENCES `cms_contents` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cms_site_options`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_site_options` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cms_site_id` INT(11) NOT NULL,
  `option_key` VARCHAR(255) NOT NULL,
  `option_value` LONGTEXT NOT NULL,
  `menu_order` INT(11) NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `cms_sites_key2_idx` (`cms_site_id` ASC),
  CONSTRAINT `fk_csm_site_options_cms_sites`
    FOREIGN KEY (`cms_site_id`)
    REFERENCES `cms_sites` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cms_term_taxonomy_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_term_taxonomy_types` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NULL DEFAULT NULL,
  `description` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cms_terms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_terms` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cms_site_id` INT(11) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `params` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `name` (`name` ASC),
  INDEX `cms_sites_key1_idx` (`cms_site_id` ASC),
  CONSTRAINT `fk_cms_terms_cms_sites`
    FOREIGN KEY (`cms_site_id`)
    REFERENCES `cms_sites` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cms_term_taxonomies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_term_taxonomies` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `parent_id` BIGINT(20) NULL DEFAULT '0',
  `cms_term_id` INT(11) NOT NULL,
  `cms_term_taxonomy_type_id` INT(11) NOT NULL,
  `title` VARCHAR(255) NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `count` BIGINT(20) NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `parent_id` (`parent_id` ASC),
  INDEX `fk_cms_terms1_idx` (`cms_term_id` ASC),
  INDEX `fk_cms_term_taxonomies_cms_term_taxonomy_types1_idx` (`cms_term_taxonomy_type_id` ASC),
  CONSTRAINT `fk_cms_term_taxonomies_cms_terms`
    FOREIGN KEY (`cms_term_id`)
    REFERENCES `cms_terms` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cms_term_taxonomies_cms_term_taxonomy_types1`
    FOREIGN KEY (`cms_term_taxonomy_type_id`)
    REFERENCES `cms_term_taxonomy_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cms_term_relationships`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_term_relationships` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `cms_content_id` BIGINT(20) NOT NULL,
  `cms_term_taxonomy_id` BIGINT(20) NOT NULL,
  `menu_order` INT(11) NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `fk_cms_contents1_idx` (`cms_content_id` ASC),
  INDEX `fk_cms_term_taxonomy1_idx` (`cms_term_taxonomy_id` ASC),
  CONSTRAINT `fk_cms_term_relationships_cms_contents`
    FOREIGN KEY (`cms_content_id`)
    REFERENCES `cms_contents` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cms_term_relationships_cms_term_taxonomy`
    FOREIGN KEY (`cms_term_taxonomy_id`)
    REFERENCES `cms_term_taxonomies` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `route` VARCHAR(255) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `created` TIMESTAMP NULL DEFAULT NULL,
  `modified` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `roles_tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `roles_tasks` (
  `role_id` INT(11) NOT NULL,
  `task_id` INT(11) NOT NULL,
  PRIMARY KEY (`role_id`, `task_id`),
  INDEX `tasks_key1_idx` (`task_id` ASC),
  INDEX `roles_key2_idx` (`role_id` ASC),
  CONSTRAINT `roles_key2`
    FOREIGN KEY (`role_id`)
    REFERENCES `roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `tasks_key1`
    FOREIGN KEY (`task_id`)
    REFERENCES `tasks` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `users_roles` (
  `user_id` INT(11) NOT NULL,
  `role_id` INT(11) NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`),
  INDEX `roles_key1_idx` (`role_id` ASC),
  INDEX `users_key_idx` (`user_id` ASC),
  CONSTRAINT `roles_key1`
    FOREIGN KEY (`role_id`)
    REFERENCES `roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `users_key`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cms_term_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_term_users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cms_term_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `params` LONGTEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cms_term_users_cms_terms1_idx` (`cms_term_id` ASC),
  INDEX `fk_cms_term_users_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_cms_term_users_cms_terms1`
    FOREIGN KEY (`cms_term_id`)
    REFERENCES `cms_terms` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cms_term_users_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cms_term_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_term_roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cms_terms_id` INT(11) NOT NULL,
  `roles_id` INT(11) NOT NULL,
  `params` LONGTEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cms_term_roles_cms_terms1_idx` (`cms_terms_id` ASC),
  INDEX `fk_cms_term_roles_roles1_idx` (`roles_id` ASC),
  CONSTRAINT `fk_cms_term_roles_cms_terms1`
    FOREIGN KEY (`cms_terms_id`)
    REFERENCES `cms_terms` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cms_term_roles_roles1`
    FOREIGN KEY (`roles_id`)
    REFERENCES `roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cms_site_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_site_users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cms_site_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `params` LONGTEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cms_site_users_cms_sites1_idx` (`cms_site_id` ASC),
  INDEX `fk_cms_site_users_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_cms_site_users_cms_sites1`
    FOREIGN KEY (`cms_site_id`)
    REFERENCES `cms_sites` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cms_site_users_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cms_site_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_site_roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cms_sites_id` INT(11) NOT NULL,
  `roles_id` INT(11) NOT NULL,
  `params` LONGTEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cms_site_roles_cms_sites1_idx` (`cms_sites_id` ASC),
  INDEX `fk_cms_site_roles_roles1_idx` (`roles_id` ASC),
  CONSTRAINT `fk_cms_site_roles_cms_sites1`
    FOREIGN KEY (`cms_sites_id`)
    REFERENCES `cms_sites` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cms_site_roles_roles1`
    FOREIGN KEY (`roles_id`)
    REFERENCES `roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cms_content_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_content_users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cms_contents_id` BIGINT(20) NOT NULL,
  `users_id` INT(11) NOT NULL,
  `params` LONGTEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cms_content_users_cms_contents1_idx` (`cms_contents_id` ASC),
  INDEX `fk_cms_content_users_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_cms_content_users_cms_contents1`
    FOREIGN KEY (`cms_contents_id`)
    REFERENCES `cms_contents` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cms_content_users_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cms_content_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cms_content_roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cms_contents_id` BIGINT(20) NOT NULL,
  `roles_id` INT(11) NOT NULL,
  `params` LONGTEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cms_content_roles_cms_contents1_idx` (`cms_contents_id` ASC),
  INDEX `fk_cms_content_roles_roles1_idx` (`roles_id` ASC),
  CONSTRAINT `fk_cms_content_roles_cms_contents1`
    FOREIGN KEY (`cms_contents_id`)
    REFERENCES `cms_contents` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cms_content_roles_roles1`
    FOREIGN KEY (`roles_id`)
    REFERENCES `roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--
-- Dump dei dati per la tabella `cms_content_statues`
--

INSERT INTO `cms_content_statues` (`id`, `name`, `title`, `description`, `params`) VALUES
(1, 'draft', 'Draft', '', ''),
(2, 'publish', 'Publish', '', ''),
(3, 'inherit', 'Inherit', '', ''),
(4, 'revision', 'Revision', '', '');

--
-- Dump dei dati per la tabella `cms_content_types`
--

INSERT INTO `cms_content_types` (`id`, `name`, `title`, `description`, `params`) VALUES
(1, 'page', 'Page', '', ''),
(2, 'news', 'News', '', ''),
(3, 'attached', 'Attached', '', ''),
(4, 'image', 'Image', '', '');

--
-- Dump dei dati per la tabella `cms_sites`
--

INSERT INTO `cms_sites` (`id`, `name`, `domain`) VALUES
(1, 'default', 'default');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;