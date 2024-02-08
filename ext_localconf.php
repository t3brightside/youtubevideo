<?php
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use Brightside\Youtubevideo\Evaluation\HoursMinutesSeconds;

defined('TYPO3') || die('Access denied.');

(function () {
    $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
    $iconRegistry->registerIcon(
        'youtubevideo_icon',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:youtubevideo/Resources/Public/Icons/ext_icon_content.svg']
    );

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][HoursMinutesSeconds::class] = '';
})();
