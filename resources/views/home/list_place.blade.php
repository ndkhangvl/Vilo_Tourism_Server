<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ss, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('/components.constraint')
    <title>Danh sách địa điểm</title>
</head>

<body>
    @include('/components.header_home')
    <div class="container pt-6 px-16 mx-auto sm:w-750 md:w-970 lg:w-1170 ">
        <div class="flex">
            <div class="w-1/4 shadow">
                @include('/components.filter_place')
            </div>
            <div class="w-3/4 shadow">
                <div class="justify-center max-w-6xl px-4 py-4 mx-auto lg:py-0">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 md:grid-cols-2">
                        @foreach ($vlplace as $vlplace)
                            <div class="relative shadow">
                                <img src="https://dulichmedia.dalat.vn//Images/VLG/superadminportal.vlg/636541153470000144_images1813510_5.12.Duy.Xuan.AnhTPVinhLong1.jpg"
                                    alt="" class="object-cover w-full h-64">
                                <div class="p-3 bg-gray-50 dark:bg-gray-800">
                                    <a href=""
                                        class="text-xl font-bold tracking-tight text-gray-900 dark:text-gray-300">
                                        {{ $vlplace->name_place }}
                                    </a>
                                    {{-- <p class="py-2 font-normal text-gray-600 dark:text-gray-400 line-clamp-3 ...">
                                        {{ $vlplace->describe_place }}
                                    </p> --}}
                                    <a href="/detailplace/{{ $vlplace->id_place }}"
                                        class="inline-flex items-center text-sm font-medium text-blue-600 hover:underline dark:hover:text-blue-500 dark:text-blue-400 hover:text-red-600 ">
                                        Xem chi tiết</a>
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
