<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProviderService;

class ProviderController extends Controller
{
    protected $providerService;

    public function __construct(ProviderService $providerService)
    {
        $this->providerService = $providerService;
    }
    public function index()
    {
        $providers = $this->providerService->getAllProviders();
        return $providers;
    }

    public function getLatest()
    {
        $provider = $this->providerService->getLatestProvider();
        if ($provider) {
            return $provider;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'Provider not found'], 404);
        }
    }

    public function getByProviderName($providerName)
    {
        $provider = $this->providerService->getProviderByName($providerName);

        if ($provider) {
            return $provider;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'Provider not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $provider = $this->providerService->storeProvider($data);
        return response()->json(['message' => 'Provider stored successfully', 'provider' => $provider], 201);
    }

    public function show($providersid)
    {
        $provider = $this->providerService->getProviderById($providersid);
        return $provider;
    }

    public function update(Request $request, $providersid)
    {
        $data = $request->all();
        $provider = $this->providerService->updateProvider($data,$providersid);

        // Return the updated Providers record
        return response()->json(['message' => 'Provider updated successfully', 'provider' => $provider], 201);
    }

    public function destroy($providersid)
    {
        $this->providerService->deleteProvider($providersid);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    }
}
