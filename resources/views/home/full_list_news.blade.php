<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('/components.constraint')
    <title>Danh sách bài viết</title>
</head>

<body>
    @include('/components.header_home')
    <div class="container md:pt-6 md:px-16 mx-auto sm:w-750 md:w-970 lg:w-1170 ">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="news p-2">
                <div class="flex justify-between items-end">
                    <h1 class="text-green-700 text-xl font-bold uppercase">Sự kiện</h1>
                    <a href="/list-event" class="text-gray-500 hover:text-blue-600 text-sm order-last">Xem thêm</a>
                </div>
                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                @if (count($vlnews_event) > 0)
                    <div class="grid gap-4">
                        <div class="relative">
                            <a href="/detailnews/{{ $vlnews_event[0]->id_news }}">
                                <img src="{{ $vlnews_event[0]->image_url_news }}" alt="Image"
                                    class="w-full object-fit" style="height: 300px">
                                <div class="block w-full bg-opacity-50 text-black text-left">
                                    <h1 class="xl:text-sm max-sm:text-xs font-bold">{{ $vlnews_event[0]->title_news }}
                                    </h1>
                                    <h1 class="xl:text-sm max-sm:text-xs text-justify line-clamp-2">
                                        {!! $vlnews_event[0]->content_news !!}
                                    </h1>
                                </div>
                            </a>
                        </div>
                        <div class="pt-2">
                            <div class="grid grid-cols-1 gap-4">
                                @foreach ($vlnews_event->slice(1) as $vlnews_event)
                                    <div class="">
                                        <a class="md:flex md:flex-cols" href="/detailnews/{{ $vlnews_event->id_news }}">
                                            <div class="w-full md:w-1/2">
                                                <img src="{{ $vlnews_event->image_url_news }}" alt="Image"
                                                    class="object-cover h-40 w-full" />
                                            </div>
                                            <div class="bg-opacity-50 text-black text-left p-2 w-full md:w-1/2">
                                                <h1 class="text-sm md:text-xl font-bold">{{ $vlnews_event->title_news }}
                                                </h1>
                                                <div class="line-clamp-2 normal-case prose">
                                                    <h1 class="xl:text-sm max-sm:text-xs text-justify">
                                                        {!! strip_tags($vlnews_event->content_news, '<p><a><br><ul><li>') !!}
                                                    </h1>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <p>Không có sự kiện nào được hiển thị</p>
                @endif
            </div>
            <div class="news p-2">
                <div class="flex justify-between items-end">
                    <h1 class="text-green-700 text-xl font-bold uppercase">Tin tức</h1>
                    <a href="/list-news" class="text-gray-500 hover:text-blue-600 text-sm order-last">Xem thêm</a>
                </div>
                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                <div class="grid gap-4">
                    <div class="relative">
                        <a href="/detailnews/{{ $vlnews[0]->id_news }}">
                            <img src="{{ $vlnews[0]->image_url_news }}" alt="Image" class="w-full object-fit"
                                style="height: 300px">
                        </a>
                        <div class="block w-full bg-opacity-50 text-black text-left">
                            <h1 class="xl:text-sm max-sm:text-xs font-bold">{{ $vlnews[0]->title_news }}</h1>
                            <h1 class="xl:text-sm max-sm:text-xs text-justify line-clamp-2">{!! $vlnews[0]->content_news !!}</h1>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="grid grid-cols-1 gap-4">
                            @foreach ($vlnews->slice(1) as $vlnew)
                                <div class="">
                                    <a class="md:flex md:flex-cols" href="/detailnews/{{ $vlnew->id_news }}">
                                        <div class="w-full md:w-1/2">
                                            <img src="{{ $vlnew->image_url_news }}" alt="Image"
                                                class="object-cover h-40 w-full" />
                                        </div>
                                        <div class="bg-opacity-50 text-black text-left p-2 w-full md:w-1/2">
                                            <h1 class="text-sm md:text-xl font-bold">{{ $vlnew->title_news }}</h1>
                                            <div class="line-clamp-2 normal-case prose">
                                                <h1 class="xl:text-sm max-sm:text-xs text-justify">
                                                    {!! strip_tags($vlnew->content_news, '<p><a><br><ul><li>') !!}
                                                </h1>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="news p-2 mt-4">
            <div class="flex justify-between items-end">
                <h1 class="text-green-700 text-xl font-bold uppercase">Bài viết nhiều lượt xem nhất</h1>
                {{-- <a href="/list-news" class="text-gray-500 hover:text-blue-600 text-sm order-last">Xem thêm</a> --}}
            </div>
            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="grid gap-4">
                <div class="pt-2">
                    <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                        @foreach ($most_view_news as $most_view_news)
                            <a href="/detailnews/{{ $most_view_news->id_news }}">
                                <div class="relative">
                                    <img src="{{ $most_view_news->image_url_news }}" alt="Image"
                                        class="object-cover w-full h-48">
                                    <div class="block w-full bg-opacity-50 text-black text-left">
                                        <h1 class="xl:text-sm max-sm:text-xs font-bold pt-2">
                                            {{ $most_view_news->title_news }}
                                        </h1>
                                        <div class="flex p-2">
                                            <h1 class="xl:text-sm max-sm:text-xs italic self-center mr-4">
                                                Ngày đăng:
                                                {{ \Carbon\Carbon::parse($most_view_news->date_post_news)->format('d/m/Y') }}
                                            </h1>
                                            <i class="fas fa-eye self-center mr-2" style="color: #8a8a8a;"></i>
                                            </span>
                                            <h1 class="xl:text-sm max-sm:text-xs font-medium italic self-center">
                                                Số lượt xem: {{ $most_view_news->view_news }}
                                            </h1>
                                        </div>
                                        <div class="line-clamp-2 normal-case prose">
                                            <h1 class="xl:text-sm max-sm:text-xs text-justify">
                                                {!! strip_tags($most_view_news->content_news, '<p><a><br><ul><li>') !!}
                                        </div>
                                        {{-- <h1 class="xl:text-sm max-sm:text-xs text-justify line-clamp-2">
                                        {!! $vlnew->content_new !!}</h1> --}}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
