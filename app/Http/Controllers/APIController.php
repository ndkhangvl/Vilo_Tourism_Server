<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    public function login(Request $reqeust)
    {
        $reqeust->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $reqeust->email)->first();

        if (!$user || !Hash::check($reqeust->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect'],
            ]);
        }

        //then return generated token
        return $user->createToken($reqeust->email)->plainTextToken;
    }

    public function getMapAPI()
    {
        $fixedLocation = DB::select('select latitude,longitude from VLPlace;');
        return response()->json($fixedLocation, 200);
    }
    public function getNewsAPI()
    {
        $vlnews = DB::table('VLNews')->orderByDesc('date_post_news')->get();
        //$news_new = DB::select('SELECT * FROM VLNews ORDER BY date_post_news DESC');
        // return view('home.list_news', [
        //     'vlnews' => $vlnews,
        //     'news_new' => $news_new,
        // ]);
        return response()->json($vlnews, 200);
    }
    public function test($id)
    {
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
    }
    public function getPlaceAPI()
    {
        $vlplace = DB::table('vlplace')
            ->select('vlplace.*', 'vlr.rating')
            ->join(DB::raw('(SELECT id_place, CAST(AVG(CAST(place_ratings AS FLOAT)) AS DECIMAL(3, 1)) AS rating FROM vlrating GROUP BY id_place) as vlr'), 'vlplace.id_place', '=', 'vlr.id_place')
            ->orderByRaw('id_place')
            ->get();
        return response()->json($vlplace);
    }
    public function getRecommendPlace()
    {
        $vlplace = DB::table('vlplace')
            ->select('vlplace.*', 'vlr.rating')
            ->join(DB::raw('(SELECT id_place, CAST(AVG(CAST(place_ratings AS FLOAT)) AS DECIMAL(3, 1)) AS rating FROM vlrating GROUP BY id_place) as vlr'), 'vlplace.id_place', '=', 'vlr.id_place')
            ->orderByRaw('id_place')
            ->get();
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
            'id_user' => 1,

        ];

        // dd(Http::get('https://jsonplaceholder.typicode.com/posts')->json());

        try {
            $response = Http::post($apiUrl, $postData);
            // dd($response->json());
            // Lấy phản hồi từ API Flask dưới dạng JSON
            $responseData = $response->json();
            // dd($responseData);
            // Xử lý phản hồi JSON ở đây

            return response()->json($responseData);
            // return view('home.recommend_place', [
            //     'responseData' => $responseData,
            // ]);
        } catch (\Exception $e) {
            // Xử lý lỗi (nếu có)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
