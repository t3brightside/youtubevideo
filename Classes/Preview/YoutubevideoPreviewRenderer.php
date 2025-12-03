<?php

declare(strict_types=1);

namespace Brightside\Youtubevideo\Preview;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Backend\Preview\PreviewRendererInterface;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\OnlineMediaHelperRegistry;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Domain\RecordInterface;
use TYPO3\CMS\Core\Resource\Exception\ResourceDoesNotExistException;

/**
 * Contains a preview rendering for the page module of CType="textmedia"
 */
class YoutubevideoPreviewRenderer extends StandardContentPreviewRenderer implements PreviewRendererInterface
{
    /**
     * Defines custom fields that must be loaded
     * when fetching the tt_content record for this preview renderer.
     */
    public function getRequiredFields(array $row): array
    {
        return [
            'tx_youtubevideo_assets',
            'tx_youtubevideo_colcount',
            'tx_paginatedprocessors_paginationenabled',
            'tx_paginatedprocessors_itemsperpage',
            'tx_paginatedprocessors_pagelinksshown',
            'tx_paginatedprocessors_urlsegment',
            'header',
        ];
    }

    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        // Get the record context (array for older v12/v13, RecordInterface for newer v12/v13/v14)
        $record = $item->getRecord();
        $row = [];

        if (is_array($record)) {
            // Fallback for older array-based record
            $row = $record;
        } elseif ($record instanceof RecordInterface) {
            // Modern Record object
            $row = $record->toArray();
            
            if (!isset($row['uid'])) {
                $row['uid'] = $record->getUid();
            }
            if (!isset($row['pid'])) {
                $row['pid'] = $record->getPid();
            }
        } else {
            return '<div>Error: Could not resolve content element record.</div>';
        }

        /** @var array $extensionConfiguration */
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('youtubevideo');
        
        $content = '';

        // Header rendering
        if (isset($row['header']) && $row['header']) {
            $content .= $this->linkEditContent('<b>' . $this->renderText((string)$row['header']) . '</b>', $item->getRecord());
        }

        // Get file references and clean up UIDs
        $fileReferenceValue = (string)($row['tx_youtubevideo_assets'] ?? '');
        $cleanedUids = GeneralUtility::intExplode(',', $fileReferenceValue, true);
        $row['tx_youtubevideo_assets'] = implode(',', $cleanedUids);

        try {
            $youtubeObjects = BackendUtility::resolveFileReferences('tt_content', 'tx_youtubevideo_assets', $row);
        } catch (ResourceDoesNotExistException $e) {
            $youtubeObjects = []; 
        }
        
        $content .= '<div class="youtubevideo-container">';
        
        foreach ($youtubeObjects as $video) {
            $original = $video->getOriginalFile();
            $code = $video->getContents();
            
            try {
                $onlineMediaHelper = GeneralUtility::makeInstance(OnlineMediaHelperRegistry::class)->getOnlineMediaHelper($original);
                $previewUrl = str_replace((string)Environment::getPublicPath(), '', $onlineMediaHelper->getPreviewImage($original));
            } catch (\Exception $e) {
                continue;
            }
            
            if (!(bool)$video->getProperty('hidden')){
                $content .= '<div class="youtubevideo-item">';
            
                if ($extensionConfiguration['youtubevideoEnableBePlayer']) {
                    $content .= '<div class="youtubevideo-wrapper"><iframe src="https://www.youtube.com/embed/';
                    $content .= $code;
                    $content .= '?showinfo=0&amp;rel=0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
                } else {
                    $content .= $this->linkEditContent('<img src="' . $previewUrl . '" />', $item->getRecord());
                }
                
                $title = $video->getProperty('title');
                if ($title){
                    $content .= '<b class="title">' . $this->linkEditContent($this->renderText((string)$title), $item->getRecord()) . '</b>';
                }
                
                $content .= '<ul>';
                
                if ((bool)$video->getProperty('tx_youtubevideo_mute')){
                    $content .= '<li>' . $this->linkEditContent('Mute: on', $item->getRecord()) . '</li>';
                }
                if ((bool)$video->getProperty('tx_youtubevideo_loop')){
                    $content .= '<li>' . $this->linkEditContent('Loop: on', $item->getRecord()) . '</li>';
                }
                
                if (!(bool)$video->getProperty('tx_youtubevideo_fullscreen')){
                    $content .= '<li>' . $this->linkEditContent('Fullscreen: off', $item->getRecord()) . '</li>';
                }
                if (!(bool)$video->getProperty('tx_youtubevideo_rel')){
                    $content .= '<li>' . $this->linkEditContent('Related: off', $item->getRecord()) . '</li>';
                }

                $startTime = $video->getProperty('tx_youtubevideo_starttime');
                if ($startTime){
                    $content .= '<li>' . $this->linkEditContent('Start: ' . $startTime , $item->getRecord()) . '</li>';
                }
                $endTime = $video->getProperty('tx_youtubevideo_endtime');
                if ($endTime){
                    $content .= '<li>' . $this->linkEditContent('End: ' . $endTime , $item->getRecord()) . '</li>';
                }
                $content .= '</ul></div>';
            }
        }
        $content .= '</div>';
        
        // Settings/Pagination block
        if (
            ($row['tx_youtubevideo_colcount'] ?? null) ||
            (array_key_exists('tx_paginatedprocessors_paginationenabled', $row) && $row['tx_paginatedprocessors_paginationenabled']) ||
            (array_key_exists('tx_paginatedprocessors_itemsperpage', $row) && $row['tx_paginatedprocessors_itemsperpage']) ||
            (array_key_exists('tx_paginatedprocessors_pagelinksshown', $row) && $row['tx_paginatedprocessors_pagelinksshown'])
        ) {
            $content .= '<div class="settings">';
            
            if (($row['tx_youtubevideo_colcount'] ?? null)) {
                $text = '<b>Layout:</b> columns:' . $row['tx_youtubevideo_colcount'];
                $content .= '<br />' . $this->linkEditContent($text, $item->getRecord());
            }
            if ($extensionConfiguration['youtubevideoEnablePagination']) {
                if (array_key_exists('tx_paginatedprocessors_paginationenabled', $row) && $row['tx_paginatedprocessors_paginationenabled']) {
                    $text = '<b> Pagination:</b> active ';
                    if (array_key_exists('tx_paginatedprocessors_itemsperpage', $row) && $row['tx_paginatedprocessors_itemsperpage']) {
                        $text .= ' &bull; items per page: ' . $row['tx_paginatedprocessors_itemsperpage'];
                    }
                    if (array_key_exists('tx_paginatedprocessors_pagelinksshown', $row) && $row['tx_paginatedprocessors_pagelinksshown']) {
                        $text .= ' &bull; links shown: ' . $row['tx_paginatedprocessors_pagelinksshown'];
                    }
                    if (array_key_exists('tx_paginatedprocessors_urlsegment', $row) &&  $row['tx_paginatedprocessors_urlsegment']) {
                        $text .= ' &bull; url segment: ' . $row['tx_paginatedprocessors_urlsegment'];
                    }
                    $content .= '<br />' . $this->linkEditContent($text, $item->getRecord());
                }
            }
            $content .= '</div>';
        }
        return $content;
    }
}