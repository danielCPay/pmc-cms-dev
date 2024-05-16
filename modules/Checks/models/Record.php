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
                            $update_batchnumber = $result['batch_number'] + 1;  //58

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

    public function fillFields()
    {
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

    public static function getNextBatchNumber()
    {
        \App\Log::warning("Checks::getNextBatchNumber");

        // get batch number from DB as max( batch_number ) + 1 for Checks using QueryGenerator
        $batchNumber = ((new \App\QueryGenerator('Checks'))->createQuery()->max('batch_number') ?: 0) + 1;

        \App\Log::warning("Checks::getNextBatchNumber:$batchNumber");
        return $batchNumber;
    }

    /**
     * Process Check, either first time or after changes.
     * 
     * @param \Vtiger_Record_Model $recordModel
     */
    public static function processCheck(Vtiger_Record_Model $recordModel)
    {
        $id = $recordModel->getId() ?: "NEW";
        \App\Log::warning("Checks::processCheck:$id");

        $documentType = (new \App\QueryGenerator('DocumentTypes'))->addCondition('document_type', 'Settlement Checks', 'e')->createQuery()->scalar();

        if ($id !== 'NEW') {
            // clear relations
            $checksRegisterModule = $recordModel->getModule();
            $relationModel = \Vtiger_Relation_Model::getInstance($checksRegisterModule, Vtiger_Module_Model::getInstance('Claims'));
            foreach (VTWorkflowUtils::getAllRelatedRecords($recordModel, 'Claims') as $relations) {
                $relationModel->deleteRelation($id, $relations['id']);
            }
            $relationModel = \Vtiger_Relation_Model::getInstance($checksRegisterModule, Vtiger_Module_Model::getInstance('Portfolios'));
            foreach (VTWorkflowUtils::getAllRelatedRecords($recordModel, 'Portfolios') as $relations) {
                $relationModel->deleteRelation($id, $relations['id']);
            }
            $relationModel = \Vtiger_Relation_Model::getInstance($checksRegisterModule, Vtiger_Module_Model::getInstance('Documents'));
            foreach (VTWorkflowUtils::getAllRelatedRecords($recordModel, 'Documents', ['document_type' => $documentType]) as $relations) {
                $relationModel->deleteRelation($id, $relations['id']);
                $documentRecordModel = Vtiger_Record_Model::getInstanceById($relations['id']);
                $documentRecordModel->delete();
            }
        }

        $claimNumber = $recordModel->get('claim_number');
        $providerName = $recordModel->get('provider_by_user');
        $insured = $recordModel->get('insured');
        $insuranceCompanyName = $recordModel->get('insurance_company_by_user');

        // var_dump($claimNumber, $providerName, $insured, $insuranceCompanyName);
        // exit();

        $case = null;
        $warnings = [];

        // get/prepare claim/case cache
        $cacheNameCases = "Checks:Cases";
        $cacheNameOutsideCases = "Checks:OutsideCases";
        $cacheNameClaims = "Checks:Claims";
        $cacheNameProviders = "Checks:Providers";
        $cacheNameInsuranceCompanies = "Checks:InsuranceCompanies";
        if (\App\Cache::has('Checks', $cacheNameCases)) {
            $cases = \App\Cache::get('Checks', $cacheNameCases);
        } else {
            $queryGenerator = new \App\QueryGenerator('Cases');
            $insuredField = $queryGenerator->getQueryRelatedField('insured_name:Insureds:insured')->getRelated();
            $query = $queryGenerator
                ->setFields(['id', 'case_id', 'claim_number', 'provider', 'provider_2', 'provider_3', 'provider_4', 'provider_5'])
                ->addRelatedField($insuredField)
                ->createQuery();

            $cases = array_map(function ($row) {
                // replace 'claim_number' and 'provider' columns with values with non-alphanumeric characters removed
                $row['claim_number'] = preg_replace('/[^[:alnum:]]+/ui', '', $row['claim_number']);
                $row['insured'] = $row['insuredInsuredsinsured_name'];
                return $row;
            }, $query->all());
            \App\Cache::save('Checks', $cacheNameCases);
        }
        if (\App\Cache::has('Checks', $cacheNameOutsideCases)) {
            $outsideCases = \App\Cache::get('Checks', $cacheNameOutsideCases);
        } else {
            $queryGenerator = new \App\QueryGenerator('OutsideCases');
            $insuredField = $queryGenerator->getQueryRelatedField('insured_name:Insureds:insured')->getRelated();
            $query = $queryGenerator
                ->setFields(['id', 'outside_case_id', 'claim_number', 'provider'])
                ->addRelatedField($insuredField)
                ->createQuery();
            $outsideCases = array_map(function ($row) {
                // replace 'claim_number' columns with values with non-alphanumeric characters removed
                $row['claim_number'] = preg_replace('/[^[:alnum:]]+/ui', '', $row['claim_number']);
                $row['insured'] = $row['insuredInsuredsinsured_name'];
                return $row;
            }, $query->all());
            \App\Cache::save('Checks', $cacheNameOutsideCases);
        }
        if (\App\Cache::has('Checks', $cacheNameClaims)) {
            $claims = \App\Cache::get('Checks', $cacheNameClaims);
        } else {
            $queryGenerator = new \App\QueryGenerator('Claims');
            $portfolioField = $queryGenerator->getQueryRelatedField('portfolio_id:Portfolios:portfolio')->getRelated();
            $insuredField = $queryGenerator->getQueryRelatedField('insured_name:Insureds:insured')->getRelated();
            $query = $queryGenerator
                ->setFields(['id', 'claim_id', 'claim_number', 'case', 'outside_case', 'provider'])
                ->addRelatedField($portfolioField)
                ->addRelatedField($insuredField)
                ->createQuery();
            $claims = array_map(function ($row) {
                // replace 'claim_number' columns with values with non-alphanumeric characters removed
                $row['claim_number'] = preg_replace('/[^[:alnum:]]+/ui', '', $row['claim_number']);
                $row['portfolio_id'] = $row['portfolioPortfoliosid'];
                $row['portfolio_name'] = $row['portfolioPortfoliosportfolio_id'];
                $row['insured'] = $row['insuredInsuredsinsured_name'];
                return $row;
            }, $query->all());
            \App\Cache::save('Checks', $cacheNameClaims);
        }
        if (\App\Cache::has('Checks', $cacheNameProviders)) {
            $providers = \App\Cache::get('Checks', $cacheNameProviders);
        } else {
            $queryGenerator = new \App\QueryGenerator('Providers');
            $query = $queryGenerator
                ->setFields(['id', 'provider_abbreviation', 'provider_name'])
                ->createQuery();
            $providers = array_map(function ($row) {
                $row['provider_abbreviation'] = preg_replace('/[^[:alnum:]]+/ui', '', $row['provider_abbreviation']);
                $row['provider_name'] = preg_replace('/[^[:alnum:]]+/ui', '', $row['provider_name']);
                return $row;
            }, $query->all());
            \App\Cache::save('Checks', $cacheNameProviders);
        }
        if (\App\Cache::has('Checks', $cacheNameInsuranceCompanies)) {
            $insuranceCompanies = \App\Cache::get('Checks', $cacheNameInsuranceCompanies);
        } else {
            $queryGenerator = new \App\QueryGenerator('InsuranceCompanies');
            $query = $queryGenerator
                ->setFields(['id', 'insurance_company_name'])
                ->createQuery();
            $insuranceCompanies = array_map(function ($row) {
                $row['insurance_company_name'] = preg_replace('/[^[:alnum:]]+/ui', '', $row['insurance_company_name']);
                return $row;
            }, $query->all());
            $queryGenerator = new \App\QueryGenerator('InsuranceCompanyAliases');
            $query = $queryGenerator
                ->setFields(['id', 'insurance_company_alias', 'insurance_company'])
                ->createQuery();
            // append aliases to insurance companies
            foreach ($query->all() as $row) {
                $insuranceCompanies[] = [
                    'id' => $row['insurance_company'],
                    'insurance_company_name' => preg_replace('/[^[:alnum:]]+/ui', '', $row['insurance_company_alias'])
                ];
            }
            \App\Cache::save('Checks', $cacheNameInsuranceCompanies);
        }

        // find match providers
        $processedProvider = preg_replace('/[^[:alnum:]]+/ui', '', $providerName);
        $matchedProviders = array_filter($providers, function ($provider) use ($processedProvider) {
            return strcasecmp($provider['provider_abbreviation'], $processedProvider) === 0;
        });
        if (count($matchedProviders) === 0) {
            $matchedProviders = array_filter($providers, function ($provider) use ($processedProvider) {
                return strcasecmp($provider['provider_name'], $processedProvider) === 0;
            });
        }
        // report if no provider or more than 1 provider
        if (count($matchedProviders) === 0) {
            $warnings[] = "Provider not found by abbreviation or name";
        } else if (count($matchedProviders) > 1) {
            $warnings[] = "Multiple providers found by abbreviation or name";
        } else {
            $provider = reset($matchedProviders)['id'];
        }

        //	find matching case and claims by provider + claim number
        $processedClaimNumber = preg_replace('/[^[:alnum:]]+/ui', '', $claimNumber);

        // find matching case by provider + claim number
        $cases = array_filter($cases, function ($case) use ($processedClaimNumber, $provider) {
            return strcasecmp($case['claim_number'], $processedClaimNumber) === 0 &&
                (($case['provider'] && $case['provider'] === $provider)
                    || ($case['provider_2'] && $case['provider_2'] === $provider)
                    || ($case['provider_3'] && $case['provider_3'] === $provider)
                    || ($case['provider_4'] && $case['provider_4'] === $provider)
                    || ($case['provider_5'] && $case['provider_5'] === $provider)
                );
        });
        $outsideCases = array_filter($outsideCases, function ($outsideCase) use ($processedClaimNumber, $provider) {
            return strcasecmp($outsideCase['claim_number'], $processedClaimNumber) === 0 && $outsideCase['provider'] === $provider;
        });

        // report if no or more than 1 case
        if (count($cases) === 0 && count($outsideCases) === 0) {
            $warnings[] = "Case (or Outside Case) not found by Provider and Claim Number";
        } else if (count($cases) > 1) {
            $warnings[] = "Multiple cases (" . \App\TextParser::textTruncate(implode(' ', array_map(function ($case) {
                return $case['case_id'];
            }, $cases)), 100) . ") found by Provider and Claim Number";
        } else if (count($outsideCases) > 1) {
            $warnings[] = "Multiple outside cases (" . \App\TextParser::textTruncate(implode(' ', array_map(function ($case) {
                return $case['outside_case_id'];
            }, $outsideCases)), 100) . ") found by Provider and Claim Number";
        } else if (count($cases) === 1 && count($outsideCases) === 1) {
            $warnings[] = "Both Case (" . reset($cases)['case_id'] . ") and Outside Case (" . reset($outsideCases)['outside_case_id'] . ") found by Provider and Claim Number";
        } else if (count($cases) === 1) {
            $case = reset($cases);
        } else if (count($outsideCases) === 1) {
            $outsideCase = reset($outsideCases);
        } else {
            $warnings[] = "Unexpected problem matching Case or Outside Case by Provider and Claim Number";
        }

        // find matching claims by provider + claim number
        $claims = array_filter($claims, function ($claim) use ($processedClaimNumber, $provider) {
            return strcasecmp($claim['claim_number'], $processedClaimNumber) === 0 && $claim['provider'] === $provider;
        });

        // report if no claims or claims do not match case
        if (count($claims) === 0) {
            $warnings[] = "Claim not found by Provider and Claim Number";
        } else if ($case) {
            $mismatchedClaims = array_filter($claims, function ($claim) use ($case) {
                return $claim['case'] != $case['id'];
            });
            foreach ($mismatchedClaims as $mismatchedClaim) {
                $warnings[] = "Claim '" . \App\Record::getLabel($mismatchedClaim['id']) . "' matched by Provider and Claim Number does not match Case";
            }
        } else if ($outsideCase) {
            $mismatchedClaims = array_filter($claims, function ($claim) use ($outsideCase) {
                return $claim['outside_case'] != $outsideCase['id'];
            });
            foreach ($mismatchedClaims as $mismatchedClaim) {
                $warnings[] = "Claim '" . \App\Record::getLabel($mismatchedClaim['id']) . "' matched by Provider and Claim Number does not match Outside Case";
            }
        }

        // report if insured doesn't match case or claim
        if ($case) {
            $caseInsured = $case['insured'];
            // compare caseInsured to insured case-insensitive and accent-insensitive
            if (strcasecmp($caseInsured, $insured) !== 0) {
                $warnings[] = "Insured in Case does not match Insured in Check";
            }
        } else if ($outsideCase) {
            $outsideCaseInsured = $outsideCase['insured'];
            // compare outsideCaseInsured to insured case-insensitive and accent-insensitive
            if (strcasecmp($outsideCaseInsured, $insured) !== 0) {
                $warnings[] = "Insured in Outside Case does not match Insured in Check";
            }
        }
        $mismatchedClaims = array_filter($claims, function ($claim) use ($insured) {
            return strcasecmp($claim['insured'], $insured) !== 0;
        });
        foreach ($mismatchedClaims as $mismatchedClaim) {
            $warnings[] = "Insured in Claim '" . \App\Record::getLabel($mismatchedClaim['id']) . "' does not match Insured in Check";
        }

        //	set claim ids to space separated list of claim labels, set portfolio to space separated list of portfolio labels from claims
        $claimIds = implode(' ', array_map(function ($claim) {
            return $claim['claim_id'];
        }, $claims));
        $portfolios = implode(' ', array_map(function ($claim) {
            return $claim['portfolio_name'];
        }, $claims));

        // match insurance company
        $processedInsuranceCompany = preg_replace('/[^[:alnum:]]+/ui', '', $insuranceCompanyName);
        $insuranceCompanies = array_unique(array_map(function ($row) {
            return $row['id'];
        }, array_filter($insuranceCompanies, function ($insuranceCompany) use ($processedInsuranceCompany) {
            return strcasecmp($insuranceCompany['insurance_company_name'], $processedInsuranceCompany) === 0;
        })));

        // report if no insurance company or more than 1 insurance company
        if (count($insuranceCompanies) === 0) {
            $warnings[] = "Insurance Company not found by name or alias";
        } else if (count($insuranceCompanies) > 1) {
            $warnings[] = "Multiple insurance companies found by name or alias";
        } else {
            $insuranceCompany = reset($insuranceCompanies);
        }

        $recordModel->set('case_id', $case['id']);
        $recordModel->set('outside_case_id', $outsideCase['id']);
        $recordModel->set('claim_ids', $claimIds);
        $recordModel->set('portfolio', $portfolios);
        $recordModel->set('provider', $provider);
        $recordModel->set('insurance_company', $insuranceCompany);
        $recordModel->set('warnings', implode("\n", $warnings));

        $recordModel->save();

        //	setup relations to claims and to portfolios
        $checksRegisterModule = $recordModel->getModule();
        $relationModel = \Vtiger_Relation_Model::getInstance($checksRegisterModule, Vtiger_Module_Model::getInstance('Claims'));
        foreach ($claims as $claim) {
            $relationModel->addRelation($recordModel->getId(), $claim['id']);
        }

        $relationModel = \Vtiger_Relation_Model::getInstance($checksRegisterModule, Vtiger_Module_Model::getInstance('Portfolios'));
        foreach ($claims as $claim) {
            $relationModel->addRelation($recordModel->getId(), $claim['portfolio_id']);
        }

        // download file from URL in db_link
        $dbLink = $recordModel->get('db_link');
        if ($dbLink) {
            // remove GET parameter dl with it's value and append dl=1
            $dbLink = preg_replace('/\bdl=[^&]*&?/', '', $dbLink);
            $dbLink .= (strpos($dbLink, '?') === false ? '?' : '&') . 'dl=1';

            $params = [];
            $file = \App\Fields\File::loadFromUrl($dbLink, $params, true);
            if ($file && $file->validateAndSecure()) {
                $params['document_type'] = $documentType;
                $params['checks_register'] = $recordModel->getId();
                ['crmid' => $fileId] = \App\Fields\File::saveFromContent($file, $params);

                // add relation to current module
                $relationModel = Vtiger_Relation_Model::getInstance($checksRegisterModule, Vtiger_Module_Model::getInstance('Documents'));
                if ($relationModel->getRelationType() != Vtiger_Relation_Model::RELATION_O2M || empty($relationModel->getRelationField())) {
                    $relationModel->addRelation($recordModel->getId(), $fileId);
                }

                $recordModel->set('check', $fileId);
                $recordModel->save();
            } else if ($file) {
                $file->delete();
            } else {
                throw new ImportException('Error while downloading file');
            }
        }

        \App\Log::warning("Checks::processCheck:finished");
    }
}
