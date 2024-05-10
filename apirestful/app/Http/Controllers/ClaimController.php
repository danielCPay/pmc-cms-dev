<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClaimService;

class ClaimController extends Controller
{
    protected $claimService;

    public function __construct(ClaimService $claimService)
    {
        $this->claimService = $claimService;
    }
    public function index()
    {
        $claims = $this->claimService->getAllClaims();
        return $claims;
    }

    public function getLatest()
    {
        $claim = $this->claimService->getLatestClaim();
        if ($claim) {
            return $claim;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'Claim not found'], 404);
        }
    }

    public function getByClaimNumber($claimNumber)
    {
        $claim = $this->claimService->getClaimByClaimNumber($claimNumber);

        if ($claim) {
            return $claim;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'Claim not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $claim = $this->claimService->storeClaim($data);
        return response()->json(['message' => 'Claim stored successfully', 'claim' => $claim], 201);
    }

    public function show($claimsid)
    {
        $claim = $this->claimService->getClaimById($claimsid);
        return $claim;
    }

    public function update(Request $request, $claimsid)
    {
        $data = $request->all();
        $claim = $this->claimService->updateClaim($data,$claimsid);

        // Return the updated Claims record
        return response()->json(['message' => 'Claim updated successfully', 'claim' => $claim], 201);
    }

    public function destroy($claimsid)
    {
        $this->claimService->deleteClaim($claimsid);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    }
}
