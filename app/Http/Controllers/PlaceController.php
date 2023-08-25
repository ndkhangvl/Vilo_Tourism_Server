<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    public function index()
    {
        $vlplace = DB::select('select * from VLPlace');
        return response()->json($vlplace);
    }
}