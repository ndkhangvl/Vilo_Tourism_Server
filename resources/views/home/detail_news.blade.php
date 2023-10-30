<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chi tiết tin tức</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script
        src="
                                                                                                                                                                                                                                                            https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js
                                                                                                                                                                                                                                                            ">
    </script>
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
    <div class="container pt-6 px-16 mx-auto sm:w-750 md:w-970 lg:w-1170 ">
        <div class="flex p-2">
            @foreach ($detail_news as $detail_news)
                <div class="content w-3/4 pr-2">
                    <div class="flex flex-row">
                        <h1 class="md:text-3xl text-md font-bold">{{ $detail_news->title_new }}</h1>
                    </div>
                    <div class="flex flex-row justify-start">
                        <h1>Ngày đăng: <span id="date_post_news" class="mr-2 italic"></span></h1>
                        <h1 class="">Số lượt xem: <span class="italic">{{ $detail_news->view_new }}</span></h1>
                    </div>
                    <div class="content">
                        {!! $detail_news->content_new !!}
                    </div>
                </div>
            @endforeach
            <div class="content border-2 shadow w-1/4">
                <div class="bg-yellow-500 text-center text-white font-bold">
                    <h2><i class="fas fa-home pr-2"></i>Địa điểm gần đây</h2>
                </div>
                <div class="p-2">

                </div>
            </div>
        </div>
    </div>
    @include('/components.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var formattedDate = moment("{{ $detail_news->date_post_new }}").format('DD/MM/YYYY');
            console.log(formattedDate);
            $("#date_post_news").text(formattedDate);
        });
    </script>
</body>
