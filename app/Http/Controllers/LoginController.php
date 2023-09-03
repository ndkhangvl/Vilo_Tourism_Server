<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;


class LoginController extends Controller
{
    public function index()
    {
        // Xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // Người dùng đã đăng nhập
            return redirect('/home');
        } else {
            // Người dùng chưa đăng nhập
            return view('login');
        }
    }

    public function login(Request $request)
    {
        // Lấy email và mật khẩu từ form đăng nhập
        $email = $request->get('email');
        $password = $request->get('password');

        // Đăng nhập người dùng với Firebase
        $firebase = (new Factory())
            ->withServiceAccount('../vilo-tourism-firebase-adminsdk-jgppv-ee7114cf39.json');

        $auth = $firebase->createAuth();

        $signInResult = $auth->signInWithEmailAndPassword($email, $password);

        //dd($signInResult);
        // Kiểm tra xem người dùng đã tồn tại trong Laravel
        //$laravelUser = User::where('email', $firebaseUser->email)->first();


        // Nếu đăng nhập thành công
        if ($signInResult) {
            // Lưu thông tin người dùng vào phiên
            Auth::login($signInResult);

            // Chuyển hướng người dùng đến trang chủ
            return redirect('/home');
        } else {
            // Đăng nhập thất bại
            return redirect()->back()->with('error', 'Đăng nhập thất bại');
        }
    }
}