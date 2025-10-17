ALTER TABLE `#__jma_frequencies` CHANGE `created_by` `created_by` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `#__jma_frequencies` CHANGE `ordering` `ordering` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `#__jma_frequencies` CHANGE `checked_out` `checked_out` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `#__jma_frequencies` CHANGE `checked_out_time` `checked_out_time` datetime DEFAULT NULL;

ALTER TABLE `#__jma_alerts` CHANGE `created_by` `created_by` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `#__jma_alerts` CHANGE `ordering` `ordering` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `#__jma_alerts` CHANGE `checked_out` `checked_out` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `#__jma_alerts` CHANGE `checked_out_time` `checked_out_time` datetime DEFAULT NULL;

ALTER TABLE `#__jma_subscribers` CHANGE `ordering` `ordering` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `#__jma_subscribers` CHANGE `date` `date` datetime DEFAULT NULL;
