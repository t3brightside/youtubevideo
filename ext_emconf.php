<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "youtubevideo".
 *
 * Auto generated | Identifier: 359877b295bfc26ae5da22f89a41c88b
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'YouTube Video',
	'description' => 'Easy to use YouTube video content element with responsive template, cover image and backend preview.',
	'category' => 'fe',
	'version' => '1.2.3',
	'state' => 'stable',
	'uploadfolder' => false,
	'createDirs' => '',
	'clearcacheonload' => true,
	'author' => 'Tanel Põld',
	'author_email' => 'tanel@brightside.ee',
	'author_company' => 'Brightside OÜ / t3brightside.com',
	'constraints' => 
	array (
		'depends' => 
		array (
			'typo3' => '8.7.0-9.9.99',
			'fluid_styled_content' => '',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
	'_md5_values_when_last_written' => 'a:113:{s:14:"Configuration/";s:4:"d41d";s:18:"Configuration/TCA/";s:4:"d41d";s:28:"Configuration/TCA/Overrides/";s:4:"d41d";s:44:"Configuration/TCA/Overrides/sys_template.php";s:4:"83c6";s:9:"__MACOSX/";s:4:"d41d";s:23:"__MACOSX/Configuration/";s:4:"d41d";s:27:"__MACOSX/Configuration/TCA/";s:4:"d41d";s:37:"__MACOSX/Configuration/TCA/Overrides/";s:4:"d41d";s:55:"__MACOSX/Configuration/TCA/Overrides/._sys_template.php";s:4:"b4f2";s:42:"Configuration/TCA/Overrides/tt_content.php";s:4:"48f4";s:53:"__MACOSX/Configuration/TCA/Overrides/._tt_content.php";s:4:"b4f2";s:38:"__MACOSX/Configuration/TCA/._Overrides";s:4:"b4f2";s:28:"__MACOSX/Configuration/._TCA";s:4:"b4f2";s:22:"Configuration/Backend/";s:4:"d41d";s:29:"Configuration/Backend/Styles/";s:4:"d41d";s:40:"Configuration/Backend/Styles/default.css";s:4:"64b4";s:31:"__MACOSX/Configuration/Backend/";s:4:"d41d";s:38:"__MACOSX/Configuration/Backend/Styles/";s:4:"d41d";s:51:"__MACOSX/Configuration/Backend/Styles/._default.css";s:4:"b4f2";s:39:"__MACOSX/Configuration/Backend/._Styles";s:4:"b4f2";s:32:"__MACOSX/Configuration/._Backend";s:4:"b4f2";s:25:"Configuration/TypoScript/";s:4:"d41d";s:33:"Configuration/TypoScript/setup.ts";s:4:"c35b";s:34:"__MACOSX/Configuration/TypoScript/";s:4:"d41d";s:44:"__MACOSX/Configuration/TypoScript/._setup.ts";s:4:"b4f2";s:37:"Configuration/TypoScript/constants.ts";s:4:"7752";s:48:"__MACOSX/Configuration/TypoScript/._constants.ts";s:4:"b4f2";s:35:"__MACOSX/Configuration/._TypoScript";s:4:"b4f2";s:21:"Configuration/PageTS/";s:4:"d41d";s:29:"Configuration/PageTS/setup.ts";s:4:"94f7";s:30:"__MACOSX/Configuration/PageTS/";s:4:"d41d";s:40:"__MACOSX/Configuration/PageTS/._setup.ts";s:4:"b4f2";s:31:"__MACOSX/Configuration/._PageTS";s:4:"b4f2";s:24:"__MACOSX/._Configuration";s:4:"b4f2";s:9:"ChangeLog";s:4:"1660";s:20:"__MACOSX/._ChangeLog";s:4:"b4f2";s:14:"ext_tables.php";s:4:"0757";s:25:"__MACOSX/._ext_tables.php";s:4:"b4f2";s:8:"Classes/";s:4:"d41d";s:23:"Classes/DataProcessing/";s:4:"d41d";s:55:"Classes/DataProcessing/DatabaseCustomQueryProcessor.php";s:4:"ee2e";s:17:"__MACOSX/Classes/";s:4:"d41d";s:32:"__MACOSX/Classes/DataProcessing/";s:4:"d41d";s:66:"__MACOSX/Classes/DataProcessing/._DatabaseCustomQueryProcessor.php";s:4:"b4f2";s:33:"__MACOSX/Classes/._DataProcessing";s:4:"b4f2";s:14:"Classes/Hooks/";s:4:"d41d";s:29:"Classes/Hooks/PageLayoutView/";s:4:"d41d";s:74:"Classes/Hooks/PageLayoutView/YoutubevideoContentElementPreviewRenderer.php";s:4:"2200";s:23:"__MACOSX/Classes/Hooks/";s:4:"d41d";s:38:"__MACOSX/Classes/Hooks/PageLayoutView/";s:4:"d41d";s:85:"__MACOSX/Classes/Hooks/PageLayoutView/._YoutubevideoContentElementPreviewRenderer.php";s:4:"b4f2";s:39:"__MACOSX/Classes/Hooks/._PageLayoutView";s:4:"b4f2";s:24:"__MACOSX/Classes/._Hooks";s:4:"b4f2";s:28:"Classes/ActionController.php";s:4:"d41d";s:39:"__MACOSX/Classes/._ActionController.php";s:4:"b4f2";s:18:"__MACOSX/._Classes";s:4:"b4f2";s:10:"Resources/";s:4:"d41d";s:17:"Resources/Public/";s:4:"d41d";s:24:"Resources/Public/Images/";s:4:"d41d";s:39:"Resources/Public/Images/youtubePlay.svg";s:4:"4296";s:19:"__MACOSX/Resources/";s:4:"d41d";s:26:"__MACOSX/Resources/Public/";s:4:"d41d";s:33:"__MACOSX/Resources/Public/Images/";s:4:"d41d";s:50:"__MACOSX/Resources/Public/Images/._youtubePlay.svg";s:4:"b4f2";s:32:"Resources/Public/Images/play.svg";s:4:"d181";s:43:"__MACOSX/Resources/Public/Images/._play.svg";s:4:"b4f2";s:30:"Resources/Public/Images/Icons/";s:4:"d41d";s:50:"Resources/Public/Images/Icons/ext_icon_content.svg";s:4:"17fb";s:39:"__MACOSX/Resources/Public/Images/Icons/";s:4:"d41d";s:61:"__MACOSX/Resources/Public/Images/Icons/._ext_icon_content.svg";s:4:"b4f2";s:40:"__MACOSX/Resources/Public/Images/._Icons";s:4:"b4f2";s:34:"__MACOSX/Resources/Public/._Images";s:4:"b4f2";s:24:"Resources/Public/Styles/";s:4:"d41d";s:40:"Resources/Public/Styles/youtubevideo.css";s:4:"de1e";s:33:"__MACOSX/Resources/Public/Styles/";s:4:"d41d";s:51:"__MACOSX/Resources/Public/Styles/._youtubevideo.css";s:4:"b4f2";s:34:"__MACOSX/Resources/Public/._Styles";s:4:"b4f2";s:28:"Resources/Public/JavaScript/";s:4:"d41d";s:43:"Resources/Public/JavaScript/youtubevideo.js";s:4:"0f9a";s:37:"__MACOSX/Resources/Public/JavaScript/";s:4:"d41d";s:54:"__MACOSX/Resources/Public/JavaScript/._youtubevideo.js";s:4:"b4f2";s:38:"__MACOSX/Resources/Public/._JavaScript";s:4:"b4f2";s:27:"__MACOSX/Resources/._Public";s:4:"b4f2";s:18:"Resources/Private/";s:4:"d41d";s:27:"Resources/Private/Language/";s:4:"d41d";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"def9";s:27:"__MACOSX/Resources/Private/";s:4:"d41d";s:36:"__MACOSX/Resources/Private/Language/";s:4:"d41d";s:54:"__MACOSX/Resources/Private/Language/._locallang_db.xml";s:4:"b4f2";s:37:"__MACOSX/Resources/Private/._Language";s:4:"b4f2";s:28:"Resources/Private/Templates/";s:4:"d41d";s:45:"Resources/Private/Templates/Youtubevideo.html";s:4:"be36";s:37:"__MACOSX/Resources/Private/Templates/";s:4:"d41d";s:56:"__MACOSX/Resources/Private/Templates/._Youtubevideo.html";s:4:"b4f2";s:49:"Resources/Private/Templates/Youtubevideo_uus.html";s:4:"a3c5";s:60:"__MACOSX/Resources/Private/Templates/._Youtubevideo_uus.html";s:4:"b4f2";s:38:"__MACOSX/Resources/Private/._Templates";s:4:"b4f2";s:27:"Resources/Private/Partials/";s:4:"d41d";s:42:"Resources/Private/Partials/Coverimage.html";s:4:"e7f4";s:36:"__MACOSX/Resources/Private/Partials/";s:4:"d41d";s:53:"__MACOSX/Resources/Private/Partials/._Coverimage.html";s:4:"b4f2";s:37:"__MACOSX/Resources/Private/._Partials";s:4:"b4f2";s:28:"__MACOSX/Resources/._Private";s:4:"b4f2";s:20:"__MACOSX/._Resources";s:4:"b4f2";s:12:"ext_icon.png";s:4:"c5f6";s:23:"__MACOSX/._ext_icon.png";s:4:"b4f2";s:25:"__MACOSX/._ext_emconf.php";s:4:"b4f2";s:14:"ext_tables.sql";s:4:"c0f9";s:25:"__MACOSX/._ext_tables.sql";s:4:"b4f2";s:17:"ext_localconf.php";s:4:"2830";s:28:"__MACOSX/._ext_localconf.php";s:4:"b4f2";s:12:"ext_icon.svg";s:4:"2f64";s:23:"__MACOSX/._ext_icon.svg";s:4:"b4f2";}',
);

?>