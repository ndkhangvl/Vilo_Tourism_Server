<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function updateLocale(Request $request)
    {
        $locale = $request->input('culture');
        if (in_array($locale, ['en', 'vi'])) {
            Session::put('locale', $locale); // Store the locale in the session
            return response()->json(['success' => true, 'test' => $locale]);
        }
        // // return response()->json(['success' => false]);
        // app()->setLocale($locale);
        // app::setlocale($locale);
        return response()->json(['success' => true, 'test' => $locale]);
    }
}
