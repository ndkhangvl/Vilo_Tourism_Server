<?php

namespace App\Http\Controllers;

use App\Models\VLPlace;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $vltotal = DB::select('EXEC CountDashboard;');
        // $vlinfo = DB::select('select * from VLService');
        // dd($vltotal);
        return view('admin.index', [
            'vltotal' => $vltotal,
        ]);
    }
}