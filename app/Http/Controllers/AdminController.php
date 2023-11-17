<?php

namespace App\Http\Controllers;

use App\Models\VLPlace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $vltotal = DB::select('EXEC CountDashboard;');
        $places = VLPlace::select('VLPlace.name_place', DB::raw('AVG(VLRating.place_ratings) AS rating'))
            ->join('VLRating', 'VLPlace.id_place', '=', 'VLRating.id_place')
            ->groupBy('VLPlace.id_place', 'VLPlace.name_place')
            ->orderBy('rating', 'DESC')
            ->take(5)
            ->get();
        $dashboardUser = DB::select('EXEC GetAccountCountByMonth2;');
        $accountCounts = collect($dashboardUser)->pluck('account_count')->toArray();
        // dd($accountCounts);
        // dd($test);
        // $vlinfo = DB::select('select * from VLService');
        // dd($vltotal);
        return view('admin.index', [
            'vltotal' => $vltotal,
            'accountcounts' => $accountCounts,
            'places' => $places,
        ]);
    }
}