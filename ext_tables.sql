#
# Adds YouTube Video fields to the tt_content table
#
CREATE TABLE tt_content (
	tx_youtubevideo_url tinytext,
	tx_youtubevideo_caption tinytext,
	tx_youtubevideo_autoplay tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_youtubevideo_rel tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_youtubevideo_startminute int(11) DEFAULT '0',
	tx_youtubevideo_startsecond int(11) DEFAULT '0',
	tx_youtubevideo_ratio tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_youtubevideo_fullscreen tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_youtubevideo_loop tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_youtubevideo_covertitle tinytext,
	tx_youtubevideo_covertext tinytext
);
