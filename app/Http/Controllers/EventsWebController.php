<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class EventsWebController extends Controller
{
        
    // public function index(){
        
    //     $client = new Client();

    //     $res = $client->get('localhost:8000/api/events',
    //         [
    //             'header' => [
    //                 'Accept' => 'Application/json'
    //             ]
    //         ]
    //     );

    //     $data = json_decode($res->getBody(), true);

    //     dd($data->location);

    //     return view('index', compact('data'));
    // }
}
