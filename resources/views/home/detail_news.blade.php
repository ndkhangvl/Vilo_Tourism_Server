<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chi tiết tin tức</title>
    <link rel="stylesheet" href="{{ asset('assets/css/ckeditor-tailwind-reset.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
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

        #map {
            width: 100%;
            height: 400px;
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
            @foreach ($detail_news as $detail_news)
                <div class="content w-full md:w-8/12 pr-2 pb-2">
                    <div class="flex flex-row">
                        <h1 class="md:text-3xl text-md font-bold text-justify">{{ $detail_news->title_news }}</h1>
                    </div>
                    <div class="flex flex-row justify-start pb-3">
                        <h1>Ngày đăng: <span id="date_post_news" class="mr-2 italic"></span></h1>
                        <h1 class="">Số lượt xem: <span class="italic">{{ $detail_news->view_news }}</span></h1>
                    </div>
                    <div class="ck-content text-justify" id="content">
                        {!! $detail_news->content_news !!}
                    </div>
                </div>
            @endforeach
            <div class="content w-full md:w-4/12 md:pl-4" style="align-self: flex-start; top: 0px; position: sticky">
                <div class="text-black text-left font-bold">
                    <h2>Tin mới nhất</h2>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var formattedDate = moment("{{ $detail_news->date_post_news }}").format('DD/MM/YYYY');
            // console.log(formattedDate);
            $("#date_post_news").text(formattedDate);
        });
    </script>
</body>
