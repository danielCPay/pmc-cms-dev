<?php

namespace App\Services\Impl;

use App\Services\InsuranceCompanyService;
use App\Repositories\InsuranceCompanyRepository;

class InsuranceCompanyServiceImpl implements InsuranceCompanyService
{
    protected $insuranceCompanyRepository;

    public function __construct(InsuranceCompanyRepository $insuranceCompanyRepository)
    {
        $this->insuranceCompanyRepository = $insuranceCompanyRepository;
    }

    public function getAllInsuranceCompanies()
    {
        return $this->insuranceCompanyRepository->getAll();
    }

    public function getLatestInsuranceCompany()
    {
        return $this->insuranceCompanyRepository->getLatest();
    }

    public function getInsuranceCompanyByName($insuranceCompanyName)
    {
        return $this->insuranceCompanyRepository->getByInsuranceCompanyName($insuranceCompanyName);
    }

    public function storeInsuranceCompany(array $data)
    {
        return $this->insuranceCompanyRepository->store($data);
    }

    public function getInsuranceCompanyById($insurancecompaniesid)
    {
        return $this->insuranceCompanyRepository->getById($insurancecompaniesid);
    }

    public function updateInsuranceCompany(array $data, $insurancecompaniesid)
    {
        return $this->insuranceCompanyRepository->update($data, $insurancecompaniesid);
    }

    public function deleteInsuranceCompany($insurancecompaniesid)
    {
        $this->insuranceCompanyRepository->delete($insurancecompaniesid);
    }
}