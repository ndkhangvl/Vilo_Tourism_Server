<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ss, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('/components.constraint')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <title>Danh sách địa điểm</title>
</head>

<body>
    @include('/components.header_home')
    <div class="container md:pt-6 md:px-16 mx-auto sm:w-750 md:w-970 lg:w-1170">
        <div class="w-full border shadow mb-4 rounded-lg p-2">
            <input type="password" id="search_place" name="search_place"
                class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            <hr class="m-2 mx-auto w-24 h-1 bg-green-700" />
        </div>
        <div class="w-full shadow mb-4">
            <div class="p-2">
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 md:grid-cols-3">
                    @foreach ($vlplace as $vlplace)
                        <div class="relative shadow bg-gray-50 dark:bg-gray-800">
                            <a href="/detailplace/{{ $vlplace->id_place }}"> <img src="{{ $vlplace->image_url }}"
                                    alt="" class="object-cover w-full h-64">
                                <div class="p-3 flex flex-col">
                                    <p
                                        class="text-xl font-bold tracking-tight text-gray-900 dark:text-gray-300 line-clamp-1 hover:text-green-500">
                                        {{ $vlplace->name_place }}
                                    </p>
                                    <p class="line-clamp-1">{{ $vlplace->address_place }}</p>
                                    <div class="flex place-items-center">
                                        <div class="rateYoPlace" data-rating="{{ $vlplace->rating }}"></div>
                                        <p class="italic">Lượt xem: {{ $vlplace->view_place }}</p>
                                        {{-- <a href="/detailplace/{{ $vlplace->id_place }}"
                                                class="inline-flex items-center text-sm font-medium text-blue-600 hover:underline dark:hover:text-blue-500 dark:text-blue-400 hover:text-red-600">
                                                Xem chi tiết
                                            </a> --}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        const elements = document.getElementsByClassName('rateYoPlace');

        for (let index = 0; index < elements.length; index++) {

            const element = elements[index];
            // console.log(element);

            $(element).rateYo({
                rating: element.getAttribute('data-rating'),
                starWidth: "16px",
                fullStar: true,
                readOnly: true,
            });
        }
    </script>
</body>

</html>
