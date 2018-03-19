<?php
namespace Brightside\Youtubevideo\DataProcessing;

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

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Class for data processing for the content element "My new content element"
 */
class DatabaseCustomQueryProcessor implements DataProcessorInterface
{

   /**
    * Process data for the content element "My new content element"
    *
    * @param ContentObjectRenderer $cObj The data of the content element or page
    * @param array $contentObjectConfiguration The configuration of Content Object
    * @param array $processorConfiguration The configuration of this processor
    * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
    * @return array the processed data as key/value store
    */
   public function process(
      ContentObjectRenderer $cObj,
      array $contentObjectConfiguration,
      array $processorConfiguration,
      array $processedData
   )
   {
    // do the math for start time
    	$startminute = $cObj->data['tx_youtubevideo_startminute'];
   		$startsecond = $cObj->data['tx_youtubevideo_startsecond'];
   		$processedData['start'] = ($startminute * 60) + $startsecond;
   		
    // process youtube URLs to video code
      $youtube_url = $cObj->data['tx_youtubevideo_url'];
			$pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i';
			$youtube_id = (preg_replace($pattern, '$1', $youtube_url));
      $processedData['code'] = $youtube_id;
      
    // check if the higres cover image is available
      $maxrescover = 'https://img.youtube.com/vi/'.$youtube_id.'/maxresdefault.jpg';
			$file_headers = @get_headers($maxrescover);
			if(!$file_headers || $file_headers[0] == 'HTTP/1.0 404 Not Found') {
			  $nomaxrescover = true;
			}
			else {
			  $nomaxrescover = false;
			}
			
			$processedData['nomaxrescover'] = $nomaxrescover;
			
      return $processedData;
   }
}