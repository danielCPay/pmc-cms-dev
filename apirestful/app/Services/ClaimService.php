<?php

namespace App\Services;

interface ClaimService
{
    public function getAllClaims();
    
    public function getLatestClaim();
    
    public function getClaimByClaimNumber($claimNumber);

    public function storeClaim(array $data);

    public function getClaimById($claimsid);

    public function updateClaim(array $data, $claimsid);

    public function deleteClaim($claimsid);
}