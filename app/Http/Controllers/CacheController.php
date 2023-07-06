<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheController extends Controller
{
    public function index()
    {
        // put
        // Cache::put('key', 'value');
        // put with time in second
        // Cache::put('key', 'value', $seconds = 10);
        // dd(Cache::get('key'));

        //get
        // $value = Cache::get('users', function () {
        //     return DB::table('users')->get();
        // });

        // remember
        // $value = Cache::remember('users', '600', function () {
        //     return DB::table('users')->get();
        // });
        // dd($value);

        // rememberForever (second not required)
        // $value = Cache::rememberForever('users', function () {
        //     return DB::table('users')->get();
        // });
        // dd(Cache::get('users'));


        dd(Cache::get('key'));
    }
}
