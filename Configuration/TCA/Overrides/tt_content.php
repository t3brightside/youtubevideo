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
			'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_url.title',
			'config' => array(
				'type' => 'input',
				'size' => '50',
				'eval' => 'required',
				'requiredCond' => '!field',
				'behaviour' => [
					'allowLanguageSynchronization' => true,
				],
			),
		),
		'tx_youtubevideo_caption' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_caption.title',
			'config' => array(
				'type' => 'input',
				'size' => '50',
			),
		),
		'tx_youtubevideo_autoplay' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_autoplay.title',
			'config' => [
				'behaviour' => [
					'allowLanguageSynchronization' => true,
				],
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'items' => [
					[
						0 => '',
						1 => '',
					]
				],
			]
		),
	    'tx_youtubevideo_rel' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_rel.title',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'behaviour' => [
					'allowLanguageSynchronization' => true,
				],
				'items' => [
					[
						0 => '',
						1 => '',
					]
				],
			]
		),
		'tx_youtubevideo_startminute' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_startminute.title',
			'config' => array(
				'type' => 'input',
				'size' => '1',
				'default' => 0,
        'eval' => 'int',
				'behaviour' => [
					'allowLanguageSynchronization' => true,
				],
			),
		),
		'tx_youtubevideo_startsecond' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_startsecond.title',
			'config' => array(
				'type' => 'input',
				'size' => '1',
				'default' => 0,
        'eval' => 'int',
				'behaviour' => [
					'allowLanguageSynchronization' => true,
				],
			),
		),
		'tx_youtubevideo_ratio' => array(
	        'exclude' => 1,
	        'label'   => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_ratio.title',
	        'config'  => array(
	            'type'     => 'select',
	            'renderType' => 'selectSingle',
	            'items'    => array(), /* items set in page TsConfig */
	            'size'     => 1,
	            'maxitems' => 1,
              'behaviour' => [
                'allowLanguageSynchronization' => true,
              ]
	        )
	    ),
	    'tx_youtubevideo_fullscreen' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_fullscreen.title',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'default' => 1,
				'behaviour' => [
					'allowLanguageSynchronization' => true,
				],
				'items' => [
					[
						0 => '',
						1 => '',
						'invertStateDisplay' => false,
					]
				],
			]
		),
		'tx_youtubevideo_loop' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_loop.title',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'behaviour' => [
					'allowLanguageSynchronization' => true,
				],
				'items' => [
					[
						0 => '',
						1 => '',
					]
				],
			]
		),
		'tx_youtubevideo_covertitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_covertitle.title',
			'config' => array(
				'type' => 'input',
				'size' => '50',
			),
		),
		'tx_youtubevideo_covertext' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_covertext.title',
			'config' => array(
				'type' => 'input',
				'size' => '50',
			),
		),
		'tx_youtubevideo_coverimage' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_cover.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'tx_youtubevideo_coverimage',
				[
					'behaviour' => [
						'allowLanguageSynchronization' => true,
					],
					'overrideChildTca' => [
						'columns' => [
							'crop' => [
								'config' => [
									'cropVariants' => [
										'widescreen' => [
											'title' => 'Widescreen (16:9)',
											'selectedRatio' => '16:9',
											'allowedAspectRatios' => [
												'16:9' => [
													'title' => 'Widescreen',
													'value' => 16 / 9,
												],
											],
										],
										'tv' => [
											'title' => 'Standard (4:3)',
											'selectedRatio' => '4:3',
											'allowedAspectRatios' => [
												'4:3' => [
													'title' => 'TV',
													'value' => 4 / 3,
												],
											],
										],
									],
								],
							],
						],
						'types' => [
							'0' => [
                'showitem' => '
                  --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                  --palette--;;filePalette'
              ],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
								'showitem' => '
								crop,
								--palette--;;filePalette'
						],
					],
				],
			],
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
		),
		],
	);

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tt_content', 'EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf');

	$GLOBALS['TCA']['tt_content']['types']['youtubevideo_pi1']['showitem'] = '
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
            --palette--;LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo.title;youtubevideoMain,
						--palette--;LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo.cover;youtubevideoCoverimage,
						--palette--;LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo.settings;youtubevideoSettings,

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
		tx_youtubevideo_covertitle,tx_youtubevideo_covertext,--linebreak--,tx_youtubevideo_coverimage';


	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['youtubevideo_pi1'] =  'youtubevideo_icon';
