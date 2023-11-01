<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chi tiết địa diểm</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/polyline-encoded@0.0.9/Polyline.encoded.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/geolib@3.3.4/lib/index.min.js"></script>
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
            @foreach ($detail_place as $detail_place)
                <div class="content w-3/4 pr-2">
                    <div class="pb-2 relative">
                        <img class="rounded-t-lg object-containt w-full" style="height:500px"
                            src="{{ $detail_place->image_url }}">
                        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                            <h1 class="text-4xl p-4 font-bold uppercase">{{ $detail_place->name_place }}</h1>
                        </div>
                    </div>
                    <div class="shadow border-2 pt-6">
                        <div class="text-center font-bold">
                            <h3 class="text-xl p-2">Giới thiệu</h3>
                        </div>
                        <span class="devider"></span>
                        <div class="grid grid-cols-2 gap-2">
                            <h1 class="text-xl p-2"><i class="fas fa-map-marker-alt pr-2"
                                    style="color: #01913d;"></i>Tên địa điểm:
                                {{ $detail_place->name_place }}
                            </h1>
                            <h1 class="text-xl p-2"><i class="fas fa-money-bill pr-2" style="color: #01913d;"></i>Giá:
                                @if ($detail_place->id_price == 3000)
                                    <span>Miễn phí</span>
                                @elseif ($detail_place->id_price == 3001)
                                    <span>Có phí</span>
                                @endif
                            </h1>
                            <h1 class="text-xl p-2"><i class="far fa-clock pr-2" style="color: #01913d;"></i></i>Mở
                                cửa: {{ $detail_place->start_time }}<i class="far fa-clock pr-2 pl-2"
                                    style="color: #01913d;"></i>Đóng cửa: {{ $detail_place->end_time }}</h1>
                            <h1 class="text-xl p-2"><i class="fas fa-map-marked pr-2" style="color: #008f3a;"></i>Địa
                                chỉ: {{ $detail_place->address_place }}</h1>
                            <h1 class="text-xl p-2"><i class="fas fa-phone-square-alt pr-2"
                                    style="color: #008f3a;"></i>Liên hệ: {{ $detail_place->phone_place }}</h1>
                            <h1 class="text-xl p-2"><i class="fas fa-envelope pr-2" style="color: #008f3a;"></i>Email:
                                {{ $detail_place->email_contact_place }}</h1>
                        </div>
                        <div class="p-2">
                            <p class="text-sm italic p-2">{!! $detail_place->describe_place !!}
                            </p>
                        </div>
                    </div>
                    <div class="center pt-2">
                        <div id="map"></div>
                    </div>
                </div>
            @endforeach
            <div class="content border-2 shadow w-1/4">
                <div class="bg-yellow-500 text-center text-white font-bold">
                    <h2><i class="fas fa-home pr-2"></i>Địa điểm gần đây</h2>
                </div>
                <div class="p-2">
                    @foreach ($distances as $distance)
                        <div class="relative mb-4">
                            <a href="/detailplace/{{ $distance['id'] }}">
                                <img src="{{ $distance['image_url'] }}" alt="Image"
                                    class="object-cover w-full h-full" style="height: 200px;">
                            </a>
                            <div
                                class="absolute bottom-0 left-0 w-full bg-gray-500 bg-opacity-50 text-white text-center">
                                <h1 class="xl:text-sm max-sm:text-xs">{{ $distance['name_place'] }}</h1>
                                <h1 class="xl:text-sm max-sm:text-xs">{{ $distance['distance'] }}km</h1>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
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
        // console.log($distances);
        $(document).ready(function() {
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
                        latitude: {{ $detail_place->latitude }},
                        longitude: {{ $detail_place->longitude }}
                    });
                    console.log("Khoảng cách là: " + distance / 1000 + " km");

                    $.ajax({
                        url: 'https://maps.vietmap.vn/api/route?point=' + latitude + ',' +
                            longitude +
                            '&point=' + {{ $detail_place->latitude }} + ',' +
                            {{ $detail_place->longitude }} +
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

                            var colorIdx = i % colors.length;
                            var polyline = L.polyline(latlngs, {
                                color: colors[colorIdx]
                            }).addTo(map);

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
                                "{{ $detail_place->name_place }}" + '</p>').addTo(map);

                        }
                    })
                });
            } else {
                console.log('Geolocation is not supported by this browser.');
            }
        })
    </script>
</body>

</html>
