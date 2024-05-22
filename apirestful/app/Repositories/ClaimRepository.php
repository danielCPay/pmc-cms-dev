<?php
namespace App\Repositories;

use App\Models\Claim;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClaimRepository
{
    public function getAll()
    {
        return Claim::all();
    }

    public function getLatest()
    {
        // Find the last record and return it
        $lastClaim = Claim::latest('claimsid')->first();

        // Claim if a record was found
        if ($lastClaim) {
            return $lastClaim;
        } else {
            // If no records are found, return a response indicating that the table is empty
            throw new ModelNotFoundException('No records found');
        }
    }

    public function getByClaimNumber($claimNumber)
    {
        $claims = Claim::where('claim_number', $claimNumber)->get();

        if ($claims->isEmpty()) {
            // If no records are found, return a response indicating that the table is empty
            throw new ModelNotFoundException('No records found');
        } else {
            return $claims;
        }
    }
    public function store(array $data)
    {
        return Claim::create($data);

    }

    public function getById($claimsid)
    {
        $claim = Claim::where('claimsid', $claimsid)->firstOrFail();
        return $claim;
    }

    public function update(array $data, Claim $claimsid)
    {
        // Find the Claim record by claimsid
        $claim = Claim::where('claimsid', $claimsid)->firstOrFail();

        // Update the Claim record with the request data
        $claim->update($data);

        // Return the updated Claim record
        return $claim;
    }

    public function delete($claimsid)
    {
        // Find the Claim record by claimsid
        $claim = Claim::where('claimsid', $claimsid)->firstOrFail();

        // Delete the Claim record
        $claim->delete();

        
    }
}
?>