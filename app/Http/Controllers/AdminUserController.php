<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;

class AdminUserController extends Controller
{
    public function index()
    {
        $vlusers = DB::select('select * from Users');
        return view('admin.users', [
            'vlusers' => $vlusers,
        ]);
    }
}