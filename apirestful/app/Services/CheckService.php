<?php

namespace App\Services;
use App\Models\Check;
interface CheckService
{
    public function getAllChecks();
    
    public function getLatestCheck();
    
    public function fillFields();

    public function storeCheck(array $data);

    public function getCheckById($checksid);

    public function updateCheck(array $data,$checksId);

    public function deleteCheck($checksid);
    public function countRowsCheck($filePath);
}