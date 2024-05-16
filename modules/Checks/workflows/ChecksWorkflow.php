<?php

/**
 * ChecksWorkflow
 *
 * @package   Workflow
 *
 * @copyright DOT Systems
 * @license   YetiForce Public License 3.0 (licenses/LicenseEN.txt or yetiforce.com)
 * @author    Michał Kamiński <mkaminski@dotsystems.pl>
 * @author    Michał Jastrzębski <mjastrzebski@dotsystems.pl>
 */

class ChecksWorkflow
{
	/**
	 * Assign Batch Number.
	 *
	 * @param \Vtiger_Record_Model $recordModel
	 */
  public static function assignNextBatchNumber( Vtiger_Record_Model $recordModel )
  {
    $id = $recordModel->getId();
    \App\Log::warning("Checks::Workflows::assignNextBatchNumber:$id");

    $batchNumber = Record::getNextBatchNumber();

    $recordModel->set('batch_number', $batchNumber);
    $recordModel->save();

    \App\Log::warning("Checks::Workflows::assignNextBatchNumber:batch number = $batchNumber");
  }

  /**
   * Reprocess Check.
   * 
   * @param \Vtiger_Record_Model $recordModel
   */
  public static function reprocessCheck( Vtiger_Record_Model $recordModel )
  {
    $id = $recordModel->getId();
    \App\Log::warning("Checks::Workflows::reprocessCheck:$id");

    Record::processCheck($recordModel);
    
    \App\Log::warning("Checks::Workflows::reprocessCheck:done");
  }
}