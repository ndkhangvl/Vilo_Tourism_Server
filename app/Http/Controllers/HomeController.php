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
        $fixedLocation = DB::select('select * from VLPlaceCoordinate where id_place=?', [$id]);
        $location = DB::select('select VLPC.*,VLP.name_place,VLP.image_url  from VLPlaceCoordinate as VLPC
                                 join VLPlace as VLP on VLPC.id_place=VLP.id_place;');
        $R = 6371.0;
        $distances = [];

        foreach ($location as $item) {
            $lat1 = deg2rad($fixedLocation[0]->latitude);
            $lon1 = deg2rad($fixedLocation[0]->longitude);
            $lat2 = deg2rad($item->latitude);
            $lon2 = deg2rad($item->longitude);

            $dlon = $lon2 - $lon1;
            $dlat = $lat2 - $lat1;
            $a = sin($dlat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($dlon / 2) ** 2;
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $distance = $R * $c;

            if ($distance <= 10) {
                $distance = round($distance, 2);
                $distances[] = [
                    'id' => $item->id_place,
                    'name_place' => $item->name_place,
                    'image_url' => $item->image_url,
                    'distance' => $distance
                ];
            }
        }

        $sortDistance = collect($distances)->sortBy('distance')->toArray();
        $limitedDistances = collect($sortDistance)->slice(1, 5)->toArray();

        // dd($limitedDistances);
        $detail_place = DB::select('EXEC GetVLPlaceID ?;', [$id]);
        DB::table('VLPlace')->where('id_place', $id)->increment('view_place');
        return view('home.detail_place', [
            'detail_place' => $detail_place,
            'distances' => $limitedDistances,
        ]);
    }
}