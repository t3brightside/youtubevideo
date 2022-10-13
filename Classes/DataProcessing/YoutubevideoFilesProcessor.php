<?php
namespace Brightside\Youtubevideo\DataProcessing;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\DataProcessing\FilesProcessor;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\OnlineMediaHelperRegistry;
use Brightside\Paginatedprocessors\Processing\DataToPaginatedData;

class YoutubevideoFilesProcessor extends FilesProcessor
{
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        $allProcessedData = parent::process($cObj, $contentObjectConfiguration, $processorConfiguration, $processedData);

        // Get youtube files from content element
        $fileRepository = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\FileRepository::class);

        if (isset($cObj->data['_LOCALIZED_UID'])) {
            $youtubeObjects = $fileRepository->findByRelation('tt_content', 'tx_youtubevideo_assets', $cObj->data['_LOCALIZED_UID']);
        } else {
            $youtubeObjects = $fileRepository->findByRelation('tt_content', 'tx_youtubevideo_assets', $cObj->data['uid']);
        }
        // Loop throguh files to get data and vover image relations
        foreach ($youtubeObjects as $video) {
            $previewImageObjects = $fileRepository->findByRelation('sys_file_reference', 'tx_youtubevideo_coverimage', $video->getUid());

            // Get the original cover image and title
            $originalvideo = $video->getOriginalFile();
            $helper = GeneralUtility::makeInstance(OnlineMediaHelperRegistry::class)->getOnlineMediaHelper($originalvideo);
            $previewFileName = $helper->getPreviewImage($originalvideo);
            $original = array(
                'title' => $originalvideo->getProperty('title'),
                'preview' => $helper->getPreviewImage($originalvideo),
            );

            // Get start and end time and convert it to seconds
            if($video->getProperty('tx_youtubevideo_starttime')) {
                $starttime = explode(':', strval($video->getProperty('tx_youtubevideo_starttime')));
                $start = ((int)$starttime[0] * 3600) + ((int)$starttime[1] * 60) + (int)$starttime[2];
            } else {
                $start = 0;
            }
            if($video->getProperty('tx_youtubevideo_endtime')) {
                $endtime = explode(':', strval($video->getProperty('tx_youtubevideo_endtime')));
                $end = ((int)$endtime[0] * 3600) + ((int)$endtime[1] * 60) + (int)$endtime[2];
            } else {
                $end = 0;
            }
            // Get video settings
            $settings = array(
                'loop' => $video->getProperty('tx_youtubevideo_loop'),
                'mute' => $video->getProperty('tx_youtubevideo_mute'),
                'start' => $start,
                'end' => $end,
                'fullscreen' => $video->getProperty('tx_youtubevideo_fullscreen'),
                'ratio' => $video->getProperty('tx_youtubevideo_ratio'),
                'rel' => $video->getProperty('tx_youtubevideo_rel'),
            );

            // Get custom cover image
            $coverImages = array();
            foreach ($previewImageObjects as $image) {
                $coverImages[] = $image;
            }

            // Create video array
            $youtubeVideos[] = array(
                'video' => $video,
                'original' => $original,
                'settings' => $settings,
                'coverimages' => $coverImages
            );
        }

        $allProcessedData['youtubevideos'] = $youtubeVideos;

        // Paginate with 'paginatedprocessors' extension
        $paginationSettings = $processorConfiguration['pagination.'];
        if ((int)($cObj->stdWrapValue('isActive', $paginationSettings ?? []))) {
            $paginatedData = new DataToPaginatedData();
            $allProcessedData = $paginatedData->getPaginatedData(
                $cObj,
                $contentObjectConfiguration,
                $processorConfiguration,
                $allProcessedData,
                $allProcessedData['youtubevideos'],
                'youtubevideos'
            );
            return $allProcessedData;
        } else {
            return $allProcessedData;
        }
    }
}
