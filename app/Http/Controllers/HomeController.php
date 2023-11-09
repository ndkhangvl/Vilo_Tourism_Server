<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $vlplaces = DB::table('VLPlace')->take(5)->get();
        $vlnews = DB::table('VLNews')->take(5)->get();
        // $vlplacecoordinate = DB::select('Select * from VLPlaceCoordinate');
        // $vlplacecoordinatejson = json_encode($vlplacecoordinate);
        // dd(json_encode($vlplacecoordinate));
        $vlplacecoordinate = DB::select('select name_place, latitude, longitude from VLPlace');


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
        $fixedLocation = DB::select('select latitude,longitude from VLPlace where id_place=?', [$id]);
        $location = DB::select('EXEC GetAllLocation;');
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

    //For News
    public function listNews()
    {
        $vlnews = DB::table('VLNews')->get();
        return view('home.list_news', [
            'vlnews' => $vlnews,
        ]);
    }

    public function detail_news($id)
    {
        $detail_news = DB::select('select * from VLNews WHERE id_news=?;', [$id]);
        $news_new = DB::select('SELECT * FROM VLNews ORDER BY date_post_news DESC');
        DB::table('VLNews')->where('id_news', $id)->increment('view_news');
        return view('home.detail_news', [
            'detail_news' => $detail_news,
            'news_new' => $news_new,
        ]);
    }

    public function getRecommendPlace()
    {
        $vlplace = DB::select('select * from VLPlace');
        return response()->json($vlplace);
    }

    public function getRecommendRating()
    {
        $vlrating = DB::select('select * from VLRating');
        return response()->json($vlrating);
    }

    public function getRecommendUser()
    {
        $vluser = DB::select('select * from users');
        return response()->json($vluser);
    }

    public function recommendPlace(Request $request)
    {
        $apiUrl = 'http://127.0.0.1:5000/recommend_tourism';

        $postData = [
            'id_user' => $request->user()->id,

        ];

        // dd(Http::get('https://jsonplaceholder.typicode.com/posts')->json());

        try {
            $response = Http::post($apiUrl, $postData);
            // dd($response->json());
            // Lấy phản hồi từ API Flask dưới dạng JSON
            $responseData = $response->json();
            // $data = json_decode($responseData, true);
            // $json_data = $response->json_data;
            // $jsonString = json_encode($responseData, JSON_UNESCAPED_UNICODE);
            // dd($jsonString);
            // Phân tích chuỗi JSON thành mảng PHP
            // dd($responseData);
            // dd($responseData);
            // Xử lý phản hồi JSON ở đây

            return view('home.recommend_place', [
                'responseData' => $responseData,
            ]);
        } catch (\Exception $e) {
            // Xử lý lỗi (nếu có)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}