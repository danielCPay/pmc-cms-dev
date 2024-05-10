<?php

require_once 'claimsAttachements.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Color;

require_once '/var/www/html/service/CheckService.php';
class ImportChecks
{

    /**
     * Recalculate from claim collections
     *
     * @param \Documents_Record_Model $recordModel
     */


    public static function import_checks_from_excel(Vtiger_Record_Model $recordModel)
    {


        $path = $recordModel->getFileDetails()['path'];
        $fn = $recordModel->get('filename');
        $at = $recordModel->getFileDetails()['attachmentsid'];

        // Counting rows without processing the data
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path . $at);
        $worksheet = $spreadsheet->getActiveSheet();
        //$rowCount = $worksheet->getHighestRow();

        // Get the highest row and column index
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        // Iterate through each row
        $data = [];
        for ($row = 2; $row <= $highestRow; $row++) {
            // Iterate through each column in the row
            $rowData = [];
            for ($col = 'A'; $col <= $highestColumn; $col++) {
                // Get the value of the current cell
                $cellValue = $worksheet->getCell($col . $row)->getValue();
                // Add the value to the row data
                $rowData[] = $cellValue;
            }
            // Add the row data to the main data array
            $data[] = $rowData;
        }

        // Process the data here, for example:
        foreach ($data as $rowData) {
            // Process each row of data as needed
            // Example: $rowData[0] contains the value of the first cell in the row
            
        }

        // Update the record model with the row count information
        $recordModel->set('verification_warnings', 'Number of rows in the Excel file: ');
        $recordModel->save();


        /*$data=[
            "amount"=>1
        ];

        $this->checkService->update('366017',$data);*/
        $id = $recordModel->getId();

        \App\Log::warning("Documents::Workflows::import_checks_from_excel:$id");

        $recordModel->import_checks_from_excel($data[0][6]);
    }


}
?>