<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $vlplaces = DB::table('VLPlace')->take(4)->get();
        return view('home.home', [
            'vlplaces' => $vlplaces,
        ]);
    }
}