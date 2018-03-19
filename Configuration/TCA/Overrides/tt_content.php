<?php
defined('TYPO3_MODE') || die('Access denied.');
	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['youtubevideo_pi1'] =  'youtubevideo_icon';

	array_splice(
		$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'],
		6,
		0,
		array(
			array(
				'YouTube Video',
				'youtubevideo_pi1',
				'youtubevideo_icon'
			)
		)
	);


$tempColumns = array(
	'tx_youtubevideo_url' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo_url.title',
		'config' => array(
			'type' => 'input',
			'size' => '50',
			'eval' => 'required',
			'requiredCond' => '!field',
		),
	),
	'tx_youtubevideo_caption' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo_caption.title',
		'config' => array(
			'type' => 'input',
			'size' => '50',
		),
	),
	'tx_youtubevideo_autoplay' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo_autoplay.title',
		'config' => array (
			'type' => 'check',
			'items' => array(
                 array(
                 	'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo.enable',
                 ),
            ),
		),
	),
	'tx_youtubevideo_showinfo' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo_showinfo.title',
		'config' => array (
			'type' => 'check',
			'items' => array(
                 array(
                 	'LLL:EXT:lang/locallang_core.xlf:labels.show',
                 ),
            ),
		),
	),
    'tx_youtubevideo_rel' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo_rel.title',
		'config' => array (
			'type' => 'check',
			'items' => array(
                 array(
                 	'LLL:EXT:lang/locallang_core.xlf:labels.show',
                 ),
            ),
		),
	),
	'tx_youtubevideo_startminute' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo_startminute.title',
		'config' => array(
			'type' => 'input',
			'size' => '1',
		),
	),
	'tx_youtubevideo_startsecond' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo_startsecond.title',
		'config' => array(
			'type' => 'input',
			'size' => '1',
		),
	),
	'tx_youtubevideo_ratio' => array(
        'exclude' => 1,
        'label'   => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo_ratio.title',
        'config'  => array(
            'type'     => 'select',
            'renderType' => 'selectSingle',
            'items'    => array(), /* items set in page TsConfig */
            'size'     => 1,
            'maxitems' => 1
        )
    ),
    'tx_youtubevideo_fullscreen' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo_fullscreen.title',
		'config' => array (
			'type' => 'check',
			'items' => array(
                 array(
                 	'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo.disable',
                 ),
            ),
		),
	),
	'tx_youtubevideo_loop' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo_loop.title',
		'config' => array (
			'type' => 'check',
			'items' => array(
				array(
					'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo.enable',
				),
      ),
		),
	),
	'tx_youtubevideo_covertitle' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo_covertitle.title',
		'config' => array(
			'type' => 'input',
			'size' => '50',
		),
	),
	'tx_youtubevideo_covertext' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo_covertext.title',
		'config' => array(
			'type' => 'input',
			'size' => '50',
		),
	),
);
	
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tt_content', 'EXT:youtubevideo/Resources/Private/Language/locallang_db.xml');

	$GLOBALS['TCA']['tt_content']['types']['youtubevideo_pi1']['showitem'] = '
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
            --palette--;LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo.title;youtubevideoMain,
						--palette--;LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo.cover;youtubevideoCoverimage,
						--palette--;LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xml:tx_youtubevideo.settings;youtubevideoSettings,

        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
            categories,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
            rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
		--div--;LLL:EXT:gridelements/Resources/Private/Language/locallang_db.xlf:gridElements, tx_gridelements_container, tx_gridelements_columns
	';
			
	$GLOBALS['TCA']['tt_content']['palettes']['youtubevideoMain']['showitem'] = '
		tx_youtubevideo_url,
		--linebreak--,
		tx_youtubevideo_caption';
	
	$GLOBALS['TCA']['tt_content']['palettes']['youtubevideoSettings']['showitem'] = '
		tx_youtubevideo_ratio,tx_youtubevideo_startminute,tx_youtubevideo_startsecond,
		--linebreak--,
		tx_youtubevideo_autoplay,tx_youtubevideo_showinfo,tx_youtubevideo_rel,tx_youtubevideo_fullscreen,tx_youtubevideo_loop,
	';
	$GLOBALS['TCA']['tt_content']['palettes']['youtubevideoCoverimage']['showitem'] = '
		tx_youtubevideo_covertitle,tx_youtubevideo_covertext,--linebreak--,image';


	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['youtubevideo_pi1'] =  'youtubevideo_icon';