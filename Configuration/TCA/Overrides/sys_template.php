<?php
defined('TYPO3') || die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'youtubevideo', 'Configuration/TypoScript/', 'YouTube Video'
);