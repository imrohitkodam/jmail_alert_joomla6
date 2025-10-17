--
-- Table structure for table '__jma_frequencies'
--

CREATE TABLE IF NOT EXISTS `#__jma_frequencies` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) DEFAULT '0',
  `checked_out_time` datetime DEFAULT NULL,
  `name` varchar(250)  NOT NULL ,
  `time_measure` varchar(255)  NOT NULL ,
  `duration` int(3)  NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table '__jma_alerts'
--

CREATE TABLE IF NOT EXISTS `#__jma_alerts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255)  NOT NULL ,
  `description` text NOT NULL ,
  `allow_users_select_plugins` varchar(255)  NOT NULL ,
  `respect_last_email_date` varchar(255)  NOT NULL ,
  `is_default` varchar(255)  NOT NULL ,
  `usergroup` varchar(255) DEFAULT NULL,
  `allowed_freq` varchar(255)  NOT NULL ,
  `default_freq` varchar(255)  NOT NULL ,
  `batch_size` int(255) NOT NULL,
  `enable_batch` tinyint(1) NOT NULL DEFAULT '1',
  `email_subject` varchar(255)  NOT NULL ,
  `template` text NOT NULL ,
  `template_css` text NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `#__jma_subscribers`
--

CREATE TABLE IF NOT EXISTS `#__jma_subscribers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `alert_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `frequency` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `plugins_subscribed_to` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=0;


--
-- Table structure for table '__jma_old_sync_data'
--

CREATE TABLE IF NOT EXISTS `#__jma_old_sync_data`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`date` datetime NOT NULL,
	`alert_id` int(11) NOT NULL,
	`plugin` varchar(255) NOT NULL,
	`plg_data` text NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=0;
