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

    public function detail_place($id)
    {
        $detail_place = DB::select(
            "select * from VLPlace where id_place=:id;",
            [
                'id' => $id,
            ]
        );
        //dd($detail_place);
        return view('home.detail_place', [
            'detail_place' => $detail_place,
        ]);
    }
}