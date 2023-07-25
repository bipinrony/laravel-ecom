<?php

namespace App\Http\Controllers;

use Illuminate\Cache\Repository as Cache;
use Illuminate\Contracts\Auth\Guard as Auth;
use Illuminate\Contracts\Session\Session as Session;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Cache;

class ContractController extends Controller
{
    public $cache;
    public $auth;
    public $session;
    public function __construct(Cache $cache, Auth $auth,  Session $session)
    {
        $this->cache = $cache;
        $this->auth = $auth;
        $this->session = $session;
    }

    public function index(Request $request)
    {
        // put
        // facade
        // Cache::put('key', 'value');
        // dd(Cache::get('key'));
        // dd(Auth::check());

        // contract
        // $this->cache->put('key', 'test');
        // dd($this->cache->get('key'));
        // dd($this->auth->check());
        $this->session->put('test', 'value');
        dd($this->session->get('test'));
    }
}
