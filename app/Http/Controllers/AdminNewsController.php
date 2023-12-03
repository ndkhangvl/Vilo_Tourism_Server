<?php

namespace App\Http\Controllers;

use App\Models\VLNews;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        $request->validate([
            'title_news' => 'required',
            'content_news' => 'required',
        ], [
            'title_news.required' => 'Trường tên địa điểm là bắt buộc.',
            'content_news' => 'Trường nội dung là bắt buộc',
        ]);


        $vlnews = new VLnews;
        $vlnews->title_news = $request->title_news;
        $vlnews->content_news = $request->content_news;
        $vlnews->id_type_news = $request->type_news;
        $vlnews->date_post_news = Carbon::now();
        $vlnews->view_news = 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $nonAccentText = Str::slug($request->title_news, '');
            // dd($nonAccentText);
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
            $vlnews->image_url_news = $imageUrl;
        }
        // $vlplace->image_url = $imageUrl;

        $vlnews->save();

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
        $vlnews = VLNews::findOrFail($id);
        $vlnews->title_news = $request->edit_title_news;
        $vlnews->content_news = $request->content_edit_news;
        $vlnews->id_type_news = $request->type_edit_news;
        // $vlplace->describe_place = $request->describe_edit_place;
        if ($vlnews->image_url_news == null) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $nonAccentText = Str::slug($request->edit_title_news, '');
                $fileName = $nonAccentText . '.' . $image->getClientOriginalExtension();
                // $cleanedText = preg_replace('/\s+/', '', $nonAccentText);

                $factory = (new Factory)->withServiceAccount('../vilo-tourism-firebase-adminsdk-jgppv-ee7114cf39.json');
                $storage = $factory->createStorage();
                $bucket = $storage->getBucket();
                $bucket->upload(file_get_contents($image->getPathname()), [
                    'name' => $fileName
                ]);

                $imageUrl = $bucket->object($fileName)->signedUrl(new \DateTime('2500-01-01T00:00:00Z'));

                $vlnews->image_url_news = $imageUrl;
            }
        } else {
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $nonAccentText = Str::slug($request->edit_title_news, '');
                $fileName = $nonAccentText . '.' . $image->getClientOriginalExtension();

                // dd($vlplace->image_url);
                $parts = parse_url($vlnews->image_url_news);
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

                $vlnews->image_url_news = $imageUrl;
            }
        }

        $vlnews->save();

        return response()->json([
            'success' => true,
            'input' => $request->all()
        ]);
    }

    public function delete($id)
    {
        $vlplace = VLNews::findOrFail($id);

        if ($vlplace->image_url != null) {
            $parts = parse_url($vlplace->image_url);
            $path = ltrim($parts['path'], '/');
            $imgDelete = basename($path);

            $storage = (new Factory)->withServiceAccount('../vilo-tourism-firebase-adminsdk-jgppv-ee7114cf39.json')->createStorage();
            $bucket = $storage->getBucket();
            $bucket->object($imgDelete)->delete();
            $results = DB::statement('EXEC DeleteVLNewsById ?;', [$id]);
        } else {
            $results = DB::statement('EXEC DeleteVLNewsById ?;', [$id]);
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