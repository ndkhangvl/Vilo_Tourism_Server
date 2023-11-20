<?php

namespace App\Http\Controllers;

use App\Models\VLRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $vlplaces = DB::table('vlplace')
            ->select('vlplace.*', 'vlr.rating')
            ->join(DB::raw('(SELECT id_place, AVG(place_ratings) AS rating FROM vlrating GROUP BY id_place) as vlr'), 'vlplace.id_place', '=', 'vlr.id_place')
            ->orderByRaw('id_place')
            ->take(5)
            ->get();
        $vlnews = DB::table('VLNews')->orderByDesc('date_post_news')->take(5)->get();
        // $vlplacecoordinate = DB::select('Select * from VLPlaceCoordinate');
        // $vlplacecoordinatejson = json_encode($vlplacecoordinate);
        // dd(json_encode($vlplacecoordinate));
        $vlplacecoordinate = DB::select('select name_place, latitude, longitude from VLPlace order by name_place asc;');


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
        // dd($customJson);

        // dd($vlplacecoordinatejson);
        //dd($vlplaces);
        return view('home.home', [
            'vlplaces' => $vlplaces,
            'vlnews' => $vlnews,
            'vlplacecoordinate' => $vlplacecoordinatejson,
            'vlplacelist' => $customJson,
        ]);
    }

    public function getPlaceAPI()
    {
        $vlplace = DB::select('select * from VLPlace');
        return response()->json($vlplace);
    }

    public function listPlace()
    {
        $vlplace = DB::table('vlplace')
            ->select('vlplace.*', 'vlr.rating')
            ->join(DB::raw('(SELECT id_place, AVG(place_ratings) AS rating FROM vlrating GROUP BY id_place) as vlr'), 'vlplace.id_place', '=', 'vlr.id_place')
            ->orderByRaw('id_place')
            ->get();
        // dd($vlplace);
        return view('home.list_place', [
            'vlplace' => $vlplace,
        ]);
    }

    public function detailPlace($id)
    {
        // $detail_place = DB::select(
        //     "select * from VLPlace where id_place=:id;",
        //     [
        //         'id' => $id,
        //     ]
        // );
        $fixedLocation = DB::select('select latitude,longitude from VLPlace where id_place=?', [$id]);
        $location = DB::select('EXEC GetAllLocation;');
        if (Auth::check()) {
            $userReview = DB::select('SELECT * FROM VLRating WHERE id_user = ? AND id_place = ?', [Auth::user()->id, $id]);
        } else {
            $userReview = [];
        }
        // dd($userReview);
        if (count($userReview) > 0) {
            $userHasReview = true;
        } else {
            $userHasReview = false;
        }
        // dd($userHasReview);
        $ratingValue = DB::select('select avg(place_ratings) as rating from VLRating where id_place=?', [$id]);
        $detailRatingValue = DB::select('SELECT place_ratings, COUNT(*) as count FROM VLRating WHERE id_place = ? GROUP BY place_ratings', [$id]);
        $listRating = DB::table('VLRating')
            ->join('users', 'VLRating.id_user', '=', 'users.id')
            ->select('users.id', 'users.name', 'VLRating.place_ratings')
            ->where('id_place', $id)
            ->paginate(10);
        // dd($ratingValue);
        // dd($detailRatingValue);
        // dd($listRating);
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
            'ratingValue' => $ratingValue,
            'detailRatingValue' => $detailRatingValue,
            'listRating' => $listRating,
            'userHasReview' => $userHasReview,
        ]);
    }

    //For News
    public function fullListNews()
    {
        $vlnews = DB::table('VLNews')->where('id_type_news', 1)->take(3)->get();
        // dd($vlnews);
        $vlnews_event = DB::table('VLNews')->where('id_type_news', 0)->take(3)->get();
        // dd($vlnews_event);
        $most_view_news = DB::table('VLNews')->orderByDesc('view_news')->take(6)->get();
        return view('home.full_list_news', [
            'vlnews' => $vlnews,
            'most_view_news' => $most_view_news,
            'vlnews_event' => $vlnews_event,
        ]);
    }

    public function listNews()
    {
        $vlnews = DB::table('VLNews')->where('id_type_news', 1)->orderByDesc('date_post_news')->get();
        $news_new = DB::select('SELECT * FROM VLNews ORDER BY date_post_news DESC');
        return view('home.list_news', [
            'vlnews' => $vlnews,
            'news_new' => $news_new,
        ]);
    }

    public function listEvent()
    {
        $vlnews_event = DB::table('VLNews')->where('id_type_news', 0)->get();
        $news_new = DB::select('SELECT * FROM VLNews ORDER BY date_post_news DESC');
        return view('home.list_event', [
            'vlnews_event' => $vlnews_event,
            'news_new' => $news_new,
        ]);
    }

    public function detailNews($id)
    {
        $detail_news = DB::select('select * from VLNews WHERE id_news=?;', [$id]);
        $news_new = DB::select('SELECT * FROM VLNews ORDER BY date_post_news DESC');
        DB::table('VLNews')->where('id_news', $id)->increment('view_news');
        return view('home.detail_news', [
            'detail_news' => $detail_news,
            'news_new' => $news_new,
        ]);
    }

    public function recommendPlace(Request $request)
    {
        $apiUrl = 'http://127.0.0.1:5000/recommend_tourism';

        if (Auth::check()) {
            $postData = [
                'id_user' => Auth::user()->id,
            ];

            try {
                $response = Http::post($apiUrl, $postData);

                // Lấy phản hồi từ API Flask dưới dạng JSON
                $responseData = $response->json();

                // Xử lý phản hồi JSON ở đây

                return view('home.recommend_place', [
                    'responseData' => $responseData,
                ]);
            } catch (\Exception $e) {
                // Xử lý lỗi (nếu có)
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            return view('auth.login');
        }
    }

    public function recommendContent(Request $request)
    {
        // dd($request->all());
        // Lấy các giá trị từ request
        $token = $request->input('_token');
        $history = $request->input('history');
        $landscape = $request->input('landscape');
        $view = $request->input('view');
        $chua = $request->input('chua');
        $tuongdai = $request->input('tuongdai');
        $khust = $request->input('khust');
        // dd($request->all());

        // Tạo mảng hashtags từ các giá trị cần chuyển đổi
        $hashtags = [$history, $landscape, $view, $chua, $tuongdai, $khust];

        // Loại bỏ các giá trị null hoặc trống từ mảng hashtags
        $hashtags = array_filter($hashtags, function ($value) {
            return !is_null($value) && $value !== '';
        });

        $newData = ['hashtags' => array_values($hashtags)];
        $jdonDecode = json_encode($hashtags);
        $apiUrl = 'http://127.0.0.1:5000/recommend';
        try {
            $response = Http::post($apiUrl, $newData);

            // Lấy phản hồi từ API Flask dưới dạng JSON
            $responseData2 = $response->json();
            // dd($responseData);
            // Xử lý phản hồi JSON ở đây

            return response()->json(['responseData2' => $responseData2]);
        } catch (\Exception $e) {
            // Xử lý lỗi (nếu có)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function ratingPlace(Request $request)
    {
        // dd($request->all());
        $vlrating = new VLRating();
        $vlrating->id_user = $request->id_user;
        $vlrating->id_place = $request->id_place;
        $vlrating->place_ratings = $request->place_rating;
        $vlrating->date_post_rating = Carbon::now();
        $vlrating->save();

        return response()->json([
            'success' => true,
            'input' => $request->all()
        ]);
    }

    public function accountProfile()
    {
        if (Auth::check()) {
            return view('home.information_user');
        } else {
            return view('/');
        }
    }
}