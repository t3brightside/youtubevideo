<?php

namespace Brightside\Youtubevideo\Updates;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

class UpgradeCoverimageField implements UpgradeWizardInterface
{
    /**
     * Return the identifier for this wizard
     * This should be the same string as used in the ext_localconf class registration
     *
     * @return string
     */
    public function getIdentifier(): string
    {
      return 'youtubevideo_upgradeCoverimageField';
    }

    /**
     * Return the speaking name of this wizard
     *
     * @return string
     */
    public function getTitle(): string
    {
      return 'Youtubevideo cover image migration';
    }

    /**
     * Return the description for this wizard
     *
     * @return string
     */
    public function getDescription(): string
    {
      return 'BACK UP your database before execute! And then execute to migrate cover images for the version 2.0 and above from tt_content.image to tt_content.tx_youtubevideo_coverimage';
    }

    /**
     * Execute the update
     *
     * Called when a wizard reports that an update is necessary
     *
     * @return bool
     */
    public function executeUpdate(): bool
    {
      $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_file_reference');
      $selectFileRecords = $queryBuilder
        ->select('sys_file_reference.uid')
        ->from('sys_file_reference')
        ->join(
           'sys_file_reference',
           'tt_content',
           'c',
           $queryBuilder->expr()->eq('sys_file_reference.uid_foreign', $queryBuilder->quoteIdentifier('c.uid'))
        )
        ->where(
          $queryBuilder->expr()->eq('c.cType', $queryBuilder->createNamedParameter('youtubevideo_pi1')),
          $queryBuilder->expr()->eq('sys_file_reference.fieldname', $queryBuilder->createNamedParameter('image')),
          $queryBuilder->expr()->eq('c.image', $queryBuilder->createNamedParameter(1))
        )
        ->execute()
        ->fetchAll();

        $fileRecordUids = array_column($selectFileRecords, 'uid');
        $queryBuilder2 = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_file_reference');
        $updateReferences = $queryBuilder2
          ->update('sys_file_reference')
          ->where(
            $queryBuilder2->expr()->in('sys_file_reference.uid',$queryBuilder2->createNamedParameter($fileRecordUids, Connection::PARAM_INT_ARRAY))
          )
          ->set('fieldname', 'tx_youtubevideo_coverimage')
          ->execute();

          $queryBuilder3 = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
          $updateElements = $queryBuilder3
            ->update('tt_content')
            ->where(
              $queryBuilder3->expr()->eq('image',1),
              $queryBuilder3->expr()->eq('cType', $queryBuilder3->createNamedParameter('youtubevideo_pi1'))
            )
            ->set(
              'tx_youtubevideo_coverimage', '1'
            )
            ->set(
              'image', '0'
            )
            ->execute();

        return true;
    }

    /**
     * Is an update necessary?
     *
     * Is used to determine whether a wizard needs to be run.
     * Check if data for migration exists.
     *
     * @return bool Whether an update is required (TRUE) or not (FALSE)
     *
     * SELECT tt_content.uid, tt_content.image, tt_content.cType, sys_file_reference.uid_foreign, sys_file_reference.fieldname
     * FROM sys_file_reference
     * JOIN tt_content ON sys_file_reference.uid_foreign = tt_content.uid
     * WHERE tt_content.CType = 'youtubevideo_pi1' AND sys_file_reference.fieldname = 'image' AND tt_content.image = 1;
     */

   public function updateNecessary(): bool
    {
      $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_file_reference');
      $count = $queryBuilder
        ->count('sys_file_reference.uid_foreign', 'sys_file_reference.fieldname')
        ->from('sys_file_reference')
        ->join(
           'sys_file_reference',
           'tt_content',
           'c',
           $queryBuilder->expr()->eq('sys_file_reference.uid_foreign', $queryBuilder->quoteIdentifier('c.uid'))
        )
        ->where(
          $queryBuilder->expr()->eq('c.cType', $queryBuilder->createNamedParameter('youtubevideo_pi1')),
          $queryBuilder->expr()->eq('sys_file_reference.fieldname', $queryBuilder->createNamedParameter('image')),
          $queryBuilder->expr()->eq('c.image', $queryBuilder->createNamedParameter(1))
        )
        ->execute()
        ->fetchColumn(0);
        return $count;
    }
    /**
     * Returns an array of class names of prerequisite classes
     *
     * This way a wizard can define dependencies like "database up-to-date" or
     * "reference index updated"
     *
     * @return string[]
     */
    public function getPrerequisites(): array
    {
    }
}
