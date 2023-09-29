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
            <li class="nav"><a href="/autosearch">Auto Search</a></li>
        </ul>
    </div>
    <div class="center row">
        <div id="left-menu" class="col col-lg-2 col-md-3"></div>
        <div class="col col-lg-10 col-md-9" id="map"></div>
    </div>
    <script>
        var map = L.map('map').setView([10.045365, 105.780324], 14);

        L.tileLayer('https://maps.vietmap.vn/tm/{z}/{x}/{y}.png?apikey=9cbf0bc15d3901b7e043d8f76be8d73f370a82fe629a2d46', {
            attribution: '&copy; <a href="http://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        }).addTo(map);

        $(document).ready(function() {
            $.ajax({

                url: 'https://maps.vietmap.vn/api/route?point=10.045365,105.780324&point=10.030315,105.771931&apikey=9cbf0bc15d3901b7e043d8f76be8d73f370a82fe629a2d46',
                type: 'get',
                success: function(res) {
                    var colors = ['red', 'blue', 'green', 'yellow', 'orange'];
                    var html = '<h2 class="title">Kết quả lộ trình</h2>';
                    for (var i = 0; i < res.paths.length; i++) {
                        var totalmeter = 0;
                        var num = Number(i + 1);
                        var subhtml = '';
                        subhtml += '<ul class="list">';
                        var instructions = res.paths[i].instructions;
                        var points = res.paths[i].points.coordinates;
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

                    for (var j = 0; j < points.length; j++) {
                        latlngs.push([points[j][1], points[j][0]]);
                    }
                    var colorIdx = 5 % i;
                    var polyline = L.polyline(latlngs, {
                        color: colors[colorIdx]
                    }).addTo(map);
                    // zoom the map to the polyline
                    map.fitBounds(polyline.getBounds());

                    var endIcon = L.icon({
                        iconUrl: 'https://github.com/vietmap-company/maps-api-demo/blob/master/endmarker.png?raw=true',
                        iconAnchor: [32, 32]
                    });
                    var startIcon = L.icon({
                        iconUrl: 'https://github.com/vietmap-company/maps-api-demo/blob/master/startmarker.png?raw=true',
                        iconAnchor: [32, 32]
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
