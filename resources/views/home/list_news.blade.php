<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('msg.detail_news') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/ckeditor-tailwind-reset.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    @include('/components.constraint')
    <style>
        .devider {
            display: block;
            width: 70px;
            background-color: green;
            height: 2px;
            margin-left: auto;
            margin-right: auto;
        }

        #main {
            padding: 1px 100px;
        }

        .distance-tooltip {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    @include('/components.header_home')
    <div class="p-2 md:container md:pt-6 md:px-16 mx-auto sm:w-750 md:w-970 lg:w-1170 ">
        <div class="block md:flex p-2 ">
            <div class="content w-full md:w-8/12 pr-2 pb-2">
                @if (count($vlnews) > 0)
                    @foreach ($vlnews as $vlnews)
                        <a href="/detailnews/{{ $vlnews->id_news }}">
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="">
                                    <img class="w-full object-cover rounded-lg" src="{{ $vlnews->image_url_news }}"
                                        alt="Hình ảnh" style="height: 250px">
                                </div>
                                <div class="">
                                    <h1
                                        class="md:text-3xl text-md font-bold text-justify line-clamp-3 hover:text-emerald-500">
                                        {{ $vlnews->title_news }}</h1>
                                    <div class="flex flex-row justify-start pb-3">
                                        <h1>{{ trans('msg.date_post_news') }}: <span id="date_post_news"
                                                class="mr-2 italic">
                                                {{ \Carbon\Carbon::parse($vlnews->date_post_news)->format('d/m/Y') }}</span>
                                        </h1>
                                        <h1 class="">{{ trans('msg.view_news') }}: <span
                                                class="italic">{{ $vlnews->view_news }}</span>
                                        </h1>
                                    </div>
                                    <div class="line-clamp-3 normal-case prose">
                                        <h1 class="xl:text-sm max-sm:text-xs text-justify">
                                            {!! strip_tags($vlnews->content_news, '<p><br><ul><li>') !!}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p>{{ trans('msg.no_news') }}</p>
                @endif
            </div>
            <div class="content w-full md:w-4/12 md:pl-4" style="align-self: flex-start; top: 0px; position: sticky">
                <div class="text-black text-left font-bold">
                    <h2>{{ trans('msg.new_news') }}</h2>
                </div>
                <hr class="mt-2" />
                <div class="md:p-2">
                    <ul class="list-disc md:ml-4 md:pl-8 ml-2 pl-4">
                        @foreach ($news_new as $news_new)
                            <li class="md:capitalize md:pl-4 text-justify md:mb-2"><a
                                    class="font-sans text-black text-md leading-5 tracking-wide"
                                    href="/detailnews/{{ $news_new->id_news }}">{{ $news_new->title_news }}</a>
                                <p class="text-zinc-400 italic date_post_news_2">
                                    {{ \Carbon\Carbon::parse($news_new->date_post_news)->format('d/m/Y') }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('/components.footer')
</body>
