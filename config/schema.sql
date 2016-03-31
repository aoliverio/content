-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2016 alle 15:39
-- Versione del server: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `plugin content`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_contents`
--

CREATE TABLE `cms_contents` (
`id` bigint(20) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
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
  `author_id` int(11) NOT NULL DEFAULT '0',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_id` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_content_meta`
--

CREATE TABLE `cms_content_meta` (
`id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `metakey` varchar(255) NOT NULL,
  `metavalue` longtext NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_links`
--

CREATE TABLE `cms_links` (
`id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `target` varchar(55) NOT NULL,
  `image` varchar(255) NOT NULL,
  `rel` varchar(255) NOT NULL,
  `rss` varchar(255) NOT NULL,
  `notes` mediumtext NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `created_id` bigint(20) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  `modified_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_menus`
--

CREATE TABLE `cms_menus` (
`id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `link_count` int(11) NOT NULL,
  `params` text COLLATE utf8_unicode_ci,
  `publish_start` datetime DEFAULT NULL,
  `publish_end` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_id` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_terms`
--

CREATE TABLE `cms_terms` (
`id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_term_permissions`
--

CREATE TABLE `cms_term_permissions` (
`id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `allow` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_term_relationships`
--

CREATE TABLE `cms_term_relationships` (
`id` bigint(20) NOT NULL,
  `content_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_term_taxonomy`
--

CREATE TABLE `cms_term_taxonomy` (
`id` bigint(20) unsigned NOT NULL,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_contents`
--
ALTER TABLE `cms_contents`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `cms_content_meta`
--
ALTER TABLE `cms_content_meta`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_links`
--
ALTER TABLE `cms_links`
 ADD PRIMARY KEY (`id`), ADD KEY `visible` (`visible`);

--
-- Indexes for table `cms_menus`
--
ALTER TABLE `cms_menus`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `menu_alias` (`name`);

--
-- Indexes for table `cms_terms`
--
ALTER TABLE `cms_terms`
 ADD PRIMARY KEY (`id`), ADD KEY `name` (`name`);

--
-- Indexes for table `cms_term_permissions`
--
ALTER TABLE `cms_term_permissions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_term_relationships`
--
ALTER TABLE `cms_term_relationships`
 ADD PRIMARY KEY (`id`), ADD KEY `content_id` (`content_id`), ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `cms_term_taxonomy`
--
ALTER TABLE `cms_term_taxonomy`
 ADD PRIMARY KEY (`id`), ADD KEY `parent_id` (`parent_id`), ADD KEY `term_id` (`term_id`), ADD KEY `taxonomy` (`taxonomy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_contents`
--
ALTER TABLE `cms_contents`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms_content_meta`
--
ALTER TABLE `cms_content_meta`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms_links`
--
ALTER TABLE `cms_links`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms_menus`
--
ALTER TABLE `cms_menus`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms_terms`
--
ALTER TABLE `cms_terms`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms_term_permissions`
--
ALTER TABLE `cms_term_permissions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms_term_relationships`
--
ALTER TABLE `cms_term_relationships`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms_term_taxonomy`
--
ALTER TABLE `cms_term_taxonomy`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;