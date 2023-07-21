<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileStorageController extends Controller
{
    public function index(Request $request)
    {
        // $contents = Storage::get('public/images/1.jpg');
        dd(Storage::path('public/images/1.jpg'));
        // return Storage::download('public/images/1.jpg');

        if ($request->method() === "POST") {
        }
        return view('file-storage');
    }
}
