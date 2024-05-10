<?php

namespace App\Services\Impl;

use App\Services\CaseService;
use App\Repositories\CaseRepository;

class CaseServiceImpl implements CaseService
{
    protected $caseRepository;

    public function __construct(CaseRepository $caseRepository)
    {
        $this->caseRepository = $caseRepository;
    }

    public function getAllCases()
    {
        return $this->caseRepository->getAll();
    }

    public function getLatestCase()
    {
        return $this->caseRepository->getLatest();
    }

    public function getCaseByClaimNumber($claimNumber)
    {
        return $this->caseRepository->getByClaimNumber($claimNumber);
    }

    public function storeCase(array $data)
    {
        return $this->caseRepository->store($data);
    }

    public function getCaseById($casesid)
    {
        return $this->caseRepository->getById($casesid);
    }

    public function updateCase(array $data, $casesid)
    {
        return $this->caseRepository->update($data, $casesid);
    }

    public function deleteCase($casesid)
    {
        $this->caseRepository->delete($casesid);
    }
}