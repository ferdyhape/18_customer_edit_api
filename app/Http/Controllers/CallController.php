<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CallController extends Controller
{
    public function callNow(Request $request, $id)
    {
        // dd($request);
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . session('token')
        ]]);

        $cResponse = $client->request('POST', "http://143.198.213.176/api/user/call/$id", ['json' => [
            'message' => $request->message,
            'address' => $request->address,
            'link_google_map' => $request->link_google_map,
        ]]);
        $cBody = $cResponse->getBody()->getContents();
        $cData = json_decode($cBody, true);
        extract($cData);
        return redirect('/proses');
    }

    public function show()
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . session('token')
        ]]);
        $cResponse = $client->request('GET', "http://143.198.213.176/api/user/call/partner/session('partner')");
        $cBody = $cResponse->getBody()->getContents();
        $cData = json_decode($cBody, true);
        extract($cData);
        return view('mitra.dashboard.order.index', ['title' => 'Order Page', 'order' => $cData['call']]);
    }
    public function updateProgres(Request $request, $id)
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . session('token')
        ]]);
        $cResponse = $client->request('POST', "http://143.198.213.176/api/user/call/update/$id", ['json' => ['order_status' => $request->progres]]);
        $cBody = $cResponse->getBody()->getContents();
        $cData = json_decode($cBody, true);
        extract($cData);
        return redirect('/dashboard/order');
    }
    public function orderCancel($id)
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . session('token')
        ]]);
        $cResponse = $client->request('POST', "http://143.198.213.176/api/user/call/update/$id", ['json' => ['order_status' => 8]]);
        $cBody = $cResponse->getBody()->getContents();
        $cData = json_decode($cBody, true);
        extract($cData);
        return redirect('/proses');
    }
}
