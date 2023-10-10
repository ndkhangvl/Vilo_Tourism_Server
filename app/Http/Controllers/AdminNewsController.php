<?php

namespace App\Http\Controllers;

use App\Models\VLNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;

class AdminNewsController extends Controller
{
    public function index()
    {
        $vlnews = DB::select('select * from VLNews');
        return view('admin.news', [
            'vlnews' => $vlnews,
        ]);
    }
}