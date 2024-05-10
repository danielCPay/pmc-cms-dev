<?php
namespace App\Repositories;

use App\Models\InsuranceCompany;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InsuranceCompanyRepository
{
    public function getAll()
    {
        return InsuranceCompany::all();
    }

    public function getLatest()
    {
        // Find the last record and return it
        $lastInsuranceCompany = InsuranceCompany::latest('insurancecompaniesid')->first();

        // InsuranceCompany if a record was found
        if ($lastInsuranceCompany) {
            return $lastInsuranceCompany;
        } else {
            // If no records are found, return a response indicating that the table is empty
            throw new ModelNotFoundException('No records found');
        }
    }

    public function getByInsuranceCompanyName($insuranceCompanyName){
        $insuranceCompany = InsuranceCompany::where('insurance_company_name', $insuranceCompanyName)->first();
        if($insuranceCompany){
            return $insuranceCompany;
        }else {
            // If no records are found, return a response indicating that the table is empty
            throw new ModelNotFoundException('No records found');
        }
    }

    public function store(array $data)
    {
        return InsuranceCompany::create($data);

    }

    public function getById($insurancecompaniesid)
    {
        $insuranceCompany = InsuranceCompany::where('insurancecompaniesid', $insurancecompaniesid)->firstOrFail();
        return $insuranceCompany;
    }

    public function update(array $data, InsuranceCompany $insurancecompaniesid)
    {
        // Find the InsuranceCompany record by insurancecompanysid
        $insuranceCompany = InsuranceCompany::where('insurancecompaniesid', $insurancecompaniesid)->firstOrFail();

        // Update the InsuranceCompany record with the request data
        $insuranceCompany->update($data);

        // Return the updated InsuranceCompany record
        return $insuranceCompany;
    }

    public function delete($insurancecompaniesid)
    {
        // Find the InsuranceCompany record by insurancecompanysid
        $insuranceCompany = InsuranceCompany::where('insurancecompaniesid', $insurancecompaniesid)->firstOrFail();

        // Delete the InsuranceCompany record
        $insuranceCompany->delete();

    }
}
?>