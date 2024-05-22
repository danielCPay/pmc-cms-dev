<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InsuranceCompanyService;

class InsuranceCompanyController extends Controller
{
    protected $insuranceCompanyService;

    public function __construct(InsuranceCompanyService $insuranceCompanyService)
    {
        $this->insuranceCompanyService = $insuranceCompanyService;
    }
    public function index()
    {
        $insuranceCompanies = $this->insuranceCompanyService->getAllInsuranceCompanies();
        return $insuranceCompanies;
    }

    public function getLatest()
    {
        $insuranceCompany = $this->insuranceCompanyService->getLatestInsuranceCompany();
        if ($insuranceCompany) {
            return $insuranceCompany;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'InsuranceCompany not found'], 404);
        }
    }

    public function getByInsuranceCompanyName($insuranceCompanyName)
    {
        $insuranceCompany = $this->insuranceCompanyService->getInsuranceCompanyByName($insuranceCompanyName);

        if ($insuranceCompany) {
            return $insuranceCompany;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'InsuranceCompany not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $insuranceCompany = $this->insuranceCompanyService->storeInsuranceCompany($data);
        return response()->json(['message' => 'InsuranceCompany stored successfully', 'insuranceCompany' => $insuranceCompany], 201);
    }

    public function show($insurancecompaniesid)
    {
        $insuranceCompany = $this->insuranceCompanyService->getInsuranceCompanyById($insurancecompaniesid);
        return $insuranceCompany;
    }

    public function update(Request $request, $insurancecompaniesid)
    {
        $data = $request->all();
        $insuranceCompany = $this->insuranceCompanyService->updateInsuranceCompany($data,$insurancecompaniesid);

        // Return the updated InsuranceCompanys record
        return response()->json(['message' => 'InsuranceCompany updated successfully', 'insuranceCompany' => $insuranceCompany], 201);
    }

    public function destroy($insurancecompaniesid)
    {
        $this->insuranceCompanyService->deleteInsuranceCompany($insurancecompaniesid);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    }
}
