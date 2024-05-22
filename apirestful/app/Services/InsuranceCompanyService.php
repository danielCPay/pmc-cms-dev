<?php

namespace App\Services;

interface InsuranceCompanyService
{
    public function getAllInsuranceCompanies();
    
    public function getLatestInsuranceCompany();
    
    public function getInsuranceCompanyByName($insuranceCompanyName);

    public function storeInsuranceCompany(array $data);

    public function getInsuranceCompanyById($insurancecompaniesid);

    public function updateInsuranceCompany(array $data, $insurancecompaniesid);

    public function deleteInsuranceCompany($insurancecompaniesid);
}