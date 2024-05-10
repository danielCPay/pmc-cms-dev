<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PortfolioService;

class PortfolioController extends Controller
{
    protected $portfolioService;

    public function __construct(PortfolioService $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }
    public function index()
    {
        $portfolios = $this->portfolioService->getAllPortfolios();
        return $portfolios;
    }

    public function getLatest()
    {
        $portfolio = $this->portfolioService->getLatestPortfolio();
        if ($portfolio) {
            return $portfolio;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'Portfolio not found'], 404);
        }
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $portfolio = $this->portfolioService->storePortfolio($data);
        return response()->json(['message' => 'Portfolio stored successfully', 'portfolio' => $portfolio], 201);
    }

    public function show($portfoliosid)
    {
        $portfolio = $this->portfolioService->getPortfolioById($portfoliosid);
        return $portfolio;
    }

    public function update(Request $request, $portfoliosid)
    {
        $data = $request->all();
        $portfolio = $this->portfolioService->updatePortfolio($data,$portfoliosid);

        // Return the updated Portfolios record
        return response()->json(['message' => 'Portfolio updated successfully', 'portfolio' => $portfolio], 201);
    }

    public function destroy($portfoliosid)
    {
        $this->portfolioService->deletePortfolio($portfoliosid);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    }
}
