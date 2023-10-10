<?php

namespace App\Http\Controllers;

use App\Models\VLPlace;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $vlplaces = DB::select('select * from VLPlace');
        $vlinfo = DB::select('select * from VLService');
        return view('admin.index', [
            'vlplaces' => $vlplaces,
        ]);
    }
}