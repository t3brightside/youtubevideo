<?php

$youtubeVideoColumns = array(
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
  'tx_youtubevideo_starttime' => array(
    'exclude' => 0,
    'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_starttime.title',
    'config' => array(
      'type' => 'input',
      'size' => '8',
      'eval' => 'trim,nospace,Brightside\Youtubevideo\Evaluation\HoursMinutesSeconds',
      'behaviour' => [
        'allowLanguageSynchronization' => true,
      ],
    ),
  ),
  'tx_youtubevideo_endtime' => array(
    'exclude' => 0,
    'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_endtime.title',
    'config' => array(
      'type' => 'input',
      'size' => '1',
      'eval' => 'trim,nospace,Brightside\Youtubevideo\Evaluation\HoursMinutesSeconds',
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
            'items' => [
                ['Widescreen (16:9)', 0],
                ['Standard (4:3)', 1],
            ],
            'size'     => 1,
            'maxitems' => 1,
            'behaviour' => [
              'allowLanguageSynchronization' => true,
            ]
        )
    ),
    'tx_youtubevideo_mute' => array (
      'exclude' => 1,
      'label' => 'LLL:EXT:youtubevideo/Resources/Private/Language/locallang_db.xlf:tx_youtubevideo_mute.title',
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
