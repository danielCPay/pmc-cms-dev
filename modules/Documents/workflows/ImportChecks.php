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

        var_dump("invoque Importacion Checks");
        exit();
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

    public static function importIncomingChecks(Vtiger_Record_Model $recordModel)
    {
        $id = $recordModel->getId();
        $path = $recordModel->getFileDetails()['path'];
        $fileName = $recordModel->get('filename');
        $attachmentId = $recordModel->getFileDetails()['attachmentsid'];
        \App\Log::warning("Documents::Workflows::importIncomingChecks:$id/$fileName/$path/$attachmentId");

        try {
            $fullPath = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $attachmentId;
            $checks = self::parseIncomingChecks($fullPath);
            \App\Log::warning("Documents::Workflows::importIncomingChecks:checks parsed = " . count($checks));

            // get batch number from DB as max( batch_number ) + 1 for ChecksRegister using QueryGenerator
            $batchNumber = ChecksRegister_Module_Model::getNextBatchNumber();
            // foreach check
            foreach ($checks as $check) {
                //	create CheckRegistry record
                $recordModel = Vtiger_Record_Model::getCleanInstance('ChecksRegister');
                $recordModel->set('check_number', $check['check_number']);
                $recordModel->set('claim_number', $check['claim_number']);
                $recordModel->set('provider_user', $check['provider']);
                $recordModel->set('insurance_company_user', $check['insurance_carrier']);
                $recordModel->set('amount', $check['amount']);
                $recordModel->set('scan_date', $check['scan_date']);
                $recordModel->set('db_link', $check['db_link']);
                $recordModel->set('attorney', $check['attorney']);
                $recordModel->set('insured', $check['insured']);
                $recordModel->set('batch_number', $batchNumber);

                ChecksRegister_Module_Model::processCheck($recordModel);

                $checksRegisterModule = $recordModel->getModule();
                $relationModel = \Vtiger_Relation_Model::getInstance($checksRegisterModule, Vtiger_Module_Model::getInstance('Documents'));
                $relationModel->addRelation($recordModel->getId(), $id);
            }
        } catch (Exception $ex) {
            \App\Log::error("Documents::Workflows::importIncomingChecks:Problem importing file $fullPath - " . $ex->getMessage());
            \App\Toasts::addToast(\App\User::getCurrentUserOriginalId(), "Problem importing file $fileName - " . $ex->getMessage(), "errorSticky");
            throw new \App\Exceptions\NoRethrowWorkflowException("Problem importing file $fileName - " . $ex->getMessage(), 0, $ex);
        }

        \App\Toasts::addToast(\App\User::getCurrentUserOriginalId(), "File $fileName imported", "successSticky");
    }

    public static function parseIncomingChecks(string $fullPath)
    {
        try {
            /**  Identify the type of $inputFileName  **/
            $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($fullPath);
            /**  Create a new Reader of the type that has been identified  **/
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $spreadSheet = $reader->load($fullPath);

            if ($spreadSheet->getSheetCount() == 0) {
                throw new ImportException("No sheets found in file");
            }
        } catch (Exception $ex) {
            \App\Log::error("Documents::Workflows::importChecks:Problem reading file $fullPath - " . $ex->getMessage());
            throw new ImportException("Problem reading file $fullPath - " . $ex->getMessage());
        }

        $columns = [
            "INSURED" => ["fieldName" => "insured", "columnNumber" => -1],
            "CHECK NUMBER" => ["fieldName" => "check_number", "columnNumber" => -1],
            "PROVIDER" => ["fieldName" => "provider", "columnNumber" => -1],
            "ATTORNEY" => ["fieldName" => "attorney", "columnNumber" => -1],
            "INSURANCE CARRIER" => ["fieldName" => "insurance_carrier", "columnNumber" => -1],
            "CLAIM NUMBER" => ["fieldName" => "claim_number", "columnNumber" => -1],
            "AMOUNT" => ["fieldName" => "amount", "columnNumber" => -1],
            "SCAN DATE" => ["fieldName" => "scan_date", "columnNumber" => -1],
            "DB LINK" => ["fieldName" => "db_link", "columnNumber" => -1],
        ];

        try {
            $workSheet = $spreadSheet->setActiveSheetIndex(0);

            $rowsChecked = 1;
            $rowIterator = $workSheet->getRowIterator();
            foreach ($rowIterator as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(true);

                $headerLocated = false;
                foreach ($cellIterator as $cell) {
                    $cellValue = $cell->getValue();
                    $cellValue = trim(strtoupper($cellValue));
                    if (array_key_exists($cellValue, $columns) && $columns[$cellValue]["columnNumber"] === -1) {
                        $columns[$cellValue]["columnNumber"] = $cell->getColumn();
                        $headerLocated = true;
                    }
                }

                if ($headerLocated) {
                    // check if all headers have column number different from -1
                    $missingHeaders = array_filter($columns, function ($column) {
                        return $column['columnNumber'] === -1;
                    });
                    if (!empty($missingHeaders)) {
                        throw new ImportException("Not all headers found: " . implode(", ", array_keys($missingHeaders)));
                    }

                    break;
                }

                if ($rowsChecked++ > 10) {
                    throw new ImportException("Header not found in first 10 rows");
                }
            }

            if (!$headerLocated) {
                throw new ImportException("Header row not found");
            }

            $checks = [];
            $rowIterator = $workSheet->getRowIterator($rowsChecked + 1);
            foreach ($rowIterator as $row) {
                $check = [];
                foreach ($columns as $column) {
                    $cell = $workSheet->getCell($column["columnNumber"] . $row->getRowIndex());
                    if (Date::isDateTime($cell)) {
                        $cellValue = Date::excelToDateTimeObject($cell->getValue())->format('Y-m-d');
                    } else {
                        $cellValue = trim($cell->getValue());
                    }

                    $check[$column["fieldName"]] = $cellValue;
                }
                $checks[] = $check;
            }
        } catch (Exception $ex) {
            throw new ImportException("Problem parsing file $fullPath - " . $ex->getMessage());
        }

        return $checks;
    }
}
