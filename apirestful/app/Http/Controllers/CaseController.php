<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CaseService;

class CaseController extends Controller
{
    protected $caseService;

    public function __construct(CaseService $caseService)
    {
        $this->caseService = $caseService;
    }
    public function index()
    {
        $cases = $this->caseService->getAllCases();
        return $cases;
    }

    public function getLatest()
    {
        $case = $this->caseService->getLatestCase();
        if ($case) {
            return $case;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'Case not found'], 404);
        }
    }

    public function getByClaimNumber($claimNumber)
    {
        $case = $this->caseService->getCaseByClaimNumber($claimNumber);

        if ($case) {
            return $case;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'Case not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $case = $this->caseService->storeCase($data);
        return response()->json(['message' => 'Case stored successfully', 'case' => $case], 201);
    }

    public function show($casesid)
    {
        $case = $this->caseService->getCaseById($casesid);
        return $case;
    }

    public function update(Request $request, $casesid)
    {
        $data = $request->all();
        $case = $this->caseService->updateCase($data,$casesid);

        // Return the updated Cases record
        return response()->json(['message' => 'Case updated successfully', 'case' => $case], 201);
    }

    public function destroy($casesid)
    {
        $this->caseService->deleteCase($casesid);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    }
}
