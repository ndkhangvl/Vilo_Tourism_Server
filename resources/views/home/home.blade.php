<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('/components.constraint')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/polyline-encoded@0.0.9/Polyline.encoded.min.js"></script>
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

        #map {
            width: 100%;
            height: 500px;
        }

        .goongjs-popup {
            max-width: 400px;
            font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
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
                    <img src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/Khang.png?alt=media&token=f1699427-6b19-4759-b3fb-d7de52d1b0ae"
                        alt="Image" class="w-full h-auto">
                    <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                        <h1 class="text-4xl p-4">Text in Image</h1>
                    </div>
                </div>
                <div class="grid-container">
                    <div class="grid grid-cols-5 gap-4">
                        <div class="relative">
                            <img src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/Khang.png?alt=media&token=f1699427-6b19-4759-b3fb-d7de52d1b0ae"
                                alt="Image" class="w-full h-auto">
                            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                                <h1 class="text-sm p-4">Text in Image</h1>
                            </div>
                        </div>
                        <div class="relative">
                            <img src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/Khang.png?alt=media&token=f1699427-6b19-4759-b3fb-d7de52d1b0ae"
                                alt="Image" class="w-full h-auto">
                            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                                <h1 class="text-sm p-4">Text in Image</h1>
                            </div>
                        </div>
                        <div class="relative">
                            <img src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/Khang.png?alt=media&token=f1699427-6b19-4759-b3fb-d7de52d1b0ae"
                                alt="Image" class="w-full h-auto">
                            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                                <h1 class="text-sm p-4">Text in Image</h1>
                            </div>
                        </div>
                        <div class="relative">
                            <img src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/Khang.png?alt=media&token=f1699427-6b19-4759-b3fb-d7de52d1b0ae"
                                alt="Image" class="w-full h-auto">
                            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                                <h1 class="text-sm p-4">Text in Image</h1>
                            </div>
                        </div>
                        <div class="relative">
                            <img src="https://firebasestorage.googleapis.com/v0/b/vilo-tourism.appspot.com/o/Khang.png?alt=media&token=f1699427-6b19-4759-b3fb-d7de52d1b0ae"
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
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 22 20">
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
        <div class="center p-2">
            <div id="map"></div>
        </div>
    </div>
    @include('/components.footer')
    <script>
        var map = L.map('map').setView([10.246602, 105.971673], 14);
        // apikey =
        //     'https://maps.vietmap.vn/api/dm/{z}/{x}/{y}@2x.png?apikey=c3d0f188ff669f89042771a20656579073cffec5a8a69747';
        L.tileLayer('https://maps.vietmap.vn/tm/{z}/{x}/{y}.png?apikey=c3d0f188ff669f89042771a20656579073cffec5a8a69747', {
            attribution: '&copy; <a href="https://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        }).addTo(map);

        $(document).ready(function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    markers.forEach(function(marker) {
                        var newMarker = L.marker([latitude, longitude], {
                                icon: marker.icon
                            }).bindPopup(
                                '<p style="color: green; font-weight: bold"> Vị trí hiện tại </p>')
                            .addTo(map);
                    });
                    console.log('Latitude: ' + latitude);
                    console.log('Longitude: ' + longitude);
                    $.ajax({
                        url: 'https://maps.vietmap.vn/api/route?point=' + latitude + ',' +
                            longitude +
                            '&point=10.24289042956059,105.98461513620583&apikey=c3d0f188ff669f89042771a20656579073cffec5a8a69747',
                        type: 'get',
                        success: function(res) {
                            // console.log(res);
                            var colors = ['red', 'blue', 'green', 'yellow', 'orange'];
                            // var html = '<h2 class="title">Kết quả lộ trình</h2>';
                            for (var i = 0; i < res.paths.length; i++) {
                                var totalmeter = 0;
                                var num = Number(i + 1);
                                // var subhtml = '';
                                // subhtml += '<ul class="list">';
                                var instructions = res.paths[i].instructions;
                                // var points = res.paths[i].points.coordinates;
                                var points = res.paths[i].points;
                                console.log(points);
                                var polyline = L.Polyline.fromEncoded(points);
                                var coordinates = polyline.getLatLngs();
                                console.log(coordinates);
                            }

                            //draw line
                            var latlngs = [];

                            for (var k = 0; k < coordinates.length; k++) {
                                latlngs.push([coordinates[k].lat, coordinates[k].lng]);
                            }

                            var colorIdx = i % colors.length;
                            var polyline = L.polyline(latlngs, {
                                color: colors[colorIdx]
                            }).addTo(map);
                            // zoom the map to the polyline
                            map.fitBounds(polyline.getBounds());

                            var endIcon = L.icon({
                                iconUrl: 'https://cdn-icons-png.flaticon.com/512/2775/2775994.png',
                                iconSize: [35, 35], // size of the icon
                                iconAnchor: [17,
                                    17
                                ], // point of the icon which will correspond to marker's location
                            });
                            var startIcon = L.icon({
                                iconUrl: 'https://cdn-icons-png.flaticon.com/512/2775/2775994.png',
                                iconSize: [35, 35], // size of the icon
                                iconAnchor: [17,
                                    17
                                ], // point of the icon which will correspond to marker's location
                            });

                            L.marker(latlngs[0], {
                                icon: startIcon
                            }).addTo(map);
                            L.marker(latlngs[latlngs.length - 1], {
                                icon: endIcon
                            }).addTo(map);

                        }
                    })
                });
            } else {
                console.log('Geolocation is not supported by this browser.');
            }
        })
        // L.tileLayer(apikey, {
        //     attribution: '&copy; <a href="https://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        // }).addTo(map);
        var greenIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/2775/2775994.png',

            iconSize: [35, 35], // size of the icon
            iconAnchor: [17, 17], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -17] // point from which the popup should open relative to the iconAnchor
        });

        var markers = [{
                coordinates: [10.24289042956059, 105.98461513620583],
                icon: greenIcon,
                name: "Văn Thánh Miếu Vĩnh Long"
            },
            {
                coordinates: [10.159404623604246, 106.09437396485744],
                icon: greenIcon,
                name: "Thánh Tịnh Ngọc Sơn Quang"
            },
            {
                coordinates: [10.270603597725295, 105.95376759554469],
                icon: greenIcon,
                name: "Khu Du Lịch Vinh Sang"
            },
            {
                coordinates: [10.24601303358093, 106.00493038205147],
                icon: greenIcon,
                name: "Khu Du Lịch Sinh Thái Hoàng Hảo"
            },
            {
                coordinates: [10.271718469021256, 105.9871891090376],
                icon: greenIcon,
                name: "Nhà Dừa CocoHome"
            },
            {
                coordinates: [10.263176661827437, 105.96914328205166],
                icon: greenIcon,
                name: "Chùa Tiên Châu"
            },
            // Thêm các điểm đánh dấu khác vào đây nếu cần
        ];

        markers.forEach(function(marker) {
            var newMarker = L.marker(marker.coordinates, {
                icon: marker.icon
            }).bindPopup('<p style="color: green; font-weight: bold">' + marker.name + '</p>').addTo(map);
        });
    </script>
</body>

</html>
