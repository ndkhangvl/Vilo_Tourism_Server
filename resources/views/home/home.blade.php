<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('/components.constraint')
    <style>
        .container {
            width: 100%;
            padding-right: 10%;
            padding-left: 10%;
            margin-right: auto;
            margin-left: auto;
        }

        .grid-container {
            height: 200px;
            /* Đặt độ cao cố định cho khung */
            overflow-x: scroll;
            white-space: nowrap;
            /* Tạo thanh cuộn khi nội dung vượt quá khung */
        }
    </style>
</head>

<body>
    @include('/components.header_home')
    @include('/components.carousel')
    <div class="container">
        <div class="news p-2">
            <div class="flex justify-between items-end">
                <h1 class="p-2 text-blue-600/100 text-2xl font-bold">Tin tức</h1>
                <a href="#" class="text-gray-500 hover:text-blue-600 text-sm order-last">Xem thêm</a>
            </div>
            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="grid gap-4">
                <div class="relative">
                    <img src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/05_637763058319802509.jpg?alt=media&token=b2f2abba-267a-4e02-aa45-3bb479d3bc3c"
                        alt="Image" class="w-full h-auto">
                    <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                        <h1 class="text-4xl p-4">Text in Image</h1>
                    </div>
                </div>
                <div class="grid-container">
                    <div class="grid grid-cols-5 gap-4">
                        <div class="relative">
                            <img src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/05_637763058319802509.jpg?alt=media&token=b2f2abba-267a-4e02-aa45-3bb479d3bc3c"
                                alt="Image" class="w-full h-auto">
                            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                                <h1 class="text-sm p-4">Text in Image</h1>
                            </div>
                        </div>
                        <div class="relative">
                            <img src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/05_637763058319802509.jpg?alt=media&token=b2f2abba-267a-4e02-aa45-3bb479d3bc3c"
                                alt="Image" class="w-full h-auto">
                            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                                <h1 class="text-sm p-4">Text in Image</h1>
                            </div>
                        </div>
                        <div class="relative">
                            <img src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/05_637763058319802509.jpg?alt=media&token=b2f2abba-267a-4e02-aa45-3bb479d3bc3c"
                                alt="Image" class="w-full h-auto">
                            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                                <h1 class="text-sm p-4">Text in Image</h1>
                            </div>
                        </div>
                        <div class="relative">
                            <img src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/05_637763058319802509.jpg?alt=media&token=b2f2abba-267a-4e02-aa45-3bb479d3bc3c"
                                alt="Image" class="w-full h-auto">
                            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                                <h1 class="text-sm p-4">Text in Image</h1>
                            </div>
                        </div>
                        <div class="relative">
                            <img src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/05_637763058319802509.jpg?alt=media&token=b2f2abba-267a-4e02-aa45-3bb479d3bc3c"
                                alt="Image" class="w-full h-auto">
                            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                                <h1 class="text-sm p-4">Text in Image</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="news p-2">
            <div class="flex justify-between items-end">
                <h1 class="p-2 text-blue-600/100 text-2xl font-bold">Điểm đến</h1>
                <a href="#" class="text-gray-500 hover:text-blue-600 text-sm order-last">Xem thêm</a>
            </div>
            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="content">
                <div class="grid grid-cols-2 gap-4 justify-evenly p-2">
                    <div
                        class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 w-full h-full">
                        <a href="#">
                            <img class="object-fill w-full h-full transform hover:scale-105 transition duration-300 shadow-2xl"
                                src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/Khang.png?alt=media&token=f1699427-6b19-4759-b3fb-d7de52d1b0ae"
                                alt="product image" />
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($vlplaces as $vlplace)
                            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 transform hover:scale-105 transition duration-300 shadow-2xl"
                                style="height: 20em">
                                <div class="w-128 h-48">
                                    <a href="#">
                                        <img class="rounded-t-lg object-fill w-full h-full"
                                            src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/Khang.png?alt=media&token=f1699427-6b19-4759-b3fb-d7de52d1b0ae"
                                            alt="product image" />
                                    </a>
                                </div>
                                <div class="px-3">
                                    <a href="#">
                                        <h5
                                            class="text-base truncate ... font-semibold tracking-tight text-gray-900 dark:text-white">
                                            {{ $vlplace->name_place }}
                                        </h5>
                                    </a>
                                    <div class="flex items-center mt-2.5 mb-5">
                                        <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">5.0</span>
                                        <span class="text-sm font-bold text-gray-900 dark:text-white">lượt xem</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <a href="/detailplace/{{ $vlplace->id_place }}"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Xem
                                            chi tiết</a>
                                    </div>
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
