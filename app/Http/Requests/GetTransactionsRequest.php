<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetTransactionsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fromDate'      => 'required|date_format:Y-m-d',
            'toDate'        => 'required|date_format:Y-m-d',
            'status'        => Rule::in(["","APPROVED", "WAITING", "DECLINED", "ERROR"]),
            'operation'     => Rule::in(["","DIRECT", "REFUND", "3D", "3DAUTH", "STORED"]),
            'paymentMethod' => Rule::in(["","CREDITCARD", "CUP", "IDEAL", "GIROPAY", "MISTERCASH", "STORED", "PAYTOCARD", "CEPBANK", "CITADEL"]),
            'errorCode'     => Rule::in(
                [
                    "",
                    "Do not honor",
                    "Invalid Transaction",
                    "Invalid Card",
                    "Not sufficient funds",
                    "Incorrect PIN",
                    "Invalid country association",
                    "Currency not allowed",
                    "3-D Secure Transport Error",
                    "Transaction not permitted to cardholder",
                ]
            ),
            'filterField'   => Rule::in(["","Transaction UUID", "customerEmail", "Reference No", "Custom Data", "Card PAN"]),
            'filterValue'   => 'nullable|string',
        ];
    }
}
