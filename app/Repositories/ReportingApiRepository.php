<?php

namespace App\Repositories;

use App\HttpClients\ReportingApiClient;
use Carbon\Carbon;
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

        $response = Cache::remember("reporting-api-transaction-list-$filterHash", 60, function () use ($filters) {
            $client = new ReportingApiClient();
            $response = $client->transactionList($filters);

            return $response->data;
        });

        return $response;
    }

    public function getTransactionDetail($transactionId)
    {
        $response = Cache::remember("reporting-api-transaction-detail-$transactionId", 60, function () use ($transactionId) {
            $client = new ReportingApiClient();
            $response = $client->transactionDetail($transactionId);

            return $response->data;
        });

        return $response;
    }
}
