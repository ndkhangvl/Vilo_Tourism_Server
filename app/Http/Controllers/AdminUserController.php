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

    public function getVLUser($id)
    {
        $vluser = DB::select('select * from users where id=?', [$id]);
        return response()->json([
            'success' => true,
            'vluser' => $vluser,
        ]);
    }

    public function delete($id)
    {
        $results = DB::statement('EXEC DeleteVLUserById ?', [$id]);

        return response()->json([
            'success' => true,
            'data' => $results,
        ]);
    }
}