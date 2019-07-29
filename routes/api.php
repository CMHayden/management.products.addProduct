<?php

use Illuminate\Http\Request;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/products', function(Request $request){

    $guzzleClient = new Client();
    $guzzleResponse = $guzzleClient->post('https://entpebyij95.x.pipedream.net/', ['body' => $request->getContent()]);


    return $guzzleResponse;
});

