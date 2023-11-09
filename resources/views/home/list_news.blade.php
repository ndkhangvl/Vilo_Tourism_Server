<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('/components.constraint')
    <title>Document</title>
</head>

<body>
    @include('/components.header_home')
    <div class="container pt-6 px-16 mx-auto sm:w-750 md:w-970 lg:w-1170 ">
        <div class="grid grid-cols-2 gap-4">
            <div class="news p-2">
                <div class="flex justify-between items-end">
                    <h1 class="text-blue-600/100 text-xl font-bold uppercase">Sự kiện</h1>
                    <a href="/list-news" class="text-gray-500 hover:text-blue-600 text-sm order-last">Xem thêm</a>
                </div>
                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                <div class="grid gap-4">
                    <div class="relative">
                        <img src="{{ $vlnews[0]->image_url_news }}" alt="Image" class="w-full h-auto">
                        <div class="block w-full bg-opacity-50 text-black text-left">
                            <h1 class="xl:text-sm max-sm:text-xs font-bold">{{ $vlnews[0]->title_news }}</h1>
                            <h1 class="xl:text-sm max-sm:text-xs text-justify line-clamp-2">{!! $vlnews[0]->content_news !!}</h1>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                            @foreach ($vlnews->slice(1) as $vlnew)
                                <div class="relative">
                                    <img src="{{ $vlnew->image_url_news }}" alt="Image"
                                        class="object-cover w-full h-48">
                                    <div class="block w-full bg-opacity-50 text-black text-left">
                                        <h1 class="xl:text-sm max-sm:text-xs font-bold">{{ $vlnew->title_news }}</h1>
                                        <div class="line-clamp-2 normal-case prose">
                                            <h1 class="xl:text-sm max-sm:text-xs text-justify">
                                                {!! strip_tags($vlnew->content_news, '<p><a><br><ul><li>') !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="news p-2">
                <div class="flex justify-between items-end">
                    <h1 class="text-blue-600/100 text-xl font-bold uppercase">Tin tức</h1>
                    <a href="/list-news" class="text-gray-500 hover:text-blue-600 text-sm order-last">Xem thêm</a>
                </div>
                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                <div class="grid gap-4">
                    <div class="relative">
                        <a href="/detailnews/{{ $vlnews[0]->id_news }}">
                            <img src="{{ $vlnews[0]->image_url_news }}" alt="Image" class="w-full h-auto">
                        </a>
                        <div class="block w-full bg-opacity-50 text-black text-left">
                            <h1 class="xl:text-sm max-sm:text-xs font-bold">{{ $vlnews[0]->title_news }}</h1>
                            <h1 class="xl:text-sm max-sm:text-xs text-justify line-clamp-2">{!! $vlnews[0]->content_news !!}</h1>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                            @foreach ($vlnews->slice(1) as $vlnew)
                                <div class="relative">
                                    <img src="{{ $vlnew->image_url_news }}" alt="Image"
                                        class="object-cover w-full h-48">
                                    <div class="block w-full bg-opacity-50 text-black text-left">
                                        <h1 class="xl:text-sm max-sm:text-xs font-bold">{{ $vlnew->title_news }}</h1>
                                        <div class="line-clamp-2 normal-case prose">
                                            <h1 class="xl:text-sm max-sm:text-xs text-justify">
                                                {!! strip_tags($vlnew->content_news, '<p><a><br><ul><li>') !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="news p-2 mt-4">
            <div class="flex justify-between items-end">
                <h1 class="text-blue-600/100 text-xl font-bold uppercase">Bài viết nhiều lượt xem nhất</h1>
                <a href="/list-news" class="text-gray-500 hover:text-blue-600 text-sm order-last">Xem thêm</a>
            </div>
            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="grid gap-4">
                <div class="pt-2">
                    <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                        @foreach ($vlnews->slice(1) as $vlnew)
                            <div class="relative">
                                <img src="{{ $vlnew->image_url_news }}" alt="Image" class="object-cover w-full h-48">
                                <div class="block w-full bg-opacity-50 text-black text-left">
                                    <h1 class="xl:text-sm max-sm:text-xs font-bold">{{ $vlnew->title_news }}</h1>
                                    <div class="line-clamp-2 normal-case prose">
                                        <h1 class="xl:text-sm max-sm:text-xs text-justify">
                                            {!! strip_tags($vlnew->content_news, '<p><a><br><ul><li>') !!}
                                    </div>
                                    {{-- <h1 class="xl:text-sm max-sm:text-xs text-justify line-clamp-2">
                                        {!! $vlnew->content_new !!}</h1> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
