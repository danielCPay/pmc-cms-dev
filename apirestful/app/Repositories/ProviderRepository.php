<?php
namespace App\Repositories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProviderRepository
{
    public function getAll()
    {
        return Provider::all();
    }

    public function getLatest()
    {
        // Find the last record and return it
        $lastProvider = Provider::latest('providersid')->first();

        // Provider if a record was found
        if ($lastProvider) {
            return $lastProvider;
        } else {
            // If no records are found, return a response indicating that the table is empty
            throw new ModelNotFoundException('No records found');
        }
    }

    public function getByProviderName($providerName){
        $provider = Provider::where('provider_name', $providerName)->first();
        if($provider){
            return $provider;
        }else {
            // If no records are found, return a response indicating that the table is empty
            throw new ModelNotFoundException('No records found');
        }
    }

    public function store(array $data)
    {
        return Provider::create($data);

    }

    public function getById($providersid)
    {
        $provider = Provider::where('providersid', $providersid)->firstOrFail();
        return $provider;
    }

    public function update(array $data, Provider $providersid)
    {
        // Find the Provider record by insurancecompanysid
        $provider = Provider::where('providersid', $providersid)->firstOrFail();

        // Update the Provider record with the request data
        $provider->update($data);

        // Return the updated Provider record
        return $provider;
    }

    public function delete($providersid)
    {
        // Find the Provider record by insurancecompanysid
        $provider = Provider::where('providersid', $providersid)->firstOrFail();

        // Delete the Provider record
        $provider->delete();

       
    }
}
?>