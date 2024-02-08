<?php
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

defined('TYPO3_MODE') || defined('TYPO3') || die('Access denied.');

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['youtubevideo_pi1'] =  'youtubevideo_icon';

// Get extension configuration
$extensionConfiguration = GeneralUtility::makeInstance(
    ExtensionConfiguration::class
);
$extensionConfiguration = $extensionConfiguration->get('youtubevideo');

// Add to content type dropdown
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'YouTube Video',
        'description' => '',
        'value' => 'youtubevideo_pi1',
        'icon' => 'youtubevideo_icon',
        'group' => 'default',
    ],
    'textmedia',
    'after'
);



$tempColumns = array(
	'tx_youtubevideo_assets' => [
		'exclude' => 1,
		'label' => 'Video',
        'config' => [
            'type' => 'file',
            'allowed' => 'youtube',
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
			'appearance' => [
				'createNewRelationLinkTitle' => 'Video',
				'showPossibleLocalizationRecords' => true,
			],
            'overrideChildTca' => [
				'types' => [
					\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
						'showitem' => '
							--palette--;;youtubevideoOverlayPalette,
							--palette--;;filePalette',
					],
				],
			],
        ],

	],
	'tx_youtubevideo_colcount' => [
		'exclude' => 1,
		'label'   => 'Columns',
		'config'  => [
			'type'     => 'select',
			'renderType' => 'selectSingle',
			'items'    => array(),
			'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
		],
	],
    'tx_youtubevideo_titles' => [
		'exclude' => 1,
		'label' => 'Titles',
		'config' => [
			'type' => 'check',
			'renderType' => 'checkboxToggle',
			'items' => [
				[
					0 => '',
					1 => '',
					'invertStateDisplay' => true
				]
			],
			'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
		]
	],
    'tx_youtubevideo_descriptions' => [
		'exclude' => 1,
		'label' => 'Descriptions',
		'config' => [
			'type' => 'check',
			'renderType' => 'checkboxToggle',
			'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
		]
	],
);

ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);
$GLOBALS['TCA']['tt_content']['types']['youtubevideo_pi1']['previewRenderer'] = \Brightside\Youtubevideo\Preview\YoutubevideoPreviewRenderer::class;
$GLOBALS['TCA']['tt_content']['types']['youtubevideo_pi1']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,
        --palette--;LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo.title;youtubevideoMain,
    --div--;LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo.settings;,
        --palette--;LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo.layout;youtubevideoLayout,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';

if ($extensionConfiguration['youtubevideoEnablePagination']) {
    $GLOBALS['TCA']['tt_content']['types']['youtubevideo_pi1']['showitem'] = str_replace(
        ';youtubevideoLayout,',
        ';youtubevideoLayout,
		--palette--;LLL:EXT:paginatedprocessors/Resources/Private/Language/locallang_tca.xlf:palettes.pagination;paginatedprocessors,',
        $GLOBALS['TCA']['tt_content']['types']['youtubevideo_pi1']['showitem']
    );
}

$GLOBALS['TCA']['tt_content']['palettes']['youtubevideoMain']['showitem'] = 'tx_youtubevideo_assets';
$GLOBALS['TCA']['tt_content']['palettes']['youtubevideoLayout']['showitem'] = '
    tx_youtubevideo_colcount,
    tx_youtubevideo_titles,
    tx_youtubevideo_descriptions,
';

// Disable upload button in assets
$GLOBALS['TCA']['tt_content']['columns']['tx_youtubevideo_assets']['config']['appearance']['fileUploadAllowed'] = 0;
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['youtubevideo_pi1'] =  'youtubevideo_icon';
