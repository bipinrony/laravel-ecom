<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HttpClientController extends Controller
{
    public function index()
    {
        // return Http::dd()->get('https://dummyjson.com/products');

        $response = Http::get('https://dummyjson.com/products/search', [
            'q' => 'Laptop',
        ]);
        dd($response->json());


        // $res = Http::withUrlParameters([
        //     'endpoint' => 'https://laravel.com',
        //     'page' => 'docs',
        //     'version' => '9.x',
        //     'topic' => 'validation',
        // ])->get('{+endpoint}/{page}/{version}/{topic}');

        // return view('frontend.http', ['laravel' => $res->body()]);


        $url = "https://dummyjson.com/products";
        // curl
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // $result = curl_exec($ch);
        // echo $result;


        // http client
        $response = Http::get($url);
        dd($response->successful());
        if ($response->status() === 200) {
            // dump($response->body());
            dump($res = $response->json());
            // dump($response->object());
            // $res = $response->collect();
            // dump($res->last());
            // dump(collect($res['products'])->avg('price'));
            $data = [];
            // $res = $response->object();
            // $data['products'] = $res->products;
            $data['products'] = $res['products'];
            return view('frontend.http', $data);
        } else if ($response->status() === 404) {
            dd('requested resource not found');
        } else {
            dd('someting error on server side');
        }
    }
}
