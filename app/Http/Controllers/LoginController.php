<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Kreait\Firebase\Factory;
// use Kreait\Firebase\ServiceAccount;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function register_view()
    {
        return view('auth.register');
    }

    public function index()
    {
        // Xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // Người dùng đã đăng nhập
            return redirect('/home');
        } else {
            // Người dùng chưa đăng nhập
            return view('auth.login');
        }
    }

    function register(Request $R)
    {
        try {
            $cred = new User();
            $cred->name = $R->name;
            $cred->email = $R->email;
            $cred->password = Hash::make($R->password);
            $cred->role = 'user';
            $cred->save();
            // $response = ['status' => 200, 'message' => 'Register Successfully! Welcome to Our Community'];
            return redirect('/login');
        } catch (Exception $e) {
            $response = ['status' => 500, 'message' => $e];
        }
    }

    function login(Request $R)
    {
        $user = User::where('email', $R->email)->first();

        if ($user != '[]' && Hash::check($R->password, $user->password)) {
            $token = $user->createToken('Personal Access Token')->plainTextToken;
            $response = ['status' => 200, 'token' => $token, 'user' => $user, 'message' => 'Successfully Login! Welcome Back'];
            return response()->json($response);
        } else if ($user == '[]') {
            $response = ['status' => 500, 'message' => 'No account found with this email'];
            return response()->json($response);

        } else {
            $response = ['status' => 500, 'message' => 'Wrong email or password! please try again'];
            return response()->json($response);
        }

    }
}

// public function login(Request $request)
// {
//     // Lấy email và mật khẩu từ form đăng nhập
//     $email = $request->get('email');
//     $password = $request->get('password');

//     // Đăng nhập người dùng với Firebase
//     $firebase = (new Factory())
//         ->withServiceAccount('../vilo-tourism-firebase-adminsdk-jgppv-ee7114cf39.json');

//     $auth = $firebase->createAuth();

//     $signInResult = $auth->signInWithEmailAndPassword($email, $password);

//     //dd($signInResult);
//     // Kiểm tra xem người dùng đã tồn tại trong Laravel
//     //$laravelUser = User::where('email', $firebaseUser->email)->first();


//     // Nếu đăng nhập thành công
//     if ($signInResult) {
//         // Lưu thông tin người dùng vào phiên
//         Auth::login($signInResult);

//         // Chuyển hướng người dùng đến trang chủ
//         return redirect('/home');
//     } else {
//         // Đăng nhập thất bại
//         return redirect()->back()->with('error', 'Đăng nhập thất bại');
//     }
// }