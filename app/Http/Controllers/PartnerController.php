<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PartnerController extends Controller
{

    public function index()
    {
        return view('mitra.gabungmitra', [
            "title" => "Gabung Mitra"
        ]);
    }

    public function store(Request $request)
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . session('token')
        ]]);

        $aResponse = $client->request('POST', "http://143.198.213.176/api/user/partner", ['multipart' => [
            [
                'name' => 'partner_name',
                'contents' => $request->partnername
            ],

            [
                'name' => 'email',
                'contents' => $request->email
            ],

            [
                'name' => 'phone_number',
                'contents' => $request->nophone
            ],

            [
                'name' => 'avatar',
                'contents' => fopen($request->file('avatar'), 'r'),
                'filename' => $request->file('avatar')->getClientOriginalName(),
                'Mime-Type' => $request->file('avatar')->getmimeType()
            ],

            [
                'name' => 'address',
                'contents' => $request->address
            ],

            [
                'name' => 'description',
                'contents' => $request->desc
            ],

            [
                'name' => 'category_id',
                'contents' => $request->category
            ],
            [
                'name' => 'link_google_map',
                'contents' => $request->gmap
            ],
            [
                'name' => 'village_id',
                'contents' => $request->village
            ],
        ]]);
        $aBody = $aResponse->getBody()->getContents();
        $aData = json_decode($aBody, true);
        extract($aData);

        //$sesi = session()->put('role', 1);
        return redirect('/statusmitra');
    }

    public function mypartner()
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . session('token')
        ]]);
        $uResponse = $client->request('GET', "http://143.198.213.176/api/user/partner/you");
        $uBody = $uResponse->getBody()->getContents();
        $uData = json_decode($uBody, true);
        extract($uData);
        if ($uData['partner']['request_status'] == 1) {
            session()->put('partner', $uData['partner']['id']);
            return redirect('dashboard/order');
        }
        return view('mitra.statusmitra', ['title' => 'Informasi Mitra', 'partner' => $uData['partner']]);
    }
    function OperationalStatusUpdate(Request $request)
    {
        // dd($request->operational_status);
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . session('token')
        ]]);

        $validatedData = $request->validate([
            'operational_status' => 'required|in:0,1',
        ]);
        if ($validatedData['operational_status'] == 0) {
            $validatedData['operational_status'] = 1;
        } else {
            $validatedData['operational_status'] = 0;
        }
        // dd($validatedData);

        $aResponse = $client->request('POST', "http://143.198.213.176/api/user/partner/update", [
            'form_params' => $validatedData,
        ]);

        //$sesi = session()->put('role', 1);
        return redirect('/dashboard/profile');
    }
    public function updateMitra(Request $request, $id)
    {
        $client = new Client(['headers' => [
            'Content-Type' => 'multipart/form-data',
            'Authorization' => 'Bearer ' . session('token')
        ]]);

        if ($request->file('avatar')) {
            $aResponse = $client->request('POST', "http://143.198.213.176/api/user/partner/update", ['multipart' => [
                [
                    'name' => 'partner_name',
                    'contents' => $request->partner_name
                ],
                [
                    'name' => 'phone_number',
                    'contents' => $request->phone_number
                ],
                [
                    'name' => 'avatar',
                    'contents' => fopen($request->file('avatar'), 'r'),
                    'filename' => $request->file('avatar')->getClientOriginalName(),
                    'Mime-Type' => $request->file('avatar')->getmimeType()
                ]
            ]]);
        } else {
            $aResponse = $client->request('POST', "http://143.198.213.176/api/user/partner/update", ['multipart' => [
                [
                    'name' => 'partner_name',
                    'contents' => $request->partner_name
                ],
                [
                    'name' => 'phone_number',
                    'contents' => $request->phone_number
                ],
                [
                    'name' => 'village_id',
                    'contents' => is_numeric($request->village) ? $request->village : null,
                ],
                [
                    'name' => 'address',
                    'contents' => $request->address
                ],
                [
                    'name' => 'link_google_map',
                    'contents' => $request->link_google_map
                ],
                [
                    'name' => 'description',
                    'contents' => $request->description
                ],
            ]]);
        }


        $aBody = $aResponse->getBody()->getContents();
        $aData = json_decode($aBody, true);
        return redirect('/dashboard/profile');
    }
}
