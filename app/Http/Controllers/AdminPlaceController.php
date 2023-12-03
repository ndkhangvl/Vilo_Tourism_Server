<?php

namespace App\Http\Controllers;

use App\Models\VLPlace;
use App\Models\VLPlaceCoordinate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;
use Illuminate\Support\Str;

class AdminPlaceController extends Controller
{
    public function index()
    {
        $vlplaces = DB::select('select * from VLPlace');
        return view('admin.place', [
            'vlplaces' => $vlplaces,
        ]);
    }

    public function getVLPlace($id)
    {
        $vlplace = DB::select('SELECT * FROM VLPlace WHERE id_place = ?', [$id]);
        // DB::table('VLPlace')->where('id', $id)->increment('view_place');
        return response()->json([
            'success' => true,
            'vlplace' => $vlplace,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_place' => 'required',
            'address_place' => 'required',
            // 'phone_place' => ['required', 'regex:/^(0[1-9][0-9]{8})$/'],
            'phone_place' => 'required',
            'start_time' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/'],
            'end_time' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/'],
            'latitude_place' => 'required',
            'longitude_place' => 'required',
            'email_contact_place' => ['required', 'email'],
            'describe_place' => 'required',
        ], [
            'name_place.required' => 'Trường tên địa điểm là bắt buộc.',
            'address_place.required' => 'Trường địa chỉ là bắt buộc.',
            'phone_place.required' => 'Trường số điện thoại là bắt buộc ( Nếu không có ghi "Không có").',
            // 'phone_place.regex' => 'Định dạng số điện thoại không đúng. Vui lòng nhập theo định dạng 10 chữ số và bắt đầu bằng số 0.',
            'start_time.required' => 'Trường thời gian mở cửa là bắt buộc.',
            'start_time.regex' => 'Định dạng thời gian HH:MM không đúng (ví dụ 20:50)',
            'end_time.required' => 'Trường thời gian đóng cửa là bắt buộc.',
            'end_time.regex' => 'Định dạng thời gian HH:MM không đúng (ví dụ 20:50)',
            'latitude_place' => 'Trường kinh độ là bắt buộc',
            'longitude_place' => 'Trường vĩ độ là bắt buộc',
            'email_contact_place.required' => 'Trường email liên hệ là bắt buộc.',
            'email_contact_place.email' => 'Định dạng email không đúng',
            'describe_place.required' => 'Trường mô tả địa điểm là bắt buộc.',
        ]);
        $convert_name_type_service = implode('|', $request->name_type_service);
        // dd($request->all());]
        // dd($request->name_place);
        // dd($convert_name_type_service);
        $vlplace = new VLPlace;
        $vlplace->id_area = $request->id_area;
        $vlplace->id_price = $request->id_price;
        $vlplace->id_type = $request->id_type;
        $vlplace->name_place = $request->name_place;
        $vlplace->feature_place = $convert_name_type_service;
        $vlplace->address_place = $request->address_place;
        $vlplace->start_time = $request->start_time;
        $vlplace->end_time = $request->end_time;
        $vlplace->latitude = $request->latitude_place;
        $vlplace->longitude = $request->longitude_place;
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
        $request->validate([
            'name_edit_place' => 'required',
            'address_edit_place' => 'required',
            // 'phone_edit_place' => ['required', 'regex:/^0?[1-9][0-9]{9,10}$/'],
            'start_edit_time' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/'],
            'end_edit_time' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d$/'],
            'email_edit_contact_place' => ['required', 'email'],
            'edit_latitude_place' => 'required',
            'edit_longitude_place' => 'required',
            'describe_edit_place' => 'required',
        ], [
            'name_edit_place.required' => 'Trường tên địa điểm là bắt buộc.',
            'address_edit_place.required' => 'Trường địa chỉ là bắt buộc.',
            // 'phone_edit_place.required' => 'Trường số điện thoại là bắt buộc.',
            // 'phone_edit_place.regex' => 'Định dạng số điện thoại không đúng. Vui lòng nhập theo định dạng 10 chữ số và bắt đầu bằng số 0.',
            'start_edit_time.required' => 'Trường thời gian mở cửa là bắt buộc.',
            'start_edit_time.regex' => 'Định dạng thời gian HH:MM không đúng (ví dụ 20:50)',
            'end_edit_time.required' => 'Trường thời gian đóng cửa là bắt buộc.',
            'end_edit_time.regex' => 'Định dạng thời gian HH:MM không đúng (ví dụ 20:50)',
            'edit_latitude_place' => 'Trường kinh độ là bắt buộc',
            'edit_longitude_place' => 'Trường vĩ độ là bắt buộc',
            'email_edit_contact_place.required' => 'Trường email liên hệ là bắt buộc.',
            'email_edit_contact_place.email' => 'Định dạng email không đúng',
            'describe_edit_place.required' => 'Trường mô tả địa điểm là bắt buộc.',
        ]);
        // dd($request->all());
        // if ($request->latitude_place && $request->longitude_place) {
        //     DB::table('VLPlaceCoordinate')
        //         ->where('id_coordinate', $id)
        //         ->update([
        //             'latitude' => $request->latitude_place,
        //             'longitude' => $request->longitude_place
        //         ]);
        // }
        $convert_name_type_service = implode('|', $request->name_edit_type_service);
        $vlplace = VLPlace::findOrFail($id);
        $vlplace->id_area = $request->id_edit_area;
        $vlplace->id_price = $request->id_edit_price;
        $vlplace->id_type = $request->id_edit_type;
        $vlplace->name_place = $request->name_edit_place;
        $vlplace->address_place = $request->address_edit_place;
        $vlplace->feature_place = $convert_name_type_service;
        $vlplace->start_time = $request->start_edit_time;
        $vlplace->end_time = $request->end_edit_time;
        $vlplace->latitude = $request->edit_latitude_place;
        $vlplace->longitude = $request->edit_longitude_place;
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
            $results = DB::select('EXEC DeleteVLPlaceById ?;', [$id]);
            $message = $results[0]->message;
            if ($message === 'Deleted') {
                $parts = parse_url($vlplace->image_url);
                $path = ltrim($parts['path'], '/');
                $imgDelete = basename($path);

                $storage = (new Factory)->withServiceAccount('../vilo-tourism-firebase-adminsdk-jgppv-ee7114cf39.json')->createStorage();
                $bucket = $storage->getBucket();
                $bucket->object($imgDelete)->delete();
                return response()->json([
                    'success' => true,
                    'data' => $results,
                ]);
            } elseif ($message === 'CannotDelete') {
                return response()->json([
                    'success' => false,
                    'data' => $results,
                ]);
            }
        } else {
            $results = DB::select('EXEC DeleteVLPlaceById ?;', [$id]);
            $message = $results[0]->message;
            if ($message === 'Deleted') {
                return response()->json([
                    'success' => true,
                    'data' => $results,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'data' => $results,
                ]);
            }
        }
        // return response()->json([
        //     'success' => true,
        //     'data' => 'Thành công xóa',
        // ]);
        // return response()->json([
        //     'success' => true,
        //     'data' => $results,
        // ]);
    }
}