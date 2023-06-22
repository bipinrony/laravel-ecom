<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Exception\ConnectionException;
use Illuminate\Http\Client\ConnectionException as ClientConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HttpClientController extends Controller
{
    public function index()
    {
        // return Http::dd()->get('https://dummyjson.com/products');

        // $response = Http::get('https://dummyjson.com/products/search', [
        //     'q' => 'Laptop',
        // ]);
        // dd($response->json());


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
        // $response = Http::get($url);
        // dd($response->successful());
        // if ($response->status() === 200) {
        //     // dump($response->body());
        //     dump($res = $response->json());
        //     // dump($response->object());
        //     // $res = $response->collect();
        //     // dump($res->last());
        //     // dump(collect($res['products'])->avg('price'));
        //     $data = [];
        //     // $res = $response->object();
        //     // $data['products'] = $res->products;
        //     $data['products'] = $res['products'];
        //     return view('frontend.http', $data);
        // } else if ($response->status() === 404) {
        //     dd('requested resource not found');
        // } else {
        //     dd('someting error on server side');
        // }

        try {
            $response = Http::post($url . '/add', [
                'title' => 'Steve',
                'description' => 'Network Administrator',
            ]);
            $result = $response->json();
            dd($result);
            $response = Http::get($url . '/' . $result['id']);
            dd($response->json());
        } catch (ClientConnectionException $e) {
            dd($e->getMessage());
        }

        // class StringAllowedException extends Exception {

//   public function errorMessage() {
//     $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
//     .': <b>'.$this->getMessage().'</b> is not a valid string';
//     return $errorMsg;
//   }

// }

// try {
//   $name = 'test';
//   if (is_string($name)) {
//     echo strtolower($name);
//   } else {
//    throw new StringAllowedException($name);
//   }

// } catch(StringAllowedException $e) {
//   echo $e->errorMessage();
// }

// try {
//     $result = 1 / 0;
// } catch ( DivisionByZeroError $e) {
//     echo "Error: ", $e -> getMessage(), "\n";
// } finally {
//     echo "Executing finally block";
// }

// try {
//     echo strlen('ahmed', 4);
// } catch (ArgumentCountError $e) {
//     echo $e->getMessage();
// }

// try {
//     print_r(explode('Test string'));
// } catch (ArgumentCountError $e) {
//     echo $e->getMessage();
// }
    }
}
