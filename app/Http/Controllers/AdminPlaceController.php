<?php

namespace App\Http\Controllers;

use App\Models\VLPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;
use Illuminate\Support\Str;

class AdminPlaceController extends Controller
{
    public function index()
    {
        $vlplaces = DB::select('select * from VLPlace');
        $vlinfo = DB::select('select * from VLService');
        return view('admin.place', [
            'vlplaces' => $vlplaces,
        ]);
    }

    public function getVLPlace($id)
    {
        $vlplace = DB::select('select * from VLPlace where id_place=?', [$id]);
        return response()->json([
            'success' => true,
            'vlplace' => $vlplace,
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $nonAccentText = Str::slug($request->name_edit_place, '');
            $fileName = $nonAccentText . '.' . $image->getClientOriginalExtension();

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
            $vlplace->image_url = $imageUrl;
        }
        // $vlplace->image_url = $imageUrl;

        $vlplace->save();

        return response()->json([
            'success' => true,
            'input' => $request->all()
        ]);
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name_place' => 'required',
        // ], [
        //     'name_place.required' => 'Trường tên địa điểm là bắt buộc.',
        // ]);
        // dd($request->all());
        $vlplace = VLPlace::findOrFail($id);
        $vlplace->id_area = $request->id_edit_area;
        $vlplace->id_service = $request->id_service;
        $vlplace->id_price = $request->id_edit_price;
        $vlplace->id_type = $request->id_edit_type;
        $vlplace->name_place = $request->name_edit_place;
        $vlplace->address_place = $request->address_edit_place;
        $vlplace->start_time = $request->start_edit_time;
        $vlplace->end_time = $request->end_edit_time;
        $vlplace->phone_place = $request->phone_edit_place;
        $vlplace->email_contact_place = $request->email_edit_contact_place;
        $vlplace->describe_place = $request->describe_edit_place;
        if ($vlplace->image_url == null) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $nonAccentText = Str::slug($request->name_edit_place, '');
                $fileName = $nonAccentText . '.' . $image->getClientOriginalExtension();
                // $cleanedText = preg_replace('/\s+/', '', $nonAccentText);

                $factory = (new Factory)->withServiceAccount('../vilo-tourism-firebase-adminsdk-jgppv-ee7114cf39.json');
                $storage = $factory->createStorage();
                $bucket = $storage->getBucket();
                $bucket->upload(file_get_contents($image->getPathname()), [
                    'name' => $fileName
                ]);

                $imageUrl = $bucket->object($fileName)->signedUrl(new \DateTime('2500-01-01T00:00:00Z'));

                $vlplace->image_url = $imageUrl;
            }
        } else {
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $nonAccentText = Str::slug($request->name_edit_place, '');
                $fileName = $nonAccentText . '.' . $image->getClientOriginalExtension();

                // dd($vlplace->image_url);
                $parts = parse_url($vlplace->image_url);
                $path = ltrim($parts['path'], '/');
                $imgNamePicture = basename($path);
                // dd($imgNamePicture);

                $storage = (new Factory)->withServiceAccount('../vilo-tourism-firebase-adminsdk-jgppv-ee7114cf39.json')->createStorage();
                $bucket = $storage->getBucket();
                $bucket->object($imgNamePicture)->delete();

                $bucket->upload(file_get_contents($image->getPathname()), [
                    'name' => $fileName
                ]);

                $imageUrl = $bucket->object($fileName)->signedUrl(new \DateTime('2500-01-01T00:00:00Z'));

                $vlplace->image_url = $imageUrl;
            }
        }

        $vlplace->save();

        return response()->json([
            'success' => true,
            'input' => $request->all()
        ]);
    }

    public function delete($id)
    {
        $vlplace = VLPlace::findOrFail($id);

        if ($vlplace->image_url != null) {
            $parts = parse_url($vlplace->image_url);
            $path = ltrim($parts['path'], '/');
            $imgDelete = basename($path);

            $storage = (new Factory)->withServiceAccount('../vilo-tourism-firebase-adminsdk-jgppv-ee7114cf39.json')->createStorage();
            $bucket = $storage->getBucket();
            $bucket->object($imgDelete)->delete();
            $results = DB::statement('EXEC DeleteVLPlaceById ?;', [$id]);
        } else {
            $results = DB::statement('EXEC DeleteVLPlaceById ?;', [$id]);
        }
        // return response()->json([
        //     'success' => true,
        //     'data' => 'Thành công xóa',
        // ]);
        return response()->json([
            'success' => true,
            'data' => $results,
        ]);
    }
}