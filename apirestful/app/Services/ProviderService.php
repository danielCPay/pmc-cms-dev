<?php

namespace App\Services;

interface ProviderService
{
    public function getAllProviders();
    
    public function getLatestProvider();
    
    public function getProviderByName($providerName);

    public function storeProvider(array $data);

    public function getProviderById($providersid);

    public function updateProvider(array $data, $providersid);

    public function deleteProvider($providersid);
}