<?php

namespace App\Http\Controllers;

use App\HttpClients\ReportingApiClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function index(Request $request): View
    {
        $client  = new ReportingApiClient();

        $fromDate = Carbon::now()->subYears(10);
        $toDate = Carbon::now();

        // $response = $client->transactionList($fromDate, $toDate);
        // $response = $client->clientDetail('1081427-1695032602-3');
        // dd($response);

        return view('dashboard', [
            'user' => $request->user(),
        ]);
    }
}
