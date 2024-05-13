<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PortfolioPurchasesService;

class PortfolioPurchasesController extends Controller
{
    protected $portfolioPurchasesService;

    public function __construct(PortfolioPurchasesService $portfolioPurchasesService)
    {
        $this->portfolioPurchasesService = $portfolioPurchasesService;
    }
    public function index()
    {
        $portfolios = $this->portfolioPurchasesService->getAllPortfolios();
        return $portfolios;
    }

    public function getLatest()
    {
        $portfolio = $this->portfolioPurchasesService->getLatestPortfolio();
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
        $portfolio = $this->portfolioPurchasesService->storePortfolio($data);
        return response()->json(['message' => 'Portfolio stored successfully', 'portfolio' => $portfolio], 201);
    }

    public function show($portfoliosid)
    {
        $portfolio = $this->portfolioPurchasesService->getPortfolioById($portfoliosid);
        return $portfolio;
    }

    public function update(Request $request, $portfoliosid)
    {
        $data = $request->all();
        $portfolio = $this->portfolioPurchasesService->updatePortfolio($data,$portfoliosid);

        // Return the updated Portfolios record
        return response()->json(['message' => 'Portfolio updated successfully', 'portfolio' => $portfolio], 201);
    }

    public function destroy($portfoliosid)
    {
        $this->portfolioPurchasesService->deletePortfolio($portfoliosid);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    }
}
