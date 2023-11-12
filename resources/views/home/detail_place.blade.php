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

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
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
    <div class="md:p-2 md:container md:pt-6 md:px-16 mx-auto sm:w-750 md:w-970 lg:w-1170 ">
        <div class="block md:flex p-2">
            <div class="content md:w-3/4 w-full md:pr-2">
                @foreach ($detail_place as $detail_place)
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
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <p class="text-xl p-2"><i class="fas fa-map-marker-alt pr-2" style="color: #01913d;"></i>Tên
                                địa điểm:
                                {{ $detail_place->name_place }}
                            </p>
                            <p class="text-xl p-2"><i class="fas fa-money-bill pr-2" style="color: #01913d;"></i>Giá:
                                @if ($detail_place->id_price == 3000)
                                    <span>Miễn phí</span>
                                @elseif ($detail_place->id_price == 3001)
                                    <span>Có phí</span>
                                @endif
                            </p>
                            <p class="text-xl p-2"><i class="far fa-clock pr-2" style="color: #01913d;"></i></i>Mở
                                cửa: {{ $detail_place->start_time }}<i class="far fa-clock pr-2 pl-2"
                                    style="color: #01913d;"></i>Đóng cửa: {{ $detail_place->end_time }}</p>
                            <p class="text-xl p-2"><i class="fas fa-map-marked pr-2" style="color: #008f3a;"></i>Địa
                                chỉ: {{ $detail_place->address_place }}</p>
                            <p class="text-xl p-2"><i class="fas fa-phone-square-alt pr-2"
                                    style="color: #008f3a;"></i>Liên hệ: {{ $detail_place->phone_place }}</p>
                            <p class="text-xl p-2"><i class="fas fa-envelope pr-2" style="color: #008f3a;"></i>Email:
                                {{ $detail_place->email_contact_place }}</p>
                        </div>
                        <div class="p-2">
                            <p class="text-sm italic p-2">{!! $detail_place->describe_place !!}
                            </p>
                        </div>
                    </div>
                    <div class="center pt-2">
                        <div class="text-center font-bold">
                            <h3 class="text-xl p-2">Bản đồ</h3>
                        </div>
                        <span class="devider mb-2"></span>
                        <div id="map"></div>
                    </div>
                @endforeach
                <div class="center pt-2">
                    <div class="text-center font-bold">
                        <h3 class="text-xl p-2">Đánh giá địa điểm</h3>
                    </div>
                    <span class="devider mb-2"></span>
                    <div class="rating-box rounded-md shadow">
                        <div class="grid grid-cols-1 md:grid-cols-3 h-full md:h-56">
                            {{-- <div id="rateYo" style="height: 50px"></div> --}}
                            <div class="flex flex-col gap-2 justify-center text-center bg-neutral-100 rounded-l-lg">
                                <p class="text-2xl font-bold">Đánh giá trung bình</p>
                                <p class="text-4xl font-serif text-emerald-600 font-bold">
                                    {{ $ratingValue[0]->rating }}/5</p>
                                <div class="mx-auto" id="rateYo" data-rating="{{ $ratingValue[0]->rating }}"
                                    style="height: 50px">
                                </div>
                            </div>
                            <div class="col-span-2 flex flex-col justify-center border">
                                <ul class="mx-auto">
                                    <li class="flex">
                                        <p class="text-xl font-bold pr-20 grow">5
                                            Sao({{ $detailRatingValue[0]->count }})</p>
                                        <div id="rateYo1"></div>
                                    </li>
                                    <li class="flex">
                                        <p class="text-xl font-bold pr-20 grow">4
                                            Sao({{ $detailRatingValue[1]->count }})</p>
                                        <div id="rateYo2"></div>
                                    </li>
                                    <li class="flex">
                                        <p class="text-xl font-bold pr-20 grow">3
                                            Sao({{ $detailRatingValue[2]->count }})</p>
                                        <div id="rateYo3"></div>
                                    </li>
                                    <li class="flex">
                                        <p class="text-xl font-bold pr-20 grow">2
                                            Sao({{ $detailRatingValue[3]->count }})</p>
                                        <div id="rateYo4"></div>
                                    </li>
                                    <li class="flex">
                                        <p class="text-xl font-bold pr-20 grow">1
                                            Sao({{ $detailRatingValue[4]->count }})</p>
                                        <div id="rateYo5"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="border shadow p-2 mt-4 gap-2 table-data" style="height: 600px;">
                    @foreach ($listRating as $listRatings)
                        <div class="pb-2">
                            <p>{{ $listRatings->name }} and {{ $listRatings->place_ratings }}</p>
                            <div class="listRateYo" data-rating="{{ $listRatings->place_ratings }}"></div>
                        </div>
                    @endforeach
                    <div id="pagination-links" class="d-flex justify-content-center">
                        {{ $listRating->appends(request()->all())->links() }}
                    </div>
                </div> --}}
                <livewire:list-rating-place :idPlace="$detail_place->id_place" />
                <div wire:ignore>
                    <script>
                        $(function() {
                            $('.listRateYo').each(function() {
                                var rating = $(this).data('rating');
                                $(this).rateYo({
                                    rating: rating,
                                    readOnly: true,
                                    starWidth: "20px"
                                });
                            });
                        });
                    </script>
                </div>
            </div>
            <div class="content w-full md:w-1/4 pt-2 md:pt-0"
                style="align-self: flex-start; top: 0px; position: sticky">
                <div class="text-black text-left font-bold">
                    <h2>Địa điểm gần đây ({{ count($distances) }})</h2>
                </div>
                <hr class="mt-2" />
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
        //Open map
        // L.tileLayer('https://maps.vietmap.vn/tm/{z}/{x}/{y}.png?apikey=9cbf0bc15d3901b7e043d8f76be8d73f370a82fe629a2d46', {
        //     attribution: '&copy; <a href="https://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        // }).addTo(map);
        // L.tileLayer('https://maps.vietmap.vn/tm/{z}/{x}/{y}.png?apikey=c3d0f188ff669f89042771a20656579073cffec5a8a69747', {
        //     attribution: '&copy; <a href="https://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        // }).addTo(map);
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
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        $(function() {
            $("#rateYo1").rateYo({
                starWidth: "30px",
                rating: 5,
                fullStar: true,
                readOnly: true,
            });
            $("#rateYo2").rateYo({
                starWidth: "30px",
                rating: 4,
                fullStar: true,
                readOnly: true,
            });
            $("#rateYo3").rateYo({
                starWidth: "30px",
                rating: 3,
                fullStar: true,
                readOnly: true,
            });
            $("#rateYo4").rateYo({
                starWidth: "30px",
                rating: 2,
                fullStar: true,
                readOnly: true,
            });
            $("#rateYo5").rateYo({
                starWidth: "30px",
                rating: 1,
                fullStar: true,
                readOnly: true,
            });
            $("#rateYo").rateYo({
                rating: $("#rateYo").data("rating"),
                starWidth: "30px",
                fullStar: true,
                readOnly: true,
            });
        });
        // $(".listRateYo").each(function() {
        //     var ratingValue = $(this).data("rating");
        //     $(this).rateYo({
        //         starWidth: "20px",
        //         rating: ratingValue,
        //         fullStar: true,
        //         readOnly: true,
        //         // Các thuộc tính khác nếu cần
        //     });
        // });
    </script>
    @livewireScripts
</body>

</html>
