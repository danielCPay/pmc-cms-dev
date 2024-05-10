<?php

namespace App\Services\Impl;

use App\Services\PortfolioService;
use App\Repositories\PortfolioRepository;

class PortfolioServiceImpl implements PortfolioService
{
    protected $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }

    public function getAllPortfolios()
    {
        return $this->portfolioRepository->getAll();
    }

    public function getLatestPortfolio()
    {
        return $this->portfolioRepository->getLatest();
    }

    public function storePortfolio(array $data)
    {
        return $this->portfolioRepository->store($data);
    }

    public function getPortfolioById($portfoliosid)
    {
        return $this->portfolioRepository->getById($portfoliosid);
    }

    public function updatePortfolio(array $data, $portfoliosid)
    {
        return $this->portfolioRepository->update($data, $portfoliosid);
    }

    public function deletePortfolio($portfoliosid)
    {
        $this->portfolioRepository->delete($portfoliosid);
    }
}