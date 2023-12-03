<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Kreait\Firebase\Factory;
// use Kreait\Firebase\ServiceAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    public function registerView()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('auth.register');
        }
    }

    public function forgotPassword(Request $request)
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('auth.forgot_passwd');
        }

    }

    public function index()
    {
        // Xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // Người dùng đã đăng nhập
            return redirect('/');
        } else {
            // Người dùng chưa đăng nhập
            return view('auth.login');
        }
    }

    function loginCheck()
    {
        if (Auth::check()) {
            return response()->json(['message' => 'Authenticated.']);
        }

        //dd(session()->all());
        return response()->json(['message' => 'Unauthenticated.']);

    }

    function register(Request $request)
    {
        $request->validate([
            'name_register' => 'required',
            'email_register' => 'required|email|unique:users,email', // Assuming your users table has an 'email' column
            'password_register' => 'required|min:8'
        ], [
            'name_register.required' => 'Please enter your name.',
            'email_register.required' => 'Please enter your email address.',
            'email_register.email' => 'Invalid email format (example@gmail.com).',
            'email_register.unique' => 'This email is already registered in the system.',
            'password_register.required' => 'Please enter your password.',
        ]);
        // dd($request->all());
        try {
            $cred = new User();
            $cred->name = $request->name_register;
            $cred->email = $request->email_register;
            $cred->password = Hash::make($request->password_register);
            $cred->role = 0;
            $cred->save();
            // dd($cred);
            // $response = ['status' => 200, 'message' => 'Register Successfully! Welcome to Our Community'];
            return response()->json([
                'success' => true,
                'input' => $request->all()
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'input' => $request->all()
            ]);
        }
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Invalid email format (example@gmail.com).',
            'password.required' => 'Please enter your password.',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            if (auth()->user()->role == 'admin') {
                // return redirect('/admin');
                return response()->json([
                    'success' => true,
                    'role' => '1',
                    'input' => $request->all()
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'role' => '0',
                    'input' => $request->all()
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'input' => $request->all()
            ]);
        }
    }

    function loginAPI(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user != '[]' && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            Session::put('authorization', 'Bearer ' . $token);
            // $request->session()->put('authorization', 'Bearer ' . $token);
            // dd(Session::get('authorization'));
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } else if ($user == '[]') {
            $response = ['status' => 500, 'message' => 'No account found with this email'];
            return response()->json($response);

        } else {
            $response = ['status' => 500, 'message' => 'Wrong email or password! please try again'];
            return response()->json($response);
        }

    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:8|max:50',
            'new_password' => 'required|min:8|max:50',
            'confirm_password' => 'required|same:new_password'
        ]);

        // dd($request->all());

        $current_user = auth()->user();
        if (Hash::check($request->old_password, $current_user->password)) {
            $current_user->update([
                'password' => bcrypt($request->new_password)
            ]);
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function changeInfo(Request $request)
    {
        $request->validate([
        ]);

        // dd($request->all());

        $current_user = auth()->user();
        if ($request->has('name_change') || $request->has('email_change')) {
            $current_user->update([
                'name' => $request->name_change,
                'email' => $request->email_change
            ]);
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function forgotPass(Request $request)
    {
        $request->validate([
            'forgot_pass' => 'required'

        ], [
            'forgot_pass.required' => 'Please enter email.'
        ]);


        $user = User::where('email', '=', $request->forgot_pass)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
            ]);
        } else {
            $newpass = Str::random(8);
            User::where('email', $request->forgot_pass)
                ->update([
                    'password' => bcrypt($newpass),
                ]);
            $user_after = User::where('email', '=', $request->forgot_pass)->first();
            Mail::to($request->forgot_pass)->send(new ForgotPasswordMail($user_after, $newpass));
            return response()->json([
                'success' => true,
            ]);
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