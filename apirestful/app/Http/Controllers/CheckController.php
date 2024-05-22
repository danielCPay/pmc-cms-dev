<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CheckService;

class CheckController extends Controller
{
    protected $checkService;

    public function __construct(CheckService $checkService)
    {
        $this->checkService = $checkService;
    }

    public function index()
    {

        return $this->checkService->getAllChecks();

    }

    public function getLatest()
    {
        // Find the last record and return it
        $check = $this->checkService->getLatestCheck();

        // Check if a record was found
        if ($check) {
            return $check;
        } else {
            // If no records are found, return a response indicating that the table is empty
            return response()->json(['message' => 'No records found'], 404);
        }
    }

    public function fillFields()
    {
        return $this->checkService->fillFields();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $check = $this->checkService->storeCheck($data);
        return response()->json(['message' => 'Check stored successfully', 'check' => $check], 201);
    }

    public function show($checksid)
    {
        return $this->checkService->getCheckById($checksid);
    }

    public function update(Request $request,$checksId)
    {
        $data = $request->all();
        $updateCheck = $this->checkService->updateCheck($data,$checksId);

        //return response()->json($request);
        // Return the updated Cases record
        return response()->json(['message' => 'Check updated successfully', 'check' => $updateCheck], 201);
    }

    public function destroy($checksid)
    {
        $this->checkService->deleteCheck($checksid);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    } 
    public function countRows($filePath){
       return $this->checkService->countRowsCheck($filePath);
    }
}
