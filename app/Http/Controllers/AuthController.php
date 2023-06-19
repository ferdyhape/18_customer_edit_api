<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $client = new Client();
        $cResponse = $client->request('POST', "http://localhost:5000/api/user/register", [ 'json'=> [
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'no_phone' => $request->no_phone
        ]]);
        $cBody = $cResponse->getBody()->getContents();
        $data = json_decode($cBody, true);
        extract($data);
        if($data['status']){
            // $message = 'Berhasil membuat akun';
            // Session::flash('message', $message);
            return redirect("/login")->with('success', 'Akun Berhasil dibuat');
        }

        $data['title'] = 'Register';
        
        // return response()->json($data);
        return view("auth.register", $data);
    }

    public function login(Request $request)
    {
        $client = new Client();
        $cResponse = $client->request('POST', "http://localhost:5000/api/user/login", [ 'json'=> [
            'email' => $request->email,
            'password' => $request->password
        ]]);
        $cBody = $cResponse->getBody()->getContents();
        $data = json_decode($cBody, true);
        extract($data);
        if($data['status']){
            $sesi = session()->put('token', $data['token']);
            $sesi = session()->put('user', $data['user']['id']);
            //$hasilsesi = session('token');
            return redirect("/");

            //return response()->json();
        }
        $data['title'] = 'Login';
        return view("auth.login", $data);
    }

    public function logout(Request $request)
    {   
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer '.session('token')
        ]]);
        $aResponse = $client->request('POST', "http://localhost:5000/api/user/logout");
        $aBody = $aResponse->getBody()->getContents();
        $aData = json_decode($aBody, true);
        extract($aData);
        if($aData['status']){
            

            return redirect("/login");

            //return response()->json();
        }
        return redirect("/home");
    }

    public function editProfile(Request $request)
    {
        $client = new Client(['headers' => [
            'Content-Type' => 'multipart/form-data',
            'Authorization' => 'Bearer '.session('token')
        ]]);

        if($request->file('avatar')){
            $aResponse = $client->request('POST', "http://localhost:5000/api/user/update", ['multipart' => [
                [
                    'name' => 'username',
                    'contents' => $request->username
                ],
                [
                    'name' => 'no_phone',
                    'contents' => $request->no_phone
                ],
                [
                    'name' => 'avatar',
                    'contents' => fopen( $request->file('avatar'), 'r' ),
                    'filename' => $request->file('avatar')->getClientOriginalName(),
                    'Mime-Type' => $request->file('avatar')->getmimeType()
                ]
            ]]);
        } else {
            $aResponse = $client->request('POST', "http://localhost:5000/api/user/update", ['multipart' => [
                [
                    'name' => 'username',
                    'contents' => $request->username
                ],
                [
                    'name' => 'no_phone',
                    'contents' => $request->no_phone
                ],
            ]]);
        }
        
        
        $aBody = $aResponse->getBody()->getContents();
        $aData = json_decode($aBody, true);
        return redirect('/editProfile');
    }

    public function getAvatar(){
        $client = new Client(['headers' => [
            'Content-Type' => 'multipart/form-data',
            'Authorization' => 'Bearer '.session('token')
        ]]);
        $aResponse = $client->request('GET', "http://localhost:5000/api/user/avatar");
        $aBody = $aResponse->getBody()->getContents();
        $aData = json_decode($aBody, true);
        //return response()->file(Storage::disk('local')->path($aBody));
    }

    public function updatePassword(Request $request){
        $validated = $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $client = new Client(['headers' => [
            'Content-Type' => 'multipart/form-data',
            'Authorization' => 'Bearer '.session('token')
        ]]);
        $aResponse = $client->request('POST', "http://localhost:5000/api/user/update", ['multipart' => [
            [
                'name' => 'password',
                'contents' => $request->password
            ],
        ]]);
        $aBody = $aResponse->getBody()->getContents();
        $aData = json_decode($aBody, true);
        return redirect('/ubahpassword ');
    }
}
