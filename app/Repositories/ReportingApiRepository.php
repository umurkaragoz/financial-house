<?php

namespace App\Repositories;

use App\HttpClients\ReportingApiClient;
use Illuminate\Support\Facades\Cache;

class ReportingApiRepository
{
    private ReportingApiClient $client;

    public function __construct(ReportingApiClient $client)
    {
        $this->client = $client;
    }

    public function getTransactions($filters = null)
    {
        $filterHash = base64_encode(json_encode($filters));

        return Cache::remember("reporting-api-transaction-list-$filterHash", 60, function () use ($filters) {
            $response = $this->client->transactionList($filters);

            return $response->data;
        });
    }

    public function getTransactionDetail($transactionId)
    {
        return Cache::remember("reporting-api-transaction-detail-$transactionId", 60, function () use ($transactionId) {
            $response = $this->client->transactionDetail($transactionId);

            return $response->data;
        });
    }

    public function getClientDetail($transactionId)
    {
        return Cache::remember("reporting-api-client-detail-$transactionId", 60, function () use ($transactionId) {
            $response = $this->client->clientDetail($transactionId);

            return $response->data;
        });
    }
}
