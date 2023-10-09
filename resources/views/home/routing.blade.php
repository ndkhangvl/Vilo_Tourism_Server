<html>

<head>
    <title>
        Demo Map Api-Vietmap
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>

    <script
        src="
                                                                                                                                                            https://cdn.jsdelivr.net/npm/polyline-encoded@0.0.9/Polyline.encoded.min.js
                                                                                                                                                            ">
    </script>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .top {
            position: absolute;
            height: 50px;
            left: 0;
            right: 0;
            background: gray;
        }

        .center {
            position: absolute;
            right: 0;
            left: 0;
            top: 50px;
            bottom: 0
        }

        #map {
            width: 100%;
            height: 100%;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        li.nav {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 13px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111111;
        }

        #left-menu {
            height: 100%;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        #left-menu>.title {
            margin-bottom: 15px;
        }

        #left-menu h2,
        h3,
        h4 {
            padding-left: 15px;
        }

        li.list-item {
            border-top: dashed 1px darkblue;
            padding-left: 15px;
        }

        li.list-item p {
            margin-bottom: 5px !important;
        }

        li.active {
            background-color: darkgreen;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="top">
        <ul>
            <li class="nav"><a href="tilemap.html">Bản đồ nền</a></li>
            <li class="nav active"><a href="routing.html">Dẫn đường qua 2 điểm</a></li>
            <li class="nav"><a href="routingmulti.html">Dẫn đường qua nhiều điểm</a></li>
            <li class="nav"><a href="autosearch.html">Auto Search</a></li>
        </ul>
    </div>
    <div class="center row">
        <div id="left-menu" class="col col-lg-2 col-md-3"></div>
        <div class="col col-lg-10 col-md-9" id="map"></div>
    </div>
    <script>
        var map = L.map('map').setView([10.758810, 106.681450], 14);

        L.tileLayer('https://maps.vietmap.vn/tm/{z}/{x}/{y}.png?apikey=c3d0f188ff669f89042771a20656579073cffec5a8a69747', {
            attribution: '&copy; <a href="http://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        }).addTo(map);

        // document.addEventListener('DOMContentLoaded', function() {
        //     var encodedPolyline =
        //         "evu`Acq|iSi@aAg@}@EEe@{@Wc@[k@OUOWIOOYIOKSe@y@IOKQa@u@e@u@U_@}@_Ba@u@{@wACYEo@HY@SRYRWVSf@Un@]dAk@~@k@z@g@xBsAbAo@`Ao@f@[x@i@h@]n@a@pDaC~ByAdAo@fC}ARIt@CXAZ?JAb@?f@?t@AX?`@AZ?n@AlDC|@?T?|AAvA?`BGUsBOgBMeABMe@oDUiBEYSwAK@Fb@";

        //     var decodedPolyline = L.Polyline.fromEncoded(encodedPolyline);

        //     var coordinates = decodedPolyline.getLatLngs(); // Get an array of LatLng objects

        //     console.log('Number of Coordinates: ' + coordinates.length);

        //     for (var i = 0; i < coordinates.length; i++) {
        //         var lat = coordinates[i].lat;
        //         var lng = coordinates[i].lng;

        //         console.log('Latitude: ' + lat);
        //         console.log('Longitude: ' + lng);
        //     }
        // });

        $(document).ready(function() {
            $.ajax({
                url: 'https://maps.vietmap.vn/api/route?point=10.765963,106.647366&point=10.758258,106.660445&apikey=c3d0f188ff669f89042771a20656579073cffec5a8a69747',
                type: 'get',
                success: function(res) {
                    // console.log(res);
                    var colors = ['red', 'blue', 'green', 'yellow', 'orange'];
                    var html = '<h2 class="title">Kết quả lộ trình</h2>';
                    for (var i = 0; i < res.paths.length; i++) {
                        var totalmeter = 0;
                        var num = Number(i + 1);
                        var subhtml = '';
                        subhtml += '<ul class="list">';
                        var instructions = res.paths[i].instructions;
                        // var points = res.paths[i].points.coordinates;
                        var points = res.paths[i].points;
                        console.log(points);
                        var polyline = L.Polyline.fromEncoded(points);
                        var coordinates = polyline.getLatLngs();
                        console.log(coordinates);

                        for (var j = 0; j < instructions.length - 1; j++) {
                            totalmeter += instructions[j].distance;
                            subhtml += '<li class="list-item">';
                            subhtml += '<p><b>Chiều dài: </b>' + instructions[j].distance + ' m</p>';
                            subhtml += '<p><b>Thời gian: </b>' + instructions[j].time + ' s</p>';
                            if (instructions[j].heading) {
                                subhtml += '<p><b>Hướng: </b>' + instructions[j].heading +
                                    '<sup>o</sup></p>';
                            }
                            subhtml += '<p><i>' + instructions[j].text + '</i></p>';
                            subhtml += '<p><b>Đường: </b>' + instructions[j].street_name + '</p>';
                            subhtml += '</li>';
                        }
                        subhtml += '</ul>';

                        subhtml = '<h4>Lộ trình thứ ' + num + '(tổng ' + totalmeter.toFixed(2) +
                            ' m)</h4>' + subhtml;
                        html += subhtml;
                    }

                    $('#left-menu').html(html);

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
        })
    </script>
</body>

</html>
