<?php

namespace App\Services;

interface PortfolioPurchasesServices
{
    public function getAllPortfolios();
    
    public function getLatestPortfolio();

    public function storePortfolio(array $data);

    public function getPortfolioById($portfoliosid);

    public function updatePortfolio(array $data, $portfoliosid);

    public function deletePortfolio($portfoliosid);
}