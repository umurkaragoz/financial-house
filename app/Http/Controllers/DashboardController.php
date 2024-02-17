<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTransactionsRequest;
use App\Repositories\ReportingApiRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private ReportingApiRepository $reportingApiRepository;

    public function __construct(ReportingApiRepository $reportingApiRepository)
    {
        $this->reportingApiRepository = $reportingApiRepository;
    }


    public function index(Request $request): View
    {
        return view('dashboard', [
            'user' => $request->user(),
        ]);
    }


    public function transactionDetail(Request $request, $transactionId): View
    {
        $transaction = $this->reportingApiRepository->getTransactionDetail($transactionId);

        return view('transaction-detail', [
            'transaction'   => $transaction,
            'user'          => $request->user(),
        ]);
    }

    public function getTransactions(GetTransactionsRequest $request)
    {
        return json_encode($this->reportingApiRepository->getTransactions($request->all()));
    }
}
