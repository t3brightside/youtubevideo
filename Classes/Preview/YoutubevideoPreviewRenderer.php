<?php

declare(strict_types=1);

namespace Brightside\Youtubevideo\Preview;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Backend\Preview\PreviewRendererInterface; // <-- FIX: IMPORT THIS MISSING INTERFACE
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\OnlineMediaHelperRegistry;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Domain\Record;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Imaging\IconSize;
use TYPO3\CMS\Core\Resource\Collection\FileReferenceCollection;
use TYPO3\CMS\Core\Domain\RecordInterface;
use TYPO3\CMS\Core\Domain\RawRecord; // Added for RawRecord object check

/**
 * Contains a preview rendering for the page module of CType="textmedia"
 */
class YoutubevideoPreviewRenderer extends StandardContentPreviewRenderer implements PreviewRendererInterface // <-- FIX: IMPLEMENT THE INTERFACE
{
    /**
     * TYPO3 v12+ compatibility: Defines custom fields that must be loaded
     * when fetching the tt_content record for this preview renderer.
     *
     * @param array $row The currently loaded content element record (minimal set of fields)
     * @return string[] The list of additional fields required for the preview
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
        ];
    }

    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        /** @var Record $recordObject */
        $recordObject = $item->getRecord();
        
        // --- V12/V14 FIX: EXTRACT COMPLETE RAW RECORD ARRAY VIA CASTING (The Correct Way) ---
        $castRecord = (array)$recordObject;
        $row = [];

        // 1. Get processed properties (start with this)
        if (isset($castRecord["\0*\0properties"]) && is_array($castRecord["\0*\0properties"])) {
            $row = $castRecord["\0*\0properties"];
        }

        // 2. Get the nested RAW DB data and merge OVER the processed data
        if (isset($castRecord["\0*\0rawRecord"]) && $castRecord["\0*\0rawRecord"] instanceof RawRecord) {
            $castRawRecord = (array)$castRecord["\0*\0rawRecord"];
            if (isset($castRawRecord["\0*\0properties"]) && is_array($castRawRecord["\0*\0properties"])) {
                // Merge raw data into $row (This fixes the tx_youtubevideo_assets issue)
                $row = array_merge($row, $castRawRecord["\0*\0properties"]);
            }
        }
        
        // 3. Ensure the CE's UID and PID are set
        if (isset($castRecord["\0*\0uid"])) {
            $row['uid'] = $castRecord["\0*\0uid"];
        } else {
            // Fallback using getter if casting the protected UID property failed
            $row['uid'] = $recordObject->getUid();
        }
        $row['pid'] = $recordObject->getPid();
        // --- END V12/V14 FIX ---

        /** @var array $extensionConfiguration */
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('youtubevideo');
        
        // --- V12/V14 FIX: ICON FACTORY SETUP (Replaces BackendUtility::thumbCode) ---
        $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
        $iconIdentifier = 'content-tt_content-' . ($row['CType'] ?? 'default');
        $iconHtml = $iconFactory->getIcon($iconIdentifier, IconSize::SMALL)->render();
        // --- END V12/V14 FIX ---
        
        $content = '';

        // Use isset() to prevent PHP Warning: Undefined array key "header"
        
        
        // --- FIX FOR RESOURCE DOES NOT EXIST EXCEPTION & MULTIPLE VIDEOS ---
        // Use the raw value, which should be a string (e.g., '10,11,12') or ''
        $fileReferenceValue = (string)($row['tx_youtubevideo_assets'] ?? '');

        // Clean the field value to prevent crashes from orphaned UIDs (like '1')
        $cleanedUids = GeneralUtility::intExplode(',', (string)$fileReferenceValue, true);
        
        // CRITICAL: Update the $row array with the SAFE, CLEANED string of sys_file_reference UIDs
        $row['tx_youtubevideo_assets'] = implode(',', $cleanedUids);

        // This utility now uses the clean string from $row, and $row['uid'] is correctly set.
        try {
            $youtubeObjects = BackendUtility::resolveFileReferences('tt_content', 'tx_youtubevideo_assets', $row);
        } catch (\TYPO3\CMS\Core\Resource\Exception\ResourceDoesNotExistException $e) {
            // If it still crashes (e.g., due to orphaned UIDs), return an empty array to prevent backend crash.
            $youtubeObjects = []; 
        }
        // --- END FIX ---
        
        $content .= '<div class="youtubevideo-container">';
        
        foreach ($youtubeObjects as $video) {
            $original = $video->getOriginalFile();
            $code = $video->getContents();
            
            // Safety: Handle the possibility that the helper or preview URL fails
            try {
                $onlineMediaHelper = GeneralUtility::makeInstance(OnlineMediaHelperRegistry::class)->getOnlineMediaHelper($original);
                $previewUrl = str_replace((string)Environment::getPublicPath(), '', $onlineMediaHelper->getPreviewImage($original));
            } catch (\Exception $e) {
                continue; // Skip rendering this video if resolution fails
            }
            
            if (!(bool)$video->getProperty('hidden')){
                $content .= '<div class="youtubevideo-item">';
            
                if ($extensionConfiguration['youtubevideoEnableBePlayer']) {
                    $content .= '<div class="youtubevideo-wrapper"><iframe src="https://www.youtube.com/embed/';
                    $content .= $code;
                    $content .= '?showinfo=0&amp;rel=0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
                } else {
                     // FIX: Pass the record object
                     $content .= $this->linkEditContent('<img src="' . $previewUrl . '" />', $recordObject);
                }
                
                $title = $video->getProperty('title');
                if ($title){
                    // FIX: Pass the record object
                    $content .= '<b class="title">' . $this->linkEditContent($this->renderText((string)$title), $recordObject) . '</b>';
                }
                
                $content .= '<ul>';
                
                // FIX: Use explicit (bool) cast for stability
                if ((bool)$video->getProperty('tx_youtubevideo_mute')){
                    $content .= '<li>' . $this->linkEditContent('Mute: on', $recordObject) . '</li>';
                }
                if ((bool)$video->getProperty('tx_youtubevideo_loop')){
                    $content .= '<li>' . $this->linkEditContent('Loop: on', $recordObject) . '</li>';
                }
                
                if (!(bool)$video->getProperty('tx_youtubevideo_fullscreen')){
                    $content .= '<li>' . $this->linkEditContent('Fullscreen: off', $recordObject) . '</li>';
                }
                if (!(bool)$video->getProperty('tx_youtubevideo_rel')){
                    $content .= '<li>' . $this->linkEditContent('Related: off', $recordObject) . '</li>';
                }

                $startTime = $video->getProperty('tx_youtubevideo_starttime');
                if ($startTime){
                    $content .= '<li>' . $this->linkEditContent('Start: ' . $startTime , $recordObject) . '</li>';
                }
                $endTime = $video->getProperty('tx_youtubevideo_endtime');
                if ($endTime){
                    $content .= '<li>' . $this->linkEditContent('End: ' . $endTime , $recordObject) . '</li>';
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
                $content .= '<br />' . $this->linkEditContent($text, $recordObject);
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
                    $content .= '<br />' . $this->linkEditContent($text, $recordObject);
                }
            }
            $content .= '</div>';
        }
        return $content;
    }
}