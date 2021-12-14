<?php
defined('TYPO3_MODE') || die ('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:youtubevideo/Configuration/PageTS/setup.typoscript">');

$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
  'youtubevideo_icon',
  \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
  ['source' => 'EXT:youtubevideo/Resources/Public/Icons/ext_icon_content.svg']
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['youtubevideo_pi1']
    = \Brightside\Youtubevideo\Hooks\PageLayoutView\YoutubevideoContentElementPreviewRenderer::class;

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']['Brightside\\Youtubevideo\\Evaluation\\HoursMinutesSeconds'] = '';
