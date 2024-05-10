<?php
namespace App\Repositories;

use App\Models\Check;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Vtiful\Kernel\Excel;
class CheckRepository
{
    protected $claimRepository, $providerRepository, $insurancecompanyRepository, $caseRepository;
    
    public function __construct(ClaimRepository $claimRepository, ProviderRepository $providerRepository, InsuranceCompanyRepository $insurancecompanyRepository, CaseRepository $caseRepository)
    {
        $this->claimRepository = $claimRepository;
        $this->providerRepository = $providerRepository;
        $this->insurancecompanyRepository = $insurancecompanyRepository;
        $this->caseRepository = $caseRepository;
        
    }

    public function getAll()
    {


        return Check::all();

    }

    public function getLatest()
    {
        // Find the last record and return it
        $lastCheck = Check::latest('checksid')->first();

        // Check if a record was found
        if ($lastCheck) {
            return $lastCheck;
        } else {
            // If no records are found, return a response indicating that the table is empty
            throw new ModelNotFoundException('No records found');
        }
    }

    public function fillFields()
    {

        // Find the last record and return it
        $lastCheck = $this->getLatest();


        $claims = $this->claimRepository->getByClaimNumber($lastCheck->claim_number);

        // Initialize an array to store the claim ids
        $claimIds = [];

        if (count($claims) > 1) {
            foreach ($claims as $claim) {
                $claimIds[] = $claim->claim_id;
            }
        } else {
            $claimIds[] = $claims->claim_id;

        }
        $claim=$claims[0];
        $claimNumber=$claim->claim_number;
        // Convert the array of claim ids to a comma-separated string
        $claimIds = implode(',', $claimIds);
        
        $insurancecompany = $this->insurancecompanyRepository->getByInsuranceCompanyName($lastCheck->insurance_company_by_user);
        $provider = $this->providerRepository->getByProviderName($lastCheck->provider_by_user);
        $case = $this->caseRepository->getByClaimNumber($claimNumber);

        $lastCheck->case_id = $case->casesid;
        $lastCheck->provider = $provider->providersid;
        $lastCheck->insurance_company = $insurancecompany->insurancecompaniesid;
        $lastCheck->claim_ids=$claimIds;
        $lastCheck->portfolios=$claim->portfolio;
        //Save the data
        $lastCheck->save();
        return $lastCheck;

    }
    public function store(array $data)
    {
        return Check::create($data);

    }

    public function getById($checksid)
    {
        $check = Check::where('checksid', $checksid)->firstOrFail();
        return $check;
    }

    public function update(array $data, $checksId)
    {
        // Find the Check record by checksid
        $updateCheck = Check::where('checksid', $checksId)->firstOrFail();

        // Update the Check record with the request data
        $updateCheck->update($data);

        // Return the updated Check record
        return $updateCheck;
    }

    public function delete($checksid)
    {
        // Find the Check record by checksid
        $check = Check::where('checksid', $checksid)->firstOrFail();

        // Delete the Check record
        $check->delete();

    }
    public function countRows($filePath)
    {
        // Crear una instancia de la clase Excel
        $excel = new Excel();

        // Abrir el archivo Excel
        $excel->openFile($filePath);

        // Obtener la hoja de cálculo del archivo Excel
        $sheet = $excel->getSheet();

        // Obtener el número de la fila más alta en la hoja de cálculo
        $rowCount = $sheet->getHighestRow();

        // Cerrar el archivo Excel
        $excel->close();

        return $rowCount;
    }
}
?>