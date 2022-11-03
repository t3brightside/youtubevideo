<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Brightside\Youtubevideo\Preview;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Backend\Preview\PreviewRendererInterface;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\OnlineMediaHelperRegistry;
/**
 * Contains a preview rendering for the page module of CType="textmedia"
 * @internal this is a concrete TYPO3 hook implementation and solely used for EXT:frontend and not part of TYPO3's Core API.
 */
class YoutubevideoPreviewRenderer extends StandardContentPreviewRenderer
{
    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        $extensionConfiguration = GeneralUtility::makeInstance(
             \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
         );
         $extensionConfiguration = $extensionConfiguration->get('youtubevideo');
        $content = '';
        $row = $item->getRecord();
        if ($row['header']) {
            $content .= $this->linkEditContent(BackendUtility::thumbCode($row, 'tt_content', 'header', '', '', null, 0, '', '', false), $row);
        }
        $videoRelations = $this->renderText(strval($row['uid']));
        $youtubeObjects = BackendUtility::resolveFileReferences('tt_content', 'tx_youtubevideo_assets', $row);
        $content .= '<div class="youtubevideo-container">';
        foreach ($youtubeObjects as $video) {
            $original = $video->getOriginalFile();
            $code = $video->getContents();
            $onlineMediaHelper = GeneralUtility::makeInstance(OnlineMediaHelperRegistry::class)->getOnlineMediaHelper($original);
            $previewUrl = str_replace(Environment::getPublicPath(), '', $onlineMediaHelper->getPreviewImage($original));
            if (!$video->getProperty('hidden')){
                $content .= '<div class="youtubevideo-item">';
            if ($extensionConfiguration['youtubevideoEnableBePlayer']) {
                $content .= '<div class="youtubevideo-wrapper"><iframe src="https://www.youtube.com/embed/';
                $content .= $code;
                $content .= '?showinfo=0&amp;rel=0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
            } else {
                 $content .= $this->linkEditContent('<img src="' . $previewUrl . '" />', $row);
            }
                if ($video->getProperty('title')){
                    $content .= '<b class="title">' . $this->linkEditContent($this->renderText($video->getProperty('title')), $row) . '</b>';
                }
                $content .= '<ul>';
                if ($video->getProperty('tx_youtubevideo_mute')){
                    $content .= '<li>' . $this->linkEditContent('Mute: on', $row) . '</li>';
                }
                if ($video->getProperty('tx_youtubevideo_loop')){
                    $content .= '<li>' . $this->linkEditContent('Loop: on', $row) . '</li>';
                }
                if (!$video->getProperty('tx_youtubevideo_fullscreen')){
                    $content .= '<li>' . $this->linkEditContent('Fullscreen: off', $row) . '</li>';
                }
                if (!$video->getProperty('tx_youtubevideo_rel')){
                    $content .= '<li>' . $this->linkEditContent('Related: off', $row) . '</li>';
                }
                if ($video->getProperty('tx_youtubevideo_starttime')){
                    $content .= '<li>' . $this->linkEditContent('Start: ' . $video->getProperty('tx_youtubevideo_starttime') , $row) . '</li>';
                }
                if ($video->getProperty('tx_youtubevideo_endtime')){
                    $content .= '<li>' . $this->linkEditContent('End: ' . $video->getProperty('tx_youtubevideo_endtime') , $row) . '</li>';
                }
                $content .= '</ul></div>';
            }
        }
        $content .= '</div>';
        if (
            $row['tx_youtubevideo_colcount'] ||
            array_key_exists('tx_paginatedprocessors_paginationenabled', $row) && $row['tx_paginatedprocessors_paginationenabled'] ||
            array_key_exists('tx_paginatedprocessors_itemsperpage', $row) && $row['tx_paginatedprocessors_itemsperpage'] ||
            array_key_exists('tx_paginatedprocessors_pagelinksshown', $row) && $row['tx_paginatedprocessors_pagelinksshown']
        ) {
            $content .= '<div class="settings">';
            if ($row['tx_youtubevideo_colcount']) {
                $content .= '<br /><b>Layout:</b> columns:' . $row['tx_youtubevideo_colcount'];
            }
            if ($extensionConfiguration['youtubevideoEnablePagination']) {
                if (array_key_exists('tx_paginatedprocessors_paginationenabled', $row) && $row['tx_paginatedprocessors_paginationenabled']) {
                    $content .= '<br /><b> Pagination:</b> active ';
                    if (array_key_exists('tx_paginatedprocessors_itemsperpage', $row) && $row['tx_paginatedprocessors_itemsperpage']) {
                        $content .= ' &bull; items per page: ' . $row['tx_paginatedprocessors_itemsperpage'];
                    }
                    if (array_key_exists('tx_paginatedprocessors_pagelinksshown', $row) && $row['tx_paginatedprocessors_pagelinksshown']) {
                        $content .= ' &bull; links shown: ' . $row['tx_paginatedprocessors_pagelinksshown'];
                    }
                    if (array_key_exists('tx_paginatedprocessors_urlsegment', $row) &&  $row['tx_paginatedprocessors_urlsegment']) {
                        $content .= ' &bull; url segment: ' . $row['tx_paginatedprocessors_urlsegment'];
                    }
                }
            }
            $content .= '</div>';
        }
        return $content;
    }
}
