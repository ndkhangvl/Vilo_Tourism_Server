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
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>

    <style>
        body {
            margin: 0;
            padding: 0;
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
            background-color: #333333;
        }

        li {
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

        li.active {
            background-color: darkgreen;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="top">
        <ul style>
            <li class="nav active"><a href="tilemap.html">Bản đồ nền</a></li>
            <li class="nav"><a href="/routing">Dẫn đường qua 2 điểm</a></li>
            <li class="nav"><a href="routingmulti.html">Dẫn đường qua nhiều điểm</a></li>
            <li class="nav"><a href="/autosearch">Auto Search</a></li>
        </ul>
    </div>
    <div class="center">
        <div id="map"></div>
    </div>
    <script>
        var map = L.map('map').setView([10.758810, 106.681450], 14);

        L.tileLayer('https://maps.vietmap.vn/tm/{z}/{x}/{y}.png?apikey=c3d0f188ff669f89042771a20656579073cffec5a8a69747', {
            attribution: '&copy; <a href="https://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        }).addTo(map);
    </script>
</body>

</html>
