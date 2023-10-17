<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Kiểm tra xem token đã lưu trong session hay không
        // if (Session::has('authorization')) {
        //     $token = Session::get('authorization');

        //     // Thêm tiêu đề "Authorization" vào yêu cầu
        //     $request->headers->set('Authorization', $token);
        // }
        {
            $storedToken = Session::get('authorization');
            // $storedToken = $request->session()->get('authorization');
            dd($storedToken);
            // dd($request->bearerToken());
            if ($storedToken) {
                $request->headers->set('Authorization', 'Bearer ' . $storedToken);
            }
            return $next($request);
        }
    }
}