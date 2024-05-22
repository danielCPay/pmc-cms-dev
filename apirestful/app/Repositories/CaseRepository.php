<?php
namespace App\Repositories;

use App\Models\Cases;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CaseRepository
{
    public function getAll()
    {
        return Cases::all();
    }

    public function getLatest()
    {
        // Find the last record and return it
        $lastCases = Cases::latest('casesid')->first();

        // Cases if a record was found
        if ($lastCases) {
            return $lastCases;
        } else {
            // If no records are found, return a response indicating that the table is empty
            throw new ModelNotFoundException('No records found');
        }
    }

    public function getByClaimNumber($claimNumber){
        $case = Cases::where('claim_number', $claimNumber)->first();
        if($case){
            return $case;
        }else {
            // If no records are found, return a response indicating that the table is empty
            throw new ModelNotFoundException('No records found');
        }
    }

    public function store(array $data)
    {
        return Cases::create($data);

    }

    public function getById($casesid)
    {
        $case = Cases::where('casesid', $casesid)->firstOrFail();
        return $case;
    }

    public function update(array $data, Cases $casesid)
    {
        // Find the Cases record by casesid
        $case = Cases::where('casesid', $casesid)->firstOrFail();

        // Update the Cases record with the request data
        $case->update($data);

        // Return the updated Cases record
        return $case;
    }

    public function delete($casesid)
    {
        // Find the Cases record by casesid
        $case = Cases::where('casesid', $casesid)->firstOrFail();

        // Delete the Cases record
        $case->delete();

    }
}
?>