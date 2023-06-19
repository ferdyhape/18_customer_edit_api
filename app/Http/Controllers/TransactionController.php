<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function updateTransaction(Request $request, $id)
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . session('token')
        ]]);
        $tResponse = $client->request('POST', "http://143.198.213.176/api/user/partner/transaction/$id", ['multipart' => [
            [
                'name' => 'payment_proof',
                'contents' => fopen($request->file('avatar'), 'r'),
                'filename' => $request->file('avatar')->getClientOriginalName(),
                'Mime-Type' => $request->file('avatar')->getmimeType()
            ],
        ]]);
        $tBody = $tResponse->getBody()->getContents();
        $tData = json_decode($tBody, true);
        extract($tData);
        return redirect('dashboard/transaction');
    }
}
