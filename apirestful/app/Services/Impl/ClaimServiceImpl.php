<?php

namespace App\Services\Impl;

use App\Services\ClaimService;
use App\Repositories\ClaimRepository;

class ClaimServiceImpl implements ClaimService
{
    protected $claimRepository;

    public function __construct(ClaimRepository $claimRepository)
    {
        $this->claimRepository = $claimRepository;
    }

    public function getAllClaims()
    {
        return $this->claimRepository->getAll();
    }

    public function getLatestClaim()
    {
        return $this->claimRepository->getLatest();
    }

    public function getClaimByClaimNumber($claimNumber)
    {
        return $this->claimRepository->getByClaimNumber($claimNumber);
    }

    public function storeClaim(array $data)
    {
        return $this->claimRepository->store($data);
    }

    public function getClaimById($claimsid)
    {
        return $this->claimRepository->getById($claimsid);
    }

    public function updateClaim(array $data, $claimsid)
    {
        return $this->claimRepository->update($data, $claimsid);
    }

    public function deleteClaim($claimsid)
    {
        $this->claimRepository->delete($claimsid);
    }
}