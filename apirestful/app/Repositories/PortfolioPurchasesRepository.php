<?php

namespace App\Repositories;

use App\Models\PortfolioPurchases;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PortfolioPurchasesRepository
{
    public function getAll()
    {
        return PortfolioPurchases::all();
    }

    public function getLatest()
    {
        // Find the last record and return it
        $lastPortfolio = PortfolioPurchases::latest('portfoliosid')->first();

        // Portfolio if a record was found
        if ($lastPortfolio) {
            return $lastPortfolio;
        } else {
            // If no records are found, return a response indicating that the table is empty
            throw new ModelNotFoundException('No records found');
        }
    }

    public function store(array $data)
    {
        return PortfolioPurchases::create($data);
    }

    public function getById($portfoliosid)
    {
        # return $this->prices->where('price','>=',0)->min('price');
        $portfolio = PortfolioPurchases::where('portfolio', $portfoliosid)->min('purchase_date');

        return substr($portfolio, 0, 10);
    }

    public function update(array $data, PortfolioPurchases $portfoliosid)
    {
        // Find the Portfolio record by insurancecompanysid
        $portfolio = PortfolioPurchases::where('portfoliosid', $portfoliosid)->firstOrFail();

        // Update the Portfolio record with the request data
        $portfolio->update($data);

        // Return the updated Portfolio record
        return $portfolio;
    }

    public function delete($portfoliosid)
    {
        // Find the Portfolio record by insurancecompanysid
        $portfolio = PortfolioPurchases::where('portfoliosid', $portfoliosid)->firstOrFail();

        // Delete the Portfolio record
        $portfolio->delete();
    }
}
