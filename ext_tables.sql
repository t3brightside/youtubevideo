#
# Adds YouTube Video fields to the tt_content table
#
CREATE TABLE tt_content (
	tx_youtubevideo_assets int(1) DEFAULT '0' NOT NULL,
	tx_youtubevideo_colcount int(1) DEFAULT '0' NOT NULL,
	tx_youtubevideo_oneatatime int(1) DEFAULT '0' NOT NULL,
	tx_youtubevideo_titles int(1) DEFAULT '0' NOT NULL,
	tx_youtubevideo_descriptions int(1) DEFAULT '0' NOT NULL,
);


CREATE TABLE sys_file_reference (
	tx_youtubevideo_autoplay tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_youtubevideo_rel tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_youtubevideo_starttime varchar(10),
	tx_youtubevideo_endtime varchar(10),
	tx_youtubevideo_ratio tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_youtubevideo_fullscreen tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_youtubevideo_loop tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_youtubevideo_mute tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_youtubevideo_coverimage int(1) DEFAULT '0' NOT NULL,
);
