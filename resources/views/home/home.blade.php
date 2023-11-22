<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>
    @include('/components.constraint')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    {{-- Map --}}
    <script src="https://cdn.jsdelivr.net/npm/geolib@3.3.4/lib/index.min.js"></script>

    <style>
        .container {
            width: 100%;
            padding-right: 10%;
            padding-left: 10%;
            margin-right: auto;
            margin-left: auto;
        }

        @media screen and (max-width: 992px) {
            .container {
                width: 100%;
                padding-left: 0px;
                padding-right: 0px;
                margin-right: auto;
                margin-left: auto;
            }
        }

        .grid-container {
            height: 200px;
            /* Đặt độ cao cố định cho khung */
            /* overflow-x: scroll; */
            /* white-space: nowrap; */
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

        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body>
    @include('/components.header_home')
    @include('/components.carousel')
    <div class="container">
        <div class="news p-2">
            <div class="flex justify-between items-end">
                <h1 class="p-2 text-green-500 text-2xl font-bold">Tin tức</h1>
                <a href="/list-news" class="text-gray-500 hover:text-blue-600 text-sm order-last">Xem thêm</a>
            </div>
            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="grid gap-4">
                <div class="relative transform hover:scale-[1.02] transition duration-200">
                    <a href="/detailnews/{{ $vlnews[0]->id_news }}" class="">
                        <img src="{{ $vlnews[0]->image_url_news }}" alt="Image" class="w-full" style="height: 600px">
                        <div
                            class="absolute bottom-0 p-2 left-0 leading-5 w-full bg-gray-600 bg-opacity-50 text-white text-left">
                            @if ($vlnews[0]->id_type_news == 1)
                                <h1 class="xl:text-base max-sm:text-xs italic mb-1">Tin tức</h1>
                            @else
                                <h1 class="xl:text-base max-sm:text-xs italic mb-1">Sự kiện</h1>
                            @endif
                            <h1 class="xl:text-sm max-sm:text-xs font-medium">{{ $vlnews[0]->title_news }}</h1>
                        </div>
                    </a>
                </div>
                <div class="">
                    <div class="grid md:grid-cols-4 grid-cols-2 gap-4">
                        @foreach ($vlnews->slice(1) as $vlnew)
                            <div class="relative transform hover:scale-[1.03] transition duration-200">
                                <a href="/detailnews/{{ $vlnew->id_news }}">
                                    <img src="{{ $vlnew->image_url_news }}" alt="Image"
                                        class="object-cover w-full h-full" style="height: 200px;">
                                    <div
                                        class="absolute bottom-0 p-2 left-0 leading-5 w-full bg-gray-600 bg-opacity-50 text-white text-left">
                                        @if ($vlnew->id_type_news == 1)
                                            <h1 class="xl:text-sm max-sm:text-xs italic mb-1">Tin tức</h1>
                                        @else
                                            <h1 class="xl:text-sm max-sm:text-xs italic mb-1">Sự kiện</h1>
                                        @endif
                                        <h1 class="xl:text-sm max-sm:text-xs font-medium line-clamp-3">
                                            {{ $vlnew->title_news }}
                                        </h1>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="news p-2">
            <div class="flex justify-between items-end">
                <h1 class="p-2 text-green-500 text-2xl font-bold">Điểm đến</h1>
                <a href="/list-place" class="text-gray-500 hover:text-blue-600 text-sm order-last">Xem thêm</a>
            </div>
            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="content">
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-4 justify-evenly p-2">
                    <div
                        class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 w-full h-full">
                        <a href="/detailplace/{{ $vlplaces[0]->id_place }}">
                            <img class="object-fill w-full h-full transform hover:scale-105 transition duration-300 shadow-2xl"
                                src="{{ $vlplaces[0]->image_url }}" alt="Hình minh họa" />
                        </a>
                    </div>
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2">
                        @foreach ($vlplaces->slice(1) as $vlplace)
                            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 transform hover:scale-105 transition duration-300 shadow-2xl"
                                style="height: 20em">
                                <div class="w-128 h-48">
                                    <a href="#">
                                        <img class="rounded-t-lg object-fill w-full h-full"
                                            src="{{ $vlplace->image_url }}" alt="Hình minh họa" />
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
                                        {{-- <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true"
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
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg> --}}
                                        <div class="rateYoPlace" data-rating="{{ $vlplace->rating }}"></div>
                                        <span
                                            class="bg-green-300 text-green-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $vlplace->rating }}.0</span>
                                        <span
                                            class="text-sm font-bold text-gray-900 dark:text-white">{{ $vlplace->view_place }}
                                            lượt
                                            xem</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <a href="/detailplace/{{ $vlplace->id_place }}"
                                            class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Xem
                                            chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between items-end">
            <h1 class="p-2 text-green-500 text-2xl font-bold">Bản đồ</h1>
        </div>
        <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="md:flex center p-2 gap-2">
            <div id="map" class="md:w-3/4"></div>
            <div class="md:w-1/4 overflow-y-auto overflow-x-hidden max-h-screen pt-2 md:pt-0" style="height: 500px">
                @foreach ($vlplacelist as $vlplacelist)
                    <div class="mb-2">
                        <button type="button"
                            onclick="DisplayRoute({{ $vlplacelist['coordinates'][0] }},{{ $vlplacelist['coordinates'][1] }}, '{{ $vlplacelist['name'] }}')"
                            class="p-2 border-2 border-green-300 bg-green-300 text-zinc-600 py-1 w-full rounded-md hover:bg-transparent hover:text-green-700 font-semibold">{{ $vlplacelist['name'] }}</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('/components.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        var map = L.map('map').setView([10.246602, 105.971673], 11);
        // apikey =
        //     'https://maps.vietmap.vn/api/dm/{z}/{x}/{y}@2x.png?apikey=c3d0f188ff669f89042771a20656579073cffec5a8a69747';
        //Open Map
        // L.tileLayer('https://maps.vietmap.vn/tm/{z}/{x}/{y}.png?apikey=9cbf0bc15d3901b7e043d8f76be8d73f370a82fe629a2d46', {
        //     attribution: '&copy; <a href="https://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        // }).addTo(map);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        // $(document).ready(function() {
        //     if (navigator.geolocation) {
        //         navigator.geolocation.getCurrentPosition(function(position) {
        //             var latitude = position.coords.latitude;
        //             var longitude = position.coords.longitude;
        //             markers.forEach(function(marker) {
        //                 var newMarker = L.marker([latitude, longitude], {
        //                         icon: marker.icon
        //                     }).bindPopup(
        //                         '<p style="color: green; font-weight: bold"> Vị trí hiện tại </p>')
        //                     .addTo(map);
        //             });
        //             console.log('Latitude: ' + latitude);
        //             console.log('Longitude: ' + longitude);
        //             $.ajax({
        //                 url: 'https://maps.vietmap.vn/api/route?point=' + latitude + ',' +
        //                     longitude +
        //                     '&point=10.24289042956059,105.98461513620583&apikey=c3d0f188ff669f89042771a20656579073cffec5a8a69747',
        //                 type: 'get',
        //                 success: function(res) {
        //                     // console.log(res);
        //                     var colors = ['red', 'blue', 'green', 'yellow', 'orange'];
        //                     // var html = '<h2 class="title">Kết quả lộ trình</h2>';
        //                     for (var i = 0; i < res.paths.length; i++) {
        //                         var totalmeter = 0;
        //                         var num = Number(i + 1);
        //                         // var subhtml = '';
        //                         // subhtml += '<ul class="list">';
        //                         var instructions = res.paths[i].instructions;
        //                         // var points = res.paths[i].points.coordinates;
        //                         var points = res.paths[i].points;
        //                         console.log(points);
        //                         var polyline = L.Polyline.fromEncoded(points);
        //                         var coordinates = polyline.getLatLngs();
        //                         console.log(coordinates);
        //                     }

        //                     //draw line
        //                     var latlngs = [];

        //                     for (var k = 0; k < coordinates.length; k++) {
        //                         latlngs.push([coordinates[k].lat, coordinates[k].lng]);
        //                     }

        //                     var colorIdx = i % colors.length;
        //                     var polyline = L.polyline(latlngs, {
        //                         color: colors[colorIdx]
        //                     }).addTo(map);
        //                     // zoom the map to the polyline
        //                     map.fitBounds(polyline.getBounds());

        //                     var endIcon = L.icon({
        //                         iconUrl: 'https://cdn-icons-png.flaticon.com/512/2775/2775994.png',
        //                         iconSize: [35, 35], // size of the icon
        //                         iconAnchor: [17,
        //                             17
        //                         ], // point of the icon which will correspond to marker's location
        //                     });
        //                     var startIcon = L.icon({
        //                         iconUrl: 'https://cdn-icons-png.flaticon.com/512/2775/2775994.png',
        //                         iconSize: [35, 35], // size of the icon
        //                         iconAnchor: [17,
        //                             17
        //                         ], // point of the icon which will correspond to marker's location
        //                     });

        //                     L.marker(latlngs[0], {
        //                         icon: startIcon
        //                     }).addTo(map);
        //                     L.marker(latlngs[latlngs.length - 1], {
        //                         icon: endIcon
        //                     }).addTo(map);

        //                 }
        //             })
        //         });
        //     } else {
        //         console.log('Geolocation is not supported by this browser.');
        //     }
        // })
        // L.tileLayer(apikey, {
        //     attribution: '&copy; <a href="https://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        // }).addTo(map);
        // var greenIcon = L.icon({
        //     iconUrl: 'https://cdn-icons-png.flaticon.com/512/2775/2775994.png',

        //     iconSize: [35, 35], // size of the icon
        //     iconAnchor: [17, 17], // point of the icon which will correspond to marker's location
        //     popupAnchor: [0, -17] // point from which the popup should open relative to the iconAnchor
        // });

        var markers =
            {!! $vlplacecoordinate !!};

        var greenIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/2775/2775994.png',

            iconSize: [35, 35], // size of the icon
            iconAnchor: [17, 17], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -17] // point from which the popup should open relative to the iconAnchor
        });

        markers.forEach(function(marker) {
            var newMarker = L.marker(marker.coordinates, {
                icon: greenIcon
            }).bindPopup('<p style="color: green; font-weight: bold">' + marker.name + '</p>').addTo(map);
        });

        var previousPolyline = null;
        //Click button map 
        function DisplayRoute(latitude_place, longitude_place, name_place) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    // console.log('Latitude: ' + latitude);
                    // console.log('Longitude: ' + longitude);

                    var distance = geolib.getDistance({
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude
                    }, {
                        latitude: latitude_place,
                        longitude: longitude_place
                    });
                    console.log("Khoảng cách là: " + distance / 1000 + " km");

                    $.ajax({
                        url: 'https://maps.vietmap.vn/api/route?point=' + latitude + ',' +
                            longitude +
                            '&point=' + latitude_place + ',' + longitude_place +
                            '&apikey=c3d0f188ff669f89042771a20656579073cffec5a8a69747',
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
                                // console.log(points);
                                var polyline = L.Polyline.fromEncoded(points);
                                var coordinates = polyline.getLatLngs();
                                // console.log(coordinates);
                            }

                            //draw line
                            var latlngs = [];

                            for (var k = 0; k < coordinates.length; k++) {
                                latlngs.push([coordinates[k].lat, coordinates[k].lng]);
                            }

                            if (previousPolyline) {
                                map.removeLayer(previousPolyline);
                            }

                            var colorIdx = i % colors.length;
                            var polyline = L.polyline(latlngs, {
                                color: colors[colorIdx]
                            }).addTo(map);

                            previousPolyline = polyline;

                            //Test
                            var distanceTooltip = L.tooltip({
                                permanent: true,
                                direction: 'center',
                                className: 'distance-tooltip'
                            }).setContent(distance / 1000 + ' km');

                            polyline.bindTooltip(distanceTooltip).openTooltip();

                            // Zoom the map to the polyline and fit the polyline bounds
                            map.fitBounds(polyline.getBounds()).addLayer(polyline);
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
                                icon: startIcon,
                            }).bindPopup('<p style="color: green; font-weight: bold">' +
                                "Vị trí hiện tại" + '</p>').addTo(map);
                            L.marker(latlngs[latlngs.length - 1], {
                                icon: endIcon
                            }).bindPopup('<p style="color: green; font-weight: bold">' +
                                name_place + '</p>').addTo(map).openPopup();

                        }
                    })
                });
            } else {
                console.log('Geolocation is not supported by this browser.');
            }
        }


        //RateYo
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
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>

</html>
