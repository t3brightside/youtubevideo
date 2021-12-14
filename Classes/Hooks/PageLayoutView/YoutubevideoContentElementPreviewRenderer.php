<?php
namespace Brightside\Youtubevideo\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\OnlineMediaHelperRegistry;
use TYPO3\CMS\Core\Core\Environment;

class YoutubevideoContentElementPreviewRenderer implements PageLayoutViewDrawItemHookInterface {
	 /**
     * Preprocesses the preview rendering of a content element of type "youtubemedia_pi1"
     *
     * @param \TYPO3\CMS\Backend\View\PageLayoutView $parentObject Calling parent object
     * @param bool $drawItem Whether to draw the item using the default functionality
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     *
     * @return void
     */

	 public function preProcess(
         PageLayoutView &$parentObject,
         &$drawItem,
         &$headerContent,
         &$itemContent,
         array &$row
     ) {

         // Get extension configuration
         $extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
             \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
         );
         $extensionConfiguration = $extensionConfiguration->get('youtubevideo');

		if ($row['CType'] === 'youtubevideo_pi1') {
			$videoRelations = $parentObject->renderText($row['uid']);
			$youtubeObjects = \TYPO3\CMS\Backend\Utility\BackendUtility::resolveFileReferences('tt_content', 'tx_youtubevideo_assets', $row);
			$itemContent .= '<div class="youtubevideo-container">';
			foreach ($youtubeObjects as $video) {
				$original = $video->getOriginalFile();
				$code = $video->getContents();
                $onlineMediaHelper = OnlineMediaHelperRegistry::getInstance()->getOnlineMediaHelper($original);
                $previewUrl = str_replace(Environment::getPublicPath(), '', $onlineMediaHelper->getPreviewImage($original));
				if (!$video->getProperty('hidden')){
					$itemContent .= '<div class="youtubevideo-item">';
                if ($extensionConfiguration['youtubevideoEnableBePlayer']) {
                    $itemContent .= '<div class="youtubevideo-wrapper"><iframe src="https://www.youtube.com/embed/';
					$itemContent .= $code;
					$itemContent .= '?showinfo=0&amp;rel=0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
                } else {
                        $itemContent .= $parentObject->linkEditContent('<img src="' . $previewUrl . '" />', $row);
                }
                    if ($video->getProperty('title')){
						$itemContent .= '<b class="title">' . $parentObject->linkEditContent($parentObject->renderText($video->getProperty('title')), $row) . '</b>';
					}
					$itemContent .= '<ul>';
					if ($video->getProperty('tx_youtubevideo_mute')){
						$itemContent .= '<li>Mute: on</li>';
					}
					if ($video->getProperty('tx_youtubevideo_loop')){
						$itemContent .= '<li>Loop: on</li>';
					}
					if (!$video->getProperty('tx_youtubevideo_fullscreen')){
						$itemContent .= '<li>Fullscreen: off</li>';
					}
					if ($video->getProperty('tx_youtubevideo_rel')){
						$itemContent .= '<li>Related: on</li>';
					}
					if ($video->getProperty('tx_youtubevideo_starttime')){
						$itemContent .= '<li>Start: ' . $video->getProperty('tx_youtubevideo_starttime') . '</li>';
					}
					if ($video->getProperty('tx_youtubevideo_endtime')){
						$itemContent .= '<li>End: ' . $video->getProperty('tx_youtubevideo_endtime') . '</li>';
					}
					$itemContent .= '</ul></div>';
				}
			}
			$itemContent .= '</div>';
			if (
				$row['tx_youtubevideo_colcount'] ||
				$row['tx_paginatedprocessors_paginationenabled'] ||
				$row['tx_paginatedprocessors_itemsperpage'] ||
				$row['tx_paginatedprocessors_pagelinksshown'] ||
				$row['tx_paginatedprocessors_pagelinksshown']
			) {
				$itemContent .= '<div class="settings">';
				if ($row['tx_youtubevideo_colcount']) {
					$itemContent .= '<b>Layout:</b> columns:' . $parentObject->linkEditContent($parentObject->renderText($row['tx_youtubevideo_colcount']), $row) . '';
				}
				if ($row['tx_paginatedprocessors_paginationenabled']) {
					$itemContent .= '<br /><b> Pagination:</b> active ';
					if ($row['tx_paginatedprocessors_itemsperpage']) {
						$itemContent .= ' &bull; items per page: ' . $row['tx_paginatedprocessors_itemsperpage'];
					}
					if ($row['tx_paginatedprocessors_pagelinksshown']) {
						$itemContent .= ' &bull; links shown: ' . $row['tx_paginatedprocessors_pagelinksshown'];
					}
					if ($row['tx_paginatedprocessors_urlsegment']) {
						$itemContent .= ' &bull; url segment: ' . $row['tx_paginatedprocessors_urlsegment'];
					}
				}
                $itemContent .= '</div>';
			}
			$drawItem = FALSE;
		}
	}
}
