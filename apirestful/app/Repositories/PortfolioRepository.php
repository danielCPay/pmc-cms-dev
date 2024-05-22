<?php
namespace App\Repositories;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PortfolioRepository
{
    public function getAll()
    {
        return Portfolio::all();
    }

    public function getLatest()
    {
        // Find the last record and return it
        $lastPortfolio = Portfolio::latest('portfoliosid')->first();

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
        return Portfolio::create($data);

    }

    public function getById($portfoliosid)
    {
        $portfolio = Portfolio::where('portfoliosid', $portfoliosid)->firstOrFail();
        return $portfolio;
    }

    public function update(array $data, $portfoliosid)
    {
        // Find the Portfolio record by insurancecompanysid
        //$portfolio = Portfolio::where('portfoliosid', $portfoliosid)->firstOrFail();           
        // Update the Portfolio record with the request data
        //$portfolio->update($data);
        // Return the updated Portfolio record
        //return $portfolio;        
        $portfolio = Portfolio::find($portfoliosid);

        $portfolio->opened_date = $data['opened_date'];

        $portfolio->save();

        return $portfolio; 
    }

    public function delete($portfoliosid)
    {
        // Find the Portfolio record by insurancecompanysid
        $portfolio = Portfolio::where('portfoliosid', $portfoliosid)->firstOrFail();

        // Delete the Portfolio record
        $portfolio->delete();

       
    }
}
?>