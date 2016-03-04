-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 04, 2016 alle 19:02
-- Versione del server: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cake3_content`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_content`
--

CREATE TABLE `cms_content` (
`id` bigint(20) NOT NULL,
  `parent` bigint(20) DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `content_title` varchar(255) NOT NULL,
  `content_description` longtext NOT NULL,
  `content_excerpt` text NOT NULL,
  `content_deadline` datetime NOT NULL,
  `content_password` varchar(55) NOT NULL,
  `content_status` varchar(55) NOT NULL,
  `content_path` varchar(255) NOT NULL,
  `content_type` varchar(55) NOT NULL,
  `content_mime_type` varchar(255) NOT NULL,
  `publish_start` datetime NOT NULL,
  `publish_end` datetime NOT NULL,
  `author` int(11) NOT NULL DEFAULT '0',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_content_meta`
--

CREATE TABLE `cms_content_meta` (
`id` int(11) NOT NULL,
  `cms_content_id` bigint(20) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user` int(11) NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_permission`
--

CREATE TABLE `cms_permission` (
`id` int(11) NOT NULL,
  `cms_content_id` bigint(20) NOT NULL DEFAULT '0',
  `cms_term_id` bigint(20) NOT NULL DEFAULT '0',
  `sys_user_id` int(11) NOT NULL DEFAULT '0',
  `sys_role_id` int(11) NOT NULL DEFAULT '0',
  `allow` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user` int(11) NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_term`
--

CREATE TABLE `cms_term` (
`id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_term_relation`
--

CREATE TABLE `cms_term_relation` (
`id` bigint(20) NOT NULL,
  `cms_term_taxonomy_id` bigint(20) unsigned NOT NULL,
  `cms_content_id` bigint(20) NOT NULL,
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_term_taxonomy`
--

CREATE TABLE `cms_term_taxonomy` (
`id` bigint(20) unsigned NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `cms_term_id` bigint(20) unsigned NOT NULL,
  `taxonomy` varchar(32) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `count` bigint(20) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user` int(11) NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_content`
--
ALTER TABLE `cms_content`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `cms_content_meta`
--
ALTER TABLE `cms_content_meta`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_cms_content_meta_cms_content1_idx` (`cms_content_id`);

--
-- Indexes for table `cms_permission`
--
ALTER TABLE `cms_permission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_term`
--
ALTER TABLE `cms_term`
 ADD PRIMARY KEY (`id`), ADD KEY `name` (`name`);

--
-- Indexes for table `cms_term_relation`
--
ALTER TABLE `cms_term_relation`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_cms_term_relation_cms_term_taxonomy1_idx` (`cms_term_taxonomy_id`), ADD KEY `fk_cms_term_relation_cms_content1_idx` (`cms_content_id`);

--
-- Indexes for table `cms_term_taxonomy`
--
ALTER TABLE `cms_term_taxonomy`
 ADD PRIMARY KEY (`id`), ADD KEY `taxonomy` (`taxonomy`), ADD KEY `fk_cms_term_taxonomy_cms_term1_idx` (`cms_term_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_content`
--
ALTER TABLE `cms_content`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49766;
--
-- AUTO_INCREMENT for table `cms_content_meta`
--
ALTER TABLE `cms_content_meta`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cms_permission`
--
ALTER TABLE `cms_permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cms_term`
--
ALTER TABLE `cms_term`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `cms_term_relation`
--
ALTER TABLE `cms_term_relation`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `cms_term_taxonomy`
--
ALTER TABLE `cms_term_taxonomy`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `cms_content_meta`
--
ALTER TABLE `cms_content_meta`
ADD CONSTRAINT `fk_cms_content_meta_cms_content1` FOREIGN KEY (`cms_content_id`) REFERENCES `cms_content` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `cms_term_relation`
--
ALTER TABLE `cms_term_relation`
ADD CONSTRAINT `fk_cms_term_relation_cms_content1` FOREIGN KEY (`cms_content_id`) REFERENCES `cms_content` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_cms_term_relation_cms_term_taxonomy1` FOREIGN KEY (`cms_term_taxonomy_id`) REFERENCES `cms_term_taxonomy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `cms_term_taxonomy`
--
ALTER TABLE `cms_term_taxonomy`
ADD CONSTRAINT `fk_cms_term_taxonomy_cms_term1` FOREIGN KEY (`cms_term_id`) REFERENCES `cms_term` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

