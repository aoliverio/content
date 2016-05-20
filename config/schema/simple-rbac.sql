-- --------------------------------------------------------
-- BUILDER SECTION
-- --------------------------------------------------------

--
-- Struttura della tabella `roles`
--

CREATE TABLE `roles` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created` timestamp NULL DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Administrator', 'System Administrator', '2016-03-27 15:14:27', '2016-03-27 17:24:55');

-- --------------------------------------------------------

--
-- Struttura della tabella `roles_tasks`
--

CREATE TABLE `roles_tasks` (
  `role_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `roles_tasks`
--

INSERT INTO `roles_tasks` (`role_id`, `task_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tasks`
--

CREATE TABLE `tasks` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `route` text NOT NULL,
  `description` text,
  `created` timestamp NULL DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `route`, `description`, `created`, `modified`) VALUES
(1, 'All', '/', 'Access at application root', '2016-03-27 15:15:36', '2016-03-29 07:53:34');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_blocked` tinyint(1) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `is_blocked`, `created`, `modified`) VALUES
(1, 'Administrator', 'admin@admin.com', 'admin', '$2y$10$VwqZLVzKMiP09q5BVMK6LueyGanfPMTCPs1vSJkAO6bbPRIdjll7a', 0, '2016-03-27 15:13:06', '2016-03-27 18:52:12');

-- --------------------------------------------------------

--
-- Struttura della tabella `users_roles`
--

CREATE TABLE `users_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users_roles`
--

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_tasks`
--
ALTER TABLE `roles_tasks`
 ADD PRIMARY KEY (`role_id`,`task_id`), ADD KEY `tasks_key1_idx` (`task_id`), ADD KEY `roles_key2_idx` (`role_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
 ADD PRIMARY KEY (`user_id`,`role_id`), ADD KEY `roles_key1_idx` (`role_id`), ADD KEY `users_key_idx` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `roles_tasks`
--
ALTER TABLE `roles_tasks`
ADD CONSTRAINT `roles_key2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `tasks_key1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `users_roles`
--
ALTER TABLE `users_roles`
ADD CONSTRAINT `roles_key1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `users_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
