<?php

namespace App\HttpClients;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ReportingApiClient
{
    private $authEmail = '';
    
    private $authPassword = '';

    private $apiUrl = '';

    public $success;

    public $message;

    public $request;

    public $rawResponse;

    public $data;

    /**
     * HTTP code returned from the request
     *
     * @var $httpCode int
     */
    public $httpCode;


    function __construct()
    {
        $this->apiUrl = config('services.reporting-api.url');
        $this->authEmail = config('services.reporting-api.email');
        $this->authPassword = config('services.reporting-api.password');

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------------------------------------ get Token -+- */
    public function getToken()
    {
        // Token is valid for 10 minutes.
        // We cache it for 8 minutes just to be on the safe side.
        $token = Cache::remember('reporting-api-token', 4800, function () {
            $this->rawHttpRequest('merchant/user/login', [
                "email"    => $this->authEmail,
                "password" => $this->authPassword,
            ], 'POST');


            $token = object_get($this->rawResponse, 'token');

            return $token;
        });

        if ($this->httpCode == 400) {
            Cache::forget('reporting-api-token');

            return false;
        }

        return $token;
    }

    /* ----------------------------------------------------------------------------------------------------------------------- raw Http Request -+- */
    /**
     * Make an HTTP request to one of the endpoints
     * Success criteria is whether the connection with the remote server established
     *
     * @param  string  $interface
     * @param  array  $parameters
     * @param  string  $method
     * @param  array  $headers
     *
     * @return $this
     */
    public function rawHttpRequest($interface = "", $parameters = [], $method = 'GET', $headers = [])
    {
        // build query from parameters
        if ($method == 'GET' && count($parameters)) {
            $query = http_build_query($parameters);
            $interface .= "?$query";
        }

        $ch = curl_init($this->apiUrl."/$interface");

        // merge custom headers with basic ones
        $headers = array_merge([
            "Content-Type: application/json",
        ], $headers);

        // set the headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($method == 'POST') {
            // set request method to POST
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
        } else if ($method == 'PUT') {
            // set request method to POST
            curl_setopt($ch, CURLOPT_PUT, 1);
        }

        // execute the request and get the response
        $response = curl_exec($ch);
        $this->httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->request = $ch;

        if (curl_error($ch)) {
            // a cURL error was occurred
            $this->success = false;
            $this->error = 'cURL error code '.curl_errno($ch).': '.curl_error($ch);
        } else {
            $this->success = true;

            // parse the response
            $this->rawResponse = json_decode($response);
        }

        return $this;
    }

    /* ---------------------------------------------------------------------------------------------------------------------------- api Request -+- */
    /**
     * Make a high level request to one of the API endpoints
     * Parse the returning data in a way specific to this API
     * Success criteria is specific to this API
     * Handles auth (token retrieval) process automatically
     *
     * @param  string  $interface
     * @param  array  $parameters
     * @param  string  $method
     * @param  array  $headers
     *
     * @return $this
     */
    public function apiRequest($interface = "", $parameters = [], $method = 'GET', $headers = [])
    {
        $headers = array_merge($headers, [
            "authorization: ".$this->getToken(),
        ]);

        // make the request
        $this->rawHttpRequest($interface, $parameters, $method, $headers);

        $response = $this->rawResponse;
        $status = object_get($response, 'status');

        if ($status === 'DECLINED') {
            $this->success = false;
            $this->message = object_get($response, 'message');
            $this->data = null;

            Log::info('ReportingApiClient Error', [
                'status'   => $status,
                'message'  => $this->message,
                'httpCode' => $this->httpCode,
            ]);
        } else {
            $this->success = true;
            $this->message = null;
            $this->data = object_get($response, 'data');
        }

        return $this;
    }

    /* ----------------------------------------------------------------------------------------------------------------------- transaction List -+- */
    public function transactionList(Carbon $fromDate = null, Carbon $toDate = null)
    {
        $this->apiRequest('transaction/list', [
            'fromDate' => $fromDate->format('Y-m-d'),
            'toDate' => $toDate->format('Y-m-d'),
        ], 'POST');

        return $this;
    }


    /* -------------------------------------------------------------------------------------------------------------------------------------------- */
}
