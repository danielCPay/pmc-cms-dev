<?php
require_once '/var/www/html/service/CheckService.php';
/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * Contributor(s): DOT Systems
 * *********************************************************************************** */

/**
 * Class Cases_Record_Model.
 */
class Checks_Record_Model extends Vtiger_Record_Model
{
    
    protected $checkService;
    public function __construct()
    {
        $this->checkService = new CheckService();
    }
    /*public function exampleMethod($importFileType) {
        $id = $this->getId();
        $lockAutomation = $this->get('lock_automation');
        \App\Log::warning("Checks::exampleMethod:$id/$lockAutomation");
        if (!$lockAutomation) {

            $db = \App\Db::getInstance();
            // Construct the SQL query directly
            $sql = "SELECT batch_number AS max_batchnumber FROM u_yf_checks ORDER BY batch_number DESC LIMIT 1";
            
            // Ejecutar la consulta y obtener el resultado
            $result = $db->createCommand($sql)->queryOne();

            // Obtener el valor máximo del campo 'amount'
            $max_batchnumber = isset($result['max_batchnumber']) ? $result['max_batchnumber'] : 0;

            if ($importFileType === 'csv' || $importFileType === 'excel') {
                // Code to handle CSV file import
                // For example:
                //$this->handleCsvImport();
                $batch_number=$max_batchnumber;
            }else {
                // Code to handle when no document is being imported
                // For example:
                //$this->handleNoImport();
                $batch_number=$max_batchnumber+1;
            }
            
            // Asignar el valor máximo al campo 'batch_number' del registro actual
            $this->set('batch_number', $batch_number);

            // Guardar los cambios en el registro
            $this->save();
        }
    }*/
    public function exampleMethod()
    {
        $id = $this->getId();
        $lockAutomation = $this->get('lock_automation');

        if (!$lockAutomation) {

            \App\Log::warning("Checks::exampleMethod:$id/$lockAutomation");

            $db = \App\Db::getInstance();
            $sql = "SELECT * FROM u_yf_checks ORDER BY checksid DESC LIMIT 1,1";
            $result = $db->createCommand($sql)->queryOne();
            $last_batchnumber = $result['batch_number'];   // -2   -1
            $checksid = $result['checksid'];  //   365889   365890
            $batch_number = 0;
            $last_checksid = 0;
            $sql1 = "SELECT batch_number AS last_batchnumber1 FROM u_yf_checks ORDER BY checksid DESC LIMIT 2,1";
            $result1 = $db->createCommand($sql1)->queryOne();
            $last_batchnumber1 = $result1['last_batchnumber1'];   // 57    -2

            if ($last_batchnumber > 0) {
                $batch_number = $last_batchnumber + 1;   //

            } else {
                if ($last_batchnumber == -1) {
                    //

                    $sql3 = "SELECT * FROM u_yf_checks WHERE batch_number < :lastbatchnumber";
                    $params3 = [':lastbatchnumber' => 0];
                    $result3 = $db->createCommand($sql3, $params3)->queryAll();
                    $cont = 0;
                    $sql = "SELECT * FROM u_yf_checks ORDER BY batch_number DESC LIMIT 1";
                    $result = $db->createCommand($sql)->queryOne();
                    $update_batchnumber = $result['batch_number'] - 1;
                    $updateSql = "UPDATE u_yf_checks SET batch_number = :update_batchnumber WHERE batch_number = :batch_number";
                    $updateParams = [':update_batchnumber' => $update_batchnumber, ':batch_number' => $result['batch_number']];
                    $db->createCommand($updateSql, $updateParams)->execute();


                    //$sql4 = "SELECT * FROM u_yf_checks ORDER BY CAST(SUBSTRING(number, 2) AS UNSIGNED) DESC LIMIT :offset, 1";
                    //$sql4 = "SELECT * FROM u_yf_checks ORDER BY batch_number  DESC LIMIT 1";
                    //$offset = $n + 1; // Calcular el desplazamiento negativo
                    //$params4 = [':offset' => $offset];
                    //$result4 = $db->createCommand($sql4, $params4)->queryOne();


                    foreach ($result3 as $row) {

                        // Actualizar el batch_number a un nuevo valor
                        if ($cont == 0) {
                            $update_batchnumber = $result['batch_number'];  //57

                            $updateSql = "UPDATE u_yf_checks SET batch_number = :update_batchnumber WHERE checksid = :checksid";
                            $updateParams = [':update_batchnumber' => $update_batchnumber, ':checksid' => $row['checksid']];
                            $db->createCommand($updateSql, $updateParams)->execute();
                            $cont++;
                        } else {
                            $update_batchnumber = $result['batch_number']+1;  //58

                            $updateSql = "UPDATE u_yf_checks SET batch_number = :update_batchnumber WHERE checksid = :checksid";
                            $updateParams = [':update_batchnumber' => $update_batchnumber, ':checksid' => $row['checksid']];
                            $db->createCommand($updateSql, $updateParams)->execute();
                        }

                        // Opcional: Almacenar los registros actualizados en un arreglo
                        //$batchNumberMinusOneRecords[] = $row;
                    }
                    $batch_number = $result['batch_number'] + 1;
                    
                } else {

                    $batch_number = $last_batchnumber + 1;  // -1

                }
            }
            $this->set('batch_number', $batch_number);
            $this->save();

        }
    }

    public function fillFields(){
        $id = $this->getId();
        $lockAutomation = $this->get('lock_automation');

        if (!$lockAutomation) {
            \App\Log::warning("Checks::fillFields:$id/$lockAutomation");

            $this->checkService->fillFields('fill/fields');
        }
        
    }

    
    private function countCsvRows($filePath)
    {
        $file = fopen($filePath, 'r');
        $rowCount = 0;
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $rowCount++;
            }
            fclose($file);
        } else {
            \App\Log::error("No se pudo abrir el archivo CSV: $filePath");
        }
        return $rowCount;
    }
    
}