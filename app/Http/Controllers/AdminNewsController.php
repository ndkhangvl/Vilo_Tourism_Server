<?php

namespace App\Http\Controllers;

use App\Models\VLNews;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;

class AdminNewsController extends Controller
{
    public function index()
    {
        $vlnews = DB::select('select * from VLNews');
        return view('admin.news', [
            'vlnews' => $vlnews,
        ]);
    }

    public function getVLNews($id)
    {
        $vlnews = DB::select('select * from VLNews where id_news=?', [$id]);
        return response()->json([
            'success' => true,
            'vlnews' => $vlnews,
        ]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name_place' => 'required',
        // ], [
        //     'name_place.required' => 'Trường tên địa điểm là bắt buộc.',
        // ]);


        $vlnews = new VLnews;
        $vlnews->title_new = $request->title_news;
        $vlnews->content_new = $request->content_news;
        $vlnews->date_post_new = Carbon::now();

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
            $vlnews->image_url_new = $imageUrl;
        }
        // $vlplace->image_url = $imageUrl;

        $vlnews->save();

        return response()->json([
            'success' => true,
            'input' => $request->all()
        ]);
    }
}