<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $vlplaces = DB::table('VLPlace')->take(5)->get();
        $vlnews = DB::table('VLNews')->take(5)->get();
        // $vlplacecoordinate = DB::select('Select * from VLPlaceCoordinate');
        // $vlplacecoordinatejson = json_encode($vlplacecoordinate);
        // dd(json_encode($vlplacecoordinate));
        $vlplacecoordinate = DB::select('SELECT VLPlace.name_place, VLPlaceCoordinate.latitude, VLPlaceCoordinate.longitude
            FROM VLPlace
            JOIN VLPlaceCoordinate ON VLPlace.id_place = VLPlaceCoordinate.id_place');

        $customJson = [];

        foreach ($vlplacecoordinate as $item) {
            $coordinates = [
                (float) $item->latitude,
                (float) $item->longitude
            ];

            $customItem = [
                'coordinates' => $coordinates,
                'name' => $item->name_place,
            ];

            $customJson[] = $customItem;
        }

        $vlplacecoordinatejson = json_encode($customJson, JSON_UNESCAPED_UNICODE);

        // dd($vlplacecoordinatejson);
        //dd($vlplaces);
        return view('home.home', [
            'vlplaces' => $vlplaces,
            'vlnews' => $vlnews,
            'vlplacecoordinate' => $vlplacecoordinatejson,
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
        DB::table('VLPlace')->where('id_place', $id)->increment('view_place');
        // dd($detail_place);
        //dd($detail_place);
        return view('home.detail_place', [
            'detail_place' => $detail_place,
        ]);
    }
}