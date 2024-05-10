<?php

namespace App\Services\Impl;

use App\Services\CheckService;
use App\Models\Check;
use App\Repositories\CheckRepository;

class CheckServiceImpl implements CheckService
{
    protected $checkRepository;

    public function __construct(CheckRepository $checkRepository)
    {
        $this->checkRepository = $checkRepository;
    }

    public function getAllChecks()
    {
        return $this->checkRepository->getAll();
    }

    public function getLatestCheck()
    {
        return $this->checkRepository->getLatest();
    }

    public function fillFields()
    {
        return $this->checkRepository->fillFields();
    }

    public function storeCheck(array $data)
    {
        return $this->checkRepository->store($data);
    }

    public function getCheckById($checksid)
    {
        return $this->checkRepository->getById($checksid);
    }

    public function updateCheck(array $data,$checksId)
    {
        return $this->checkRepository->update($data,$checksId);
    }

    public function deleteCheck($checksid)
    {
        $this->checkRepository->delete($checksid);
    }
    public function countRowsCheck($filePath){
        return $this->checkRepository->countRows($filePath);
    }
}