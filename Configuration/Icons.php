<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;

return [
    'youtubevideo_icon' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:youtubevideo/Resources/Public/Icons/ext_icon_content.svg',
    ],
];
