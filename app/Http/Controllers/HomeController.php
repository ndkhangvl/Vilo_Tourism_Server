<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $vlplaces = DB::table('VLPlace')->take(4)->get();
        // dd(Session::all());
        return view('home.home', [
            'vlplaces' => $vlplaces,
        ]);
    }

    public function getPlaceAPI()
    {
        $vlplace = DB::select('select * from VLPlace');
        return response()->json($vlplace);
    }

    public function listPlace()
    {
        $vlplace = DB::table('VLPlace')->get();
        // dd($vlplace);
        return view('home.list_place', [
            'vlplace' => $vlplace,
        ]);
    }
    public function detail_place($id)
    {
        // $detail_place = DB::select(
        //     "select * from VLPlace where id_place=:id;",
        //     [
        //         'id' => $id,
        //     ]
        // );
        $detail_place = DB::select('EXEC GetVLPlaceID ?;', [$id]);
        // dd($detail_place);
        //dd($detail_place);
        return view('home.detail_place', [
            'detail_place' => $detail_place,
        ]);
    }
}