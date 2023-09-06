<?php

namespace App\Http\Controllers;

use App\Models\VLPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPlaceController extends Controller
{
    public function index()
    {
        $vlplaces = DB::select('select * from VLPlace');
        return view('admin.admin_place', [
            'vlplaces' => $vlplaces,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_place' => 'required',
        ], [
            'name_place.required' => 'Trường tên địa điểm là bắt buộc.',
        ]);

        $vlplace = new VLPlace;
        $vlplace->id_area = $request->id_area;
        $vlplace->id_service = $request->id_service;
        $vlplace->id_price = $request->id_price;
        $vlplace->id_type = $request->id_type;
        $vlplace->name_place = $request->name_place;
        $vlplace->address_place = $request->address_place;
        $vlplace->start_time = $request->start_time;
        $vlplace->end_time = $request->end_time;
        $vlplace->phone_place = $request->phone_place;
        $vlplace->email_contact_place = $request->email_contact_place;
        $vlplace->describe_place = $request->describe_place;
        $vlplace->save();

        return response()->json([
            'success' => true,
            'input' => $request->all()
        ]);
    }
}