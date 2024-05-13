<?php

namespace App\Services\Impl;

use App\Services\PortfolioPurchasesService;
use App\Repositories\PortfolioPurchasesRepository;

class PortfolioPurchasesServiceImpl implements PortfolioPurchasesService
{
    protected $portfolioPurchasesRepository;

    public function __construct(PortfolioPurchasesRepository $portfolioPurchasesRepository)
    {
        $this->portfolioPurchasesRepository = $portfolioPurchasesRepository;
    }

    public function getAllPortfolios()
    {
        return $this->portfolioPurchasesRepository->getAll();
    }

    public function getLatestPortfolio()
    {
        return $this->portfolioPurchasesRepository->getLatest();
    }

    public function storePortfolio(array $data)
    {
        return $this->portfolioPurchasesRepository->store($data);
    }

    public function getPortfolioById($portfoliosid)
    {
        return $this->portfolioPurchasesRepository->getById($portfoliosid);
    }

    public function updatePortfolio(array $data, $portfoliosid)
    {
        return $this->portfolioPurchasesRepository->update($data, $portfoliosid);
    }

    public function deletePortfolio($portfoliosid)
    {
        $this->portfolioPurchasesRepository->delete($portfoliosid);
    }
}