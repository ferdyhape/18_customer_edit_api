<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . session('token')
        ]]);
        $uResponse = $client->request('GET', "http://143.198.213.176/api/user/partner/active");
        $uBody = $uResponse->getBody()->getContents();
        $uData = json_decode($uBody, true);
        extract($uData);
        return view(
            "mitra.dashboard.index",
            [
                'title' => 'Dashboard',
                'partner' => $uData['partner'],
            ]
        );
    }

    public function activation()
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . session('token')
        ]]);
        $uResponse = $client->request('GET', "http://143.198.213.176/api/user/partner/you");
        $uBody = $uResponse->getBody()->getContents();
        $uData = json_decode($uBody, true);
        extract($uData);
        return view("mitra.dashboard.activation.index", ['title' => 'Aktivasi Mitra', 'partner' => $uData['partner']]);
    }
    public function profile()
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . session('token')
        ]]);
        $uResponse = $client->request('GET', "http://143.198.213.176/api/user/partner/you");
        $uBody = $uResponse->getBody()->getContents();
        $uData = json_decode($uBody, true);
        extract($uData);
        $cResponse = $client->request('GET', "http://143.198.213.176/api/user/category");
        $cBody = $cResponse->getBody()->getContents();
        $cData = json_decode($cBody, true);
        extract($cData);
        return view(
            "mitra.dashboard.profile.index",
            [
                'title' => 'Profile',
                'partner' => $uData['partner'],
                'categories' => $cData['category']
            ]
        );
    }
    public function table()
    {
        return view('mitra.dashboard.tables', [
            "title" => "Tables"
        ]);
    }
    public function utilities_color()
    {
        return view('mitra.dashboard.utilities-color', [
            "title" => "Color"
        ]);
    }
    public function utilities_border()
    {
        return view('mitra.dashboard.utilities-border', [
            "title" => "Border"
        ]);
    }
    public function utilities_animation()
    {
        return view('mitra.dashboard.utilities-animation', [
            "title" => "Animation"
        ]);
    }
    public function utilities_other()
    {
        return view('mitra.dashboard.utilities-other', [
            "title" => "Other"
        ]);
    }
    public function buttons()
    {
        return view('mitra.dashboard.buttons', [
            "title" => "Buttons"
        ]);
    }
    public function cards()
    {
        return view('mitra.dashboard.cards', [
            "title" => "Cards"
        ]);
    }
    public function charts()
    {
        return view('mitra.dashboard.charts', [
            "title" => "Charts"
        ]);
    }
    public function error_404()
    {
        return view('mitra.dashboard.404', [
            "title" => "404"
        ]);
    }
    public function blank()
    {
        return view('mitra.dashboard.blank', [
            "title" => "Blank"
        ]);
    }
    public function login()
    {
        return view('mitra.dashboard.login', [
            "title" => "Login"
        ]);
    }
    public function register()
    {
        return view('mitra.dashboard.register', [
            "title" => "Register"
        ]);
    }
    public function forgot_password()
    {
        return view('mitra.dashboard.forgot-password', [
            "title" => "Forgot Password"
        ]);
    }

    public function orderList(Request $request)
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . session('token')
        ]]);
        $uResponse = $client->request('GET', "http://143.198.213.176/api/user/call/partner/" . session('partner'));
        $uBody = $uResponse->getBody()->getContents();
        $uData = json_decode($uBody, true);
        extract($uData);
        $pResponse = $client->request('GET', "http://143.198.213.176/api/user/progres");
        $pBody = $pResponse->getBody()->getContents();
        $pData = json_decode($pBody, true);
        extract($pData);

        // return response()->json($uData);
        return view('mitra.dashboard.order.index', ['title' => 'Order List', 'orders' => $uData['call'], 'progress' => $pData['progres']]);
    }
}
