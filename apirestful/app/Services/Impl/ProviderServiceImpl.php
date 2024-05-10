<?php

namespace App\Services\Impl;

use App\Services\ProviderService;
use App\Repositories\ProviderRepository;

class ProviderServiceImpl implements ProviderService
{
    protected $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function getAllProviders()
    {
        return $this->providerRepository->getAll();
    }

    public function getLatestProvider()
    {
        return $this->providerRepository->getLatest();
    }

    public function getProviderByName($providerName)
    {
        return $this->providerRepository->getByProviderName($providerName);
    }

    public function storeProvider(array $data)
    {
        return $this->providerRepository->store($data);
    }

    public function getProviderById($providersid)
    {
        return $this->providerRepository->getById($providersid);
    }

    public function updateProvider(array $data, $providersid)
    {
        return $this->providerRepository->update($data, $providersid);
    }

    public function deleteProvider($providersid)
    {
        $this->providerRepository->delete($providersid);
    }
}