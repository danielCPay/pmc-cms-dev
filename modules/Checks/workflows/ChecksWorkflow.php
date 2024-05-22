<?php

/**
 * CasesWorkflow.
 *
 * @package   Workflow
 *
 * @copyright DOT Systems
 * @license   YetiForce Public License 3.0 (licenses/LicenseEN.txt or yetiforce.com)
 * @author    Marcos Arteta <marcos@claimpay.net>
 */

class ChecksWorkflow
{
    /**
	 * Recalculate from claim collections
	 *
	 * @param \Checks_Record_Model $recordModel
	 */
	
    public static function exampleMethod(Vtiger_Record_Model $recordModel)
    {
        $id = $recordModel->getId();
		

		\App\Log::warning("Checks::Workflows::exampleMethod:$id");
		
		$recordModel->exampleMethod();
        
    }

	/**
	 * Recalculate from claim collections
	 *
	 * @param \Checks_Record_Model $recordModel
	 */
	public static function fillFields(Vtiger_Record_Model $recordModel)
    {
        $id = $recordModel->getId();
		

		\App\Log::warning("Checks::Workflows::fillFields:$id");
		
		$recordModel->fillFields();
        
    }
	public static function import_claims_from_excel( Vtiger_Record_Model $recordModel)
    {
        \App\Log::warning( 'ImportClaims::import_claims_from_excel F-' . memory_get_usage( false) . " T-" . memory_get_usage( true));;

        $path = $recordModel->getFileDetails()['path'];
        $fn = $recordModel->get('filename');
        $at = $recordModel->getFileDetails()['attachmentsid'];
	}
}
?>