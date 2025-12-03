<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Resource\FileType;

$youtubeVideoColumns = array(
    'tx_youtubevideo_rel' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_rel.title',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'default' => 1,
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
        ],
    ],
    'tx_youtubevideo_starttime' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_starttime.title',
        'config' => [
            'type' => 'input',
            'size' => '8',
            'eval' => 'trim,nospace,Brightside\Youtubevideo\Evaluation\HoursMinutesSeconds',
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
        ],
    ],
    'tx_youtubevideo_endtime' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_endtime.title',
        'config' => [
            'type' => 'input',
            'size' => '1',
            'eval' => 'trim,nospace,Brightside\Youtubevideo\Evaluation\HoursMinutesSeconds',
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
        ],
    ],
    'tx_youtubevideo_ratio' => [
        'exclude' => 1,
        'label'   => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_ratio.title',
        'config'  => [
            'type'     => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['Widescreen (16:9)', 0],
                ['Standard (4:3)', 1],
            ],
            'size'     => 1,
            'maxitems' => 1,
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ]
        ],
    ],
    'tx_youtubevideo_mute' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_mute.title',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],

        ],
    ],
    'tx_youtubevideo_fullscreen' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_fullscreen.title',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'default' => 1,
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
        ],
    ],
    'tx_youtubevideo_loop' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_loop.title',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
        ],
    ],
    'tx_youtubevideo_coverimage' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_cover.image',
        'config' => [
            'type' => 'file',
            'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
            'behaviour' => [
                'allowLanguageSynchronization' => true,
            ],
            'appearance' => [
                'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
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
                    FileType::IMAGE->value=> [
                        'showitem' => '
                        crop,
                        --palette--;;filePalette'
                    ],
                ],
            ],
        ],
    ],
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'sys_file_reference',
    $youtubeVideoColumns
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'sys_file_reference',
    'youtubevideoOverlayPalette',
    'title,description,
    --linebreak--,
    tx_youtubevideo_mute,tx_youtubevideo_loop,tx_youtubevideo_fullscreen,tx_youtubevideo_rel,
    --linebreak--,
    tx_youtubevideo_starttime,tx_youtubevideo_endtime,
    --linebreak--,
    tx_youtubevideo_ratio,
    --linebreak--,
    tx_youtubevideo_coverimage'
);
