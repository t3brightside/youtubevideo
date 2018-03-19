<?php
namespace Brightside\Youtubevideo\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
	
class YoutubevideoContentElementPreviewRenderer implements PageLayoutViewDrawItemHookInterface {
	 /**
     * Preprocesses the preview rendering of a content element of type "textmedia"
     *
     * @param \TYPO3\CMS\Backend\View\PageLayoutView $parentObject Calling parent object
     * @param bool $drawItem Whether to draw the item using the default functionality
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     *
     * @return void
     */

	 public function preProcess(PageLayoutView &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row) {

		if ($row['CType'] === 'youtubevideo_pi1') {
			$youtube_url = $parentObject->renderText($row['tx_youtubevideo_url']);
			$pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i';
			$youtube_id = (preg_replace($pattern, '$1', $youtube_url));


			$itemContent .= '<div class="youtubevideo">';
			$itemContent .= '<iframe class="youtubeIframe" src="https://www.youtube.com/embed/';
			$itemContent .= $youtube_id;
			$itemContent .= '?showinfo=0&amp;rel=0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			<div class="breaker"></div>';
			if ($row['tx_youtubevideo_caption']) {
            	$itemContent .= '<p class="title"><b>' . $parentObject->linkEditContent($parentObject->renderText($row['tx_youtubevideo_caption']), $row) . '</b></p>';
			}
			if ($row['tx_youtubevideo_covertitle']) {
            	$itemContent .= '<p class="covertitle"><b>' . $parentObject->linkEditContent($parentObject->renderText($row['tx_youtubevideo_covertitle']), $row) . '</b></p>';
			}
			if ($row['tx_youtubevideo_covertext']) {
            	$itemContent .= '<p class="covertext">' . $parentObject->linkEditContent($parentObject->renderText($row['tx_youtubevideo_covertext']), $row) . '</p>';
			}
			if (!$row['tx_youtubevideo_caption'] or !$row['tx_youtubevideo_covertitle'] or !$row['tx_youtubevideo_covertext']) {
				$itemContent .= '<br />';
			}
			if (($row['tx_youtubevideo_autoplay'] > 0) or ($row['tx_youtubevideo_showinfo'] > 0) or ($row['tx_youtubevideo_rel'] > 0) or ($row['tx_youtubevideo_fullscreen'] > 0) or ($row['tx_youtubevideo_loop'] > 0)) {
				$itemContent .= '<ul class="options">';
			}
			if ($row['tx_youtubevideo_autoplay'] > 0){
				$itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText($row[''].'autoplay'), $row).'</li>';
			}
			if ($row['tx_youtubevideo_showinfo'] > 0){
				$itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText($row[''].'info'), $row).'</li>';
			}
			if ($row['tx_youtubevideo_rel'] > 0){
				$itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText($row[''].'related'), $row).'</li>';
			}
			if ($row['tx_youtubevideo_fullscreen'] > 0){
				$itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText($row[''].'fullscreen'), $row).'</li>';
			}
			if ($row['tx_youtubevideo_loop'] > 0){
				$itemContent .= '<li>' . $parentObject->linkEditContent($parentObject->renderText($row[''].'loop'), $row).'</li>';
			}
			if (($row['tx_youtubevideo_autoplay'] > 0) or ($row['tx_youtubevideo_showinfo'] > 0) or ($row['tx_youtubevideo_rel'] > 0) or ($row['tx_youtubevideo_fullscreen'] > 0) or ($row['tx_youtubevideo_loop'] > 0)) {
				$itemContent .= '</ul>';
			}

			if (($row['tx_youtubevideo_startminute']) or ($row['tx_youtubevideo_startsecond'])) {
				$itemContent .= '<span class="start">Start at: ';
			}
			if ($row['tx_youtubevideo_startminute']) {
            	$itemContent .= $parentObject->linkEditContent($parentObject->renderText($row['tx_youtubevideo_startminute'].' min</i>&nbsp;'), $row);
			}
			if ($row['tx_youtubevideo_startsecond']) {
            	$itemContent .= $parentObject->linkEditContent($parentObject->renderText($row['tx_youtubevideo_startsecond'].' sec'), $row);
			}
			if (($row['tx_youtubevideo_startminute']) or ($row['tx_youtubevideo_startsecond'])) {
				$itemContent .= '</span>';
			}
			$itemContent .= '</div>';
			$drawItem = FALSE;

		}
	}
}

