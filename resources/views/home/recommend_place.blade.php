<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giới thiệu</title>
    @include('/components.constraint')
    <style>
        .title_introduction {
            width: 100%;
            padding-right: 10%;
            padding-left: 10%;
            margin-right: auto;
            margin-left: auto;
        }

        .dotted-list {
            list-style-type: disc;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    @include('/components.header_home')
    <div class="text-center p-2">
        <h1 class="text-2xl capitalize italic text-green-500">Gợi ý cho bạn</h1>
    </div>
    <div class="container pt-6 px-16 mx-auto sm:w-750 md:w-970 lg:w-1170">
        {{-- <div class="grid grid-rows-2 grid-cols-4 gap-4 h-96" style="height: 500px">
            <div class="row-span-2 rounded-3xl"><img class="w-full h-full " src="{{ $responseData[0]['image_url'] }}" />
            </div>
            <div class="col-span-2 bg-emerald-300 rounded-lg"><img class="w-full h-full"
                    src="{{ $responseData[1]['image_url'] }}" /></div>
            <div class="bg-teal-700 rounded-lg"><img class="w-full h-full" src="{{ $responseData[2]['image_url'] }}" />
            </div>
            <div class="bg-cyan-600 rounded-lg"><img class="w-full h-full" src="{{ $responseData[3]['image_url'] }}" />
            </div>
            <div class="col-span-2 bg-cyan-600 rounded-lg"><img class="w-full h-full"
                    src="{{ $responseData[4]['image_url'] }}" />
            </div>
        </div> --}}

        <hr class="p-2">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            @foreach ($responseData as $responseData)
                @if ($loop->index < 6)
                    <div class="relative rounded overflow-hidden">
                        <a href="/detailplace/{{ $responseData['id'] }}" target="_blank">
                            <img class="w-full h-full" src="{{ $responseData['image_url'] }}" />
                        </a>
                        <p class="absolute text-center inset-x-0 bottom-0 text-black">{{ $responseData['name'] }}</p>
                    </div>
                @else
                @break
            @endif
        @endforeach
        <hr class="p-2">
    </div>
</div>
@include('/components.footer')
</body>

</html>
