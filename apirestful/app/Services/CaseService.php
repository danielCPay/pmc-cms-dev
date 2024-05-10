<?php

namespace App\Services;

interface CaseService
{
    public function getAllCases();
    
    public function getLatestCase();
    
    public function getCaseByClaimNumber($claimNumber);

    public function storeCase(array $data);

    public function getCaseById($casesid);

    public function updateCase(array $data, $casesid);

    public function deleteCase($casesid);
}