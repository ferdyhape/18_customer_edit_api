<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('token')) {
            try {
                $client = new Client(['headers' => [
                    'Authorization' => 'Bearer ' . session('token')
                ]]);
                $pResponse = $client->request('GET', "http://143.198.213.176/api/user/me");
                $pBody = $pResponse->getBody()->getContents();
                $pData = json_decode($pBody, true);
                extract($pData);

                // Set the default variable here
                $userData = $pData['user'];

                // Pass the default variable to all views
                view()->share('userData', $userData);

                return $next($request);
            } catch (Exception $e) {
                session()->forget('token');
                return redirect('/login');
            }
        }
        return redirect('/login');
    }
}
