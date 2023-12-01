<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('msg.detail_place') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/polyline-encoded@0.0.9/Polyline.encoded.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/geolib@3.3.4/lib/index.min.js"></script>

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    {{-- <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script> --}}
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

        .owl-carousel .item img {
            width: 100%;
            height: 300px;
            /* Set a fixed height */
            object-fit: cover;
            /* Maintain aspect ratio */
        }

        .owl-carousel .item {
            width: 250px;
            /* Set a fixed width */
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
                            src="{{ !empty($detail_place->image_url) ? $detail_place->image_url : 'https://vinhlongtourist.vn/Images/NoImage/Transparency/NoImage400x266.png' }}">
                        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center">
                            <h1 class="text-4xl p-4 font-bold uppercase">{{ $detail_place->name_place }}</h1>
                        </div>
                    </div>
                    <div class="shadow border-2 pt-6">
                        <div class="text-center font-bold">
                            <h3 class="text-xl p-2">{{ trans('msg.introduction') }}</h3>
                        </div>
                        <span class="devider"></span>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <p class="text-xl p-2"><i class="fas fa-map-marker-alt pr-2"
                                    style="color: #01913d;"></i>{{ trans('msg.name_place') }}:
                                {{ $detail_place->name_place }}
                            </p>
                            <p class="text-xl p-2"><i class="fas fa-money-bill pr-2"
                                    style="color: #01913d;"></i>{{ trans('msg.price') }}:
                                @if ($detail_place->id_price == 3000)
                                    <span>{{ trans('msg.price_free') }}</span>
                                @elseif ($detail_place->id_price == 3001)
                                    <span>{{ trans('msg.price_nofree') }}</span>
                                @endif
                            </p>
                            <p class="text-xl p-2"><i class="far fa-clock pr-2"
                                    style="color: #01913d;"></i></i>{{ trans('msg.start_time') }}:
                                {{ $detail_place->start_time }}<i class="far fa-clock pr-2 pl-2"
                                    style="color: #01913d;"></i>{{ trans('msg.end_time') }}:
                                {{ $detail_place->end_time }}</p>
                            <p class="text-xl p-2"><i class="fas fa-map-marked pr-2"
                                    style="color: #008f3a;"></i>{{ trans('msg.address') }}:
                                {{ $detail_place->address_place }}</p>
                            <p class="text-xl p-2"><i class="fas fa-phone-square-alt pr-2"
                                    style="color: #008f3a;"></i>{{ trans('msg.contact_phone') }}:
                                {{ $detail_place->phone_place }}</p>
                            <p class="text-xl p-2"><i class="fas fa-envelope pr-2"
                                    style="color: #008f3a;"></i>{{ trans('msg.email_contact') }}:
                                {{ $detail_place->email_contact_place }}</p>
                        </div>
                        <div class="p-2">
                            <p class="text-sm italic p-2">{!! $detail_place->describe_place !!}
                            </p>
                        </div>
                    </div>
                    <div class="center pt-2">
                        <div class="text-center font-bold">
                            <h3 class="text-xl p-2">{{ trans('msg.map') }}</h3>
                        </div>
                        <span class="devider mb-2"></span>
                        <div id="map"></div>
                    </div>
                    {{-- Rating Place Form --}}
                    @if (Auth::check())
                        <form method="POST" action="/rating-place" role="form" id="formRating">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" class="form-contrl" name="place_rating" id="place_rating">
                                <input type="hidden" class="form-contrl" name="id_user"
                                    value="{{ Auth::user()->id }}">
                                <input type="hidden" class="form-contrl" name="id_place"
                                    value="{{ $detail_place->id_place }}">
                            </div>
                        </form>
                    @endif
                @endforeach
                <div class="center pt-2">
                    <div class="text-center font-bold">
                        <h3 class="text-xl p-2">{{ trans('msg.rating_place') }}</h3>
                    </div>
                    <span class="devider mb-2"></span>
                    <div class="rating-box rounded-md shadow">
                        <div class="grid grid-cols-1 md:grid-cols-3 h-full md:h-56">
                            {{-- <div id="rateYo" style="height: 50px"></div> --}}
                            <div class="flex flex-col gap-2 justify-center text-center bg-neutral-100 rounded-l-lg">
                                <p class="text-2xl font-bold">{{ trans('msg.rating_avg') }}</p>
                                <p class="text-4xl font-sans text-emerald-600 font-bold">
                                    {{ $ratingValue[0]->rating }}/5.0</p>
                                <div class="mx-auto" id="rateYo" data-rating="{{ $ratingValue[0]->rating }}"
                                    style="height: 50px">
                                </div>
                            </div>
                            <div class="col-span-2 flex flex-col justify-center border">
                                <ul class="mx-auto">
                                    <li class="flex">
                                        <p class="text-xl font-bold pr-20 grow">5
                                            {{ trans('msg.star') }}({{ $detailRatingValue[4]->count ?? 0 }})</p>
                                        <div id="rateYo1"></div>
                                    </li>
                                    <li class="flex">
                                        <p class="text-xl font-bold pr-20 grow">4
                                            {{ trans('msg.star') }}({{ $detailRatingValue[3]->count ?? 0 }})</p>
                                        <div id="rateYo2"></div>
                                    </li>
                                    <li class="flex">
                                        <p class="text-xl font-bold pr-20 grow">3
                                            {{ trans('msg.star') }}({{ $detailRatingValue[2]->count ?? 0 }})</p>
                                        <div id="rateYo3"></div>
                                    </li>
                                    <li class="flex">
                                        <p class="text-xl font-bold pr-20 grow">2
                                            {{ trans('msg.star') }}({{ $detailRatingValue[1]->count ?? 0 }})</p>
                                        <div id="rateYo4"></div>
                                    </li>
                                    <li class="flex">
                                        <p class="text-xl font-bold pr-20 grow">1
                                            {{ trans('msg.star') }}({{ $detailRatingValue[0]->count ?? 0 }})</p>
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
                <div class="pt-2">
                    @if (Auth::check())
                        @if ($userHasReview == true)
                            {{-- <button onclick="expandDiv()"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                            Bạn đã sửa rồi bạn có muốn sửa đánh giá
                        </button> --}}
                            <div class="border p-4" id="myDiv">
                                <p class="mb-4 text-xl text-green-700 font-bold italic">{{ trans('msg.fix_rating') }}
                                </p>
                                <div id="feedbackText" class="text-center text-2xl italic font-bold"></div>
                                <div id="rateYo-rating1" class="mt-2 mx-auto mb-2"></div>
                            </div>
                        @else
                            <div class="mb-4 p-2">
                                <label for="username"
                                    class="block text-gray-700 text-sm font-bold mb-2">{{ trans('msg.pls_rating') }}</label>
                                <div class="flex p-2">
                                    <div class="l-list-rating">
                                        <div
                                            class="inline-flex rounded-full bg-slate-300 text-white w-12 h-12 items-center justify-center">
                                            <span
                                                class="text-md font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                        </div>
                                    </div>
                                    <div class="w-full ml-5">
                                        <div class="relative border shadow">
                                            <div id="feedbackText" class="text-center text-2xl italic font-bold">
                                            </div>
                                            {{-- <input type="text" id="username" name="username"
                                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"> --}}

                                            <div id="rateYo-rating" class="mt-2 mx-auto mb-2">
                                                <!-- Your rating widget goes here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div>
                            <button id="openLoginRegisterModalButton"
                                class="bg-green-700 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">
                                {{ trans('msg.login_modal') }}
                            </button>
                        </div>
                    @endif
                </div>
                <livewire:list-rating-place :idPlace="$detail_place->id_place" />
                <div class="text-center font-bold">
                    <h3 class="text-xl p-2">{{ trans('msg.same_place') }}</h3>
                </div>
                <span class="devider mb-2"></span>
                <div class="border shadow p-2">
                    <div id="banner-thumbs-link" class="owl-carousel owl-loaded owl-drag">
                        @foreach ($responseData2 as $responseData2)
                            {{-- <div class="item relative mb-4 flex-shrink-0">
                            <a href="/detailplace/{{ $responseData2['id'] }}">
                                <img src="{{ $responseData2['image_url'] }}" alt="Image" class="">
                            </a>
                            <div
                                class="absolute bottom-0 left-0 w-full bg-gray-500 bg-opacity-50 text-white text-center">
                                <h1 class="xl:text-sm max-sm:text-xs">{{ $distance['name_place'] }}</h1>
                                <h1 class="xl:text-sm max-sm:text-xs">{{ $distance['distance'] }}km</h1>
                            </div>
                        </div> --}}
                            <div class="relative rounded overflow-hidden">
                                <a href="/detailplace/{{ $responseData2['id_place'] }}" target="_blank">
                                    <img class="w-full" style="height: 300px"
                                        src="{{ $responseData2['image_url'] }}" />
                                </a>
                                <p
                                    class="absolute bg-gray-600 bg-opacity-50 text-white text-center inset-x-0 bottom-0">
                                    {{ $responseData2['name_place'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="content w-full md:w-1/4 pt-2 md:pt-0"
                style="align-self: flex-start; top: 0px; position: sticky">
                <div class="text-black text-left font-bold">
                    <h2>{{ trans('msg.near_place') }} ({{ count($distances) }})</h2>
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
        {{-- Modal Login or Register --}}
        <div id="loginRegisterModal" class="hidden fixed inset-0 overflow-auto bg-black bg-opacity-50"
            style="z-index: 1000">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white w-full max-w-md rounded-md shadow-lg">
                    <div class="flex justify-end p-2">
                        <button type="button" id="closeLoginRegisterModalButton" class=""><i
                                class="fas fa-times fa-lg" style="width: 20px; heigth: 20px"></i></button>
                    </div>
                    <div class="grid grid-cols-2 mt-2">
                        <button id="showLoginTab"
                            class="p-2 text-blue-500 focus:outline-none hover:bg-blue-300 hover:text-black">{{ trans('msg.login') }}</button>
                        <button id="showRegisterTab"
                            class="p-2 text-blue-500 focus:outline-none hover:bg-blue-300 hover:text-black">{{ trans('msg.register') }}</button>
                    </div>
                    <div class="p-5">
                        <div id="loginTab" class="tab-content">
                            <form method="POST" action="/login" id="sendLogin">
                                @csrf
                                <div class="w-96 bg-white rounded-md">
                                    {{-- <h1 class="text-3xl block text-center font-semibold"><i class="fa-solid fa-user"></i>
                                    Login</h1> --}}
                                    {{-- <hr class="mt-3"> --}}
                                    <div class="mt-3">
                                        <label for="username" class="block text-base mb-2">{{ trans('msg.email') }}
                                            (<span class="text-rose-600">*</span>)</label>
                                        <input type="text" id="email" name="email"
                                            class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600"
                                            placeholder="Nhập vào mail..." />
                                        <span class="text-bold text-red-700" id="email_error"></span>
                                    </div>
                                    <div class="mt-3">
                                        <label for="password"
                                            class="block text-base mb-2">{{ trans('msg.password') }} (<span
                                                class="text-rose-600">*</span>)</label></label>
                                        <input type="password" id="password" name="password"
                                            class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600"
                                            placeholder="Nhập vào mật khẩu..." oninput="" />
                                        <span class="text-bold text-red-700" id="password_error"></span>
                                    </div>
                                    <div class="mt-3 flex justify-between items-center">
                                        <div>
                                            <a href="#"
                                                class="text-indigo-800 font-semibold">{{ trans('msg.forgotpassword') }}</a>
                                        </div>
                                    </div>
                                    <div class="flex mt-5">
                                        <button type="submit"
                                            class="border-2 border-indigo-700 bg-indigo-700 text-white py-1 w-full rounded-md hover:bg-transparent hover:text-indigo-700 font-semibold"><i
                                                class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;{{ trans('msg.login') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="registerTab" class="tab-content hidden">
                            <!-- Register form content -->
                            <form method="POST" action="/register" id="sendRegister">
                                @csrf
                                <div class="w-96 bg-white rounded-md">
                                    <div class="mt-3">
                                        <label for="username" class="block text-base mb-2">{{ trans('msg.uname') }}
                                            (<span class="text-rose-600">*</span>)</label></label>
                                        <input type="text" id="name_register" name="name_register"
                                            class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600"
                                            placeholder="Nhập vào tên..." />
                                        <span class="text-bold text-red-700" id="name_register_error"></span>
                                    </div>
                                    <div class="mt-3">
                                        <label for="username" class="block text-base mb-2">{{ trans('msg.email') }}
                                            (<span class="text-rose-600">*</span>)</label></label>
                                        <input type="text" id="email_register" name="email_register"
                                            class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600"
                                            placeholder="Nhập vào mail..." />
                                        <span class="text-bold text-red-700" id="email_register_error"></span>
                                    </div>
                                    <div class="mt-3">
                                        <label for="password"
                                            class="block text-base mb-2">{{ trans('msg.password') }} (<span
                                                class="text-rose-600">*</span>)</label></label>
                                        <input type="password" id="password_register" name="password_register"
                                            class="border w-full text-base px-2 py-1 focus:outline-none focus:ring-0 focus:border-gray-600"
                                            placeholder="Nhập vào mật khẩu..." />
                                        <span class="text-bold text-red-700" id="password_register_error"></span>
                                    </div>
                                    <div class="flex mt-5">
                                        <button type="submit"
                                            class="border-2 border-indigo-700 bg-indigo-700 text-white py-1 w-full rounded-md hover:bg-transparent hover:text-indigo-700 font-semibold"><i
                                                class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;{{ trans('msg.register') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('/components.footer')
    <script>
        var map = L.map('map').setView([10.246602, 105.971673], 14);
        // L.tileLayer('https://maps.vietmap.vn/tm/{z}/{x}/{y}.png?apikey=9cbf0bc15d3901b7e043d8f76be8d73f370a82fe629a2d46', {
        //     attribution: '&copy; <a href="https://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        // }).addTo(map);

        //Open map
        // L.tileLayer('https://maps.vietmap.vn/tm/{z}/{x}/{y}.png?apikey=9cbf0bc15d3901b7e043d8f76be8d73f370a82fe629a2d46', {
        //     attribution: '&copy; <a href="https://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        // }).addTo(map);
        // L.tileLayer('https://maps.vietmap.vn/tm/{z}/{x}/{y}.png?apikey=c3d0f188ff669f89042771a20656579073cffec5a8a69747', {
        //     attribution: '&copy; <a href="https://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        // }).addTo(map);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
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
                                var instructions = res.paths[i].instructions;

                                var points = res.paths[i].points;
                                var polyline = L.Polyline.fromEncoded(points);
                                var coordinates = polyline.getLatLngs();
                            }

                            // Draw the route based on information taken from the Directions API
                            // Vẽ đường dựa trên các thông tin được lấy từ API chỉ đường 
                            var latlngs = [];

                            for (var k = 0; k < coordinates.length; k++) {
                                latlngs.push([coordinates[k].lat, coordinates[k].lng]);
                            }

                            var colorIdx = i % colors.length;
                            var polyline = L.polyline(latlngs, {
                                color: colors[colorIdx]
                            }).addTo(map);

                            // Add the distance from your current location to the destination in the middle of the directions
                            // Thêm số khoảng cách từ vị trí hiện tại đến địa điểm vào giữa hướng dẫn chỉ đường đi
                            var distanceTooltip = L.tooltip({
                                permanent: true,
                                direction: 'center',
                                className: 'distance-tooltip'
                            }).setContent(distance / 1000 + ' km');

                            polyline.bindTooltip(distanceTooltip).openTooltip();

                            // Zoom the map to the polyline and fit the polyline bounds
                            // Phóng to map khớp với đường polyline vừa vẽ
                            map.fitBounds(polyline.getBounds()).addLayer(polyline);
                            var endIcon = L.icon({
                                iconUrl: 'https://cdn-icons-png.flaticon.com/512/2775/2775994.png',
                                iconSize: [35, 35], // size of the icon
                                iconAnchor: [17,
                                    17
                                ],
                            });
                            var startIcon = L.icon({
                                iconUrl: 'https://cdn-icons-png.flaticon.com/512/2775/2775994.png',
                                iconSize: [35, 35], // size of the icon
                                iconAnchor: [17,
                                    17
                                ],
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
                console.log('Geolocation không hỗ trợ bởi trình duyệt.');
            }
        })
    </script>
    <!-- Latest compiled and minified JavaScript -->
    <!-- Owl Carousel JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                center: true,
                items: 2,
                dots: false,
                loop: true,
                margin: 5,
                responsive: {
                    600: {
                        items: 4
                    }
                }
            });
        })

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
                // fullStar: true,
                readOnly: true,
            });
        });
        $(function() {
            var rateYoInstance = $("#rateYo-rating1").rateYo({
                starWidth: "40px",
                rating: 0,
                fullStar: true,
                spacing: "10px",
            });


            var initialRating = {{ $userReview[0]->place_ratings ?? 0 }};
            rateYoInstance.rateYo("rating", initialRating);

            // Display feedbackText for the initial rating
            var initialFeedbackText = getFeedbackText(initialRating);
            $("#feedbackText").text(initialFeedbackText);

            rateYoInstance.on("rateyo.set", function(e, data) {
                $('#place_rating').val(data.rating);
                $('#formRating').submit();
            }).on("rateyo.change", function(e, data) {
                // Hiển thị văn bản khi rê vào
                var rating = data.rating;
                var feedbackText = getFeedbackText(rating);

                // Hiển thị văn bản phản hồi
                $("#feedbackText").text(feedbackText);
            });
        });

        //Ajax for Rating Place
        $(document).ready(function() {
            $(document).on('submit', '#formRating', function(event) {
                event.preventDefault();
                var csrfToken = $('input[name="_token"]').val();
                // Lấy dữ liệu từ form
                var formData = new FormData(this);
                // var ckEditorData = myEditorSend.getData();
                // formData.append('describe_edit_place', ckEditorData);
                Swal.fire({
                    title: '{{ trans('msg.want_rating') }}',
                    // text: "Thông tin địa điểm " + $('#name_edit_place').val() +
                    //     " sẽ được chỉnh sửa!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#35A745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '{{ trans('msg.confirm') }}',
                    cancelButtonText: '{{ trans('msg.cancel') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: '{{ trans('msg.process') }}',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            onBeforeOpen: () => {
                                Swal.showLoading();
                            },
                            onClose: () => {
                                Swal.hideLoading();
                            }
                        });
                        $.ajax({
                            url: '/rating-place',
                            data: formData,
                            type: 'POST',
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                Swal.showLoading();
                            },
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function(response) {
                                Swal.close();
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: '{{ trans('msg.successful') }}',
                                        text: '{{ trans('msg.succes_place') }}'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: '{{ trans('msg.cannot_place') }}',
                                        text: '{{ trans('msg.have_error') }}'
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.close();
                                Swal.fire({
                                    icon: 'error',
                                    title: '{{ trans('msg.error') }}',
                                    text: '{{ trans('msg.have_error2') }}'
                                });
                                if (xhr.status === 422) {
                                    $('.invalid-feedback').empty();
                                    var response = JSON.parse(xhr.responseText);
                                    var errors = response.errors;
                                    for (var field in errors) {
                                        if (errors.hasOwnProperty(field)) {
                                            var errorMessage = errors[field][0];
                                            $('#' + field + '_error').text(errorMessage)
                                                .show();
                                        }
                                    }
                                }
                            }
                        });
                    }
                });
            });
        });

        //Ajax for login
        $(document).ready(function() {
            $(document).on('submit', '#sendLogin', function(event) {
                event.preventDefault();
                var csrfToken = $('input[name="_token"]').val();
                // Lấy dữ liệu từ form
                var formData = new FormData(this);
                $.ajax({
                    url: '/login',
                    data: formData,
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        Swal.showLoading();
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: '{{ trans('msg.successful') }}',
                            text: '{{ trans('msg.success_login') }}'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.close();
                        if (xhr.status === 422) {
                            $('.invalid-feedback').empty();
                            var response = JSON.parse(xhr.responseText);
                            var errors = response.errors;
                            for (var field in errors) {
                                if (errors.hasOwnProperty(field)) {
                                    var errorMessage = errors[field][0];
                                    $('#' + field + '_error').text(errorMessage)
                                        .show();
                                }
                            }
                        }
                    }
                });
            });
        });

        //Ajax for register
        $(document).ready(function() {
            $(document).on('submit', '#sendRegister', function(event) {
                event.preventDefault();
                var csrfToken = $('input[name="_token"]').val();
                // Lấy dữ liệu từ form
                var formData = new FormData(this);
                $.ajax({
                    url: '/register',
                    data: formData,
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        Swal.showLoading();
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        Swal.close();
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '{{ trans('msg.successful') }}',
                                text: '{{ trans('msg.success_register') }}'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: '{{ trans('msg.error_place') }}',
                                text: '{{ trans('msg.have_error') }}'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        if (xhr.status === 422) {
                            $('.invalid-feedback').empty();
                            var response = JSON.parse(xhr.responseText);
                            var errors = response.errors;
                            for (var field in errors) {
                                if (errors.hasOwnProperty(field)) {
                                    var errorMessage = errors[field][0];
                                    $('#' + field + '_error').text(errorMessage)
                                        .show();
                                }
                            }
                        }
                    }
                });
            });
        });
        document.getElementById('showLoginTab').addEventListener('click', function() {
            document.getElementById('loginTab').classList.remove('hidden');
            document.getElementById('registerTab').classList.add('hidden');
            document.getElementById('showLoginTab').classList.add('border-b-4');
            document.getElementById('showRegisterTab').classList.remove('border-b-4');
        });

        document.getElementById('showRegisterTab').addEventListener('click', function() {
            document.getElementById('loginTab').classList.add('hidden');
            document.getElementById('registerTab').classList.remove('hidden');
            document.getElementById('showRegisterTab').classList.add('border-b-4');
            document.getElementById('showLoginTab').classList.remove('border-b-4');
        });

        // JavaScript to show and hide the modal
        document.getElementById('openLoginRegisterModalButton').addEventListener('click', function() {
            document.getElementById('loginRegisterModal').classList.remove('hidden');
            document.getElementById('loginTab').classList.remove('hidden');
            document.getElementById('registerTab').classList.add('hidden');
            document.getElementById('showLoginTab').classList.add('border-b-4');
            document.getElementById('showRegisterTab').classList.remove('border-b-4');
        });

        document.getElementById('closeLoginRegisterModalButton').addEventListener('click', function() {
            document.getElementById('loginRegisterModal').classList.add('hidden');
        });

        function checkOldPassword() {
            // Thực hiện kiểm tra validate cho mật khẩu cũ và cập nhật thông báo lỗi
            var oldPassword = document.getElementById('old_password').value;
            // Thêm logic kiểm tra và hiển thị thông báo lỗi
            // Ví dụ: (chỉ để minh họa)
            if (oldPassword.length < 6 || oldPassword.length > 50) {
                document.getElementById('old_password_error').innerText = 'Mật khẩu cũ phải có ít nhất 8 ký tự.';
            } else {
                document.getElementById('old_password_error').innerText = '';
            }
        }

        function checkNewPassword() {
            // Thực hiện kiểm tra validate cho mật khẩu cũ và cập nhật thông báo lỗi
            var newPassword = document.getElementById('new_password').value;
            // Thêm logic kiểm tra và hiển thị thông báo lỗi
            // Ví dụ: (chỉ để minh họa)
            if (newPassword.length < 6 || newPassword.length > 50) {
                document.getElementById('new_password_error').innerText = 'Mật khẩu mới phải có ít nhất 8 ký tự.';
            } else {
                document.getElementById('new_password_error').innerText = '';
            }
        }

        function checkConfirmPassword() {
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            if (confirmPassword !== newPassword) {
                document.getElementById('confirm_password_error').innerText = 'Không khớp với mật khẩu mới.';
            } else {
                document.getElementById('confirm_password_error').innerText = '';
            }
        }
    </script>
    @livewireScripts
</body>

</html>
