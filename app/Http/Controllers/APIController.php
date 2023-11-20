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

    public function getPlaceAPI()
    {
        $vlplace = DB::select('select * from VLPlace');
        return response()->json($vlplace);
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
