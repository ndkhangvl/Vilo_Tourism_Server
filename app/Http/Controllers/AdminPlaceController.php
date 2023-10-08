<?php

namespace App\Http\Controllers;

use App\Models\VLPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;

class AdminPlaceController extends Controller
{
    public function index()
    {
        $vlplaces = DB::select('select * from VLPlace');
        $vlinfo = DB::select('select * from VLService');
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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();

            // Tải hình lên Firebase
            $factory = (new Factory)->withServiceAccount('../vilo-tourism-firebase-adminsdk-jgppv-ee7114cf39.json');
            $storage = $factory->createStorage();
            $bucket = $storage->getBucket();
            $bucket->upload(file_get_contents($image->getPathname()), [
                'name' => $fileName
            ]);

            // Lấy đường dẫn tới hình từ Firebase
            $imageUrl = $bucket->object($fileName)->signedUrl(new \DateTime('2500-01-01T00:00:00Z'));

            // Lưu đường dẫn hình vào SQL Server
            //$vlplace->image_url = $imageUrl;
        }

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
        $vlplace->image_url = $imageUrl;

        $vlplace->save();

        return response()->json([
            'success' => true,
            'input' => $request->all()
        ]);
    }

    public function delete($id)
    {
        $results = DB::statement('EXEC DeleteVLPlaceById ?;', [$id]);
        // return response()->json([
        //     'success' => true,
        //     'data' => 'Thành công xóa',
        // ]);
        return redirect('admin');
    }
}