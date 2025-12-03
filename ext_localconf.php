<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use Brightside\Youtubevideo\Evaluation\HoursMinutesSeconds;

/**
 * Register icons for the extension.
 * This file replaces icon registration previously done in ext_localconf.php.
 */
return [
    'youtubevideo_icon' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:youtubevideo/Resources/Public/Icons/ext_icon_content.svg',
    ],
    // The icon used in the TCA override file for the palette
    'youtubevideo-icon' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:youtubevideo/Resources/Public/Icons/youtube-icon.svg',
    ],
];

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][HoursMinutesSeconds::class] = '';
