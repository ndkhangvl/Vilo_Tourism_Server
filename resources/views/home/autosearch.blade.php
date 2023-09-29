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
    <link rel="stylesheet" href="auto-complete.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>
    {{-- <script src="auto-complete.js"></script> --}}
    <script>
        /*
                        JavaScript autoComplete v1.0.3
                        Copyright (c) 2014 Simon Steinberger / Pixabay
                        GitHub: https://github.com/Pixabay/JavaScript-autoComplete
                        License: http://www.opensource.org/licenses/mit-license.php
                    */

        var autoComplete = (function() {
            // "use strict";
            function autoComplete(options) {
                if (!document.querySelector) return;

                // helpers
                function hasClass(el, className) {
                    return el.classList ? el.classList.contains(className) : new RegExp('\\b' + className + '\\b')
                        .test(el.className);
                }

                function addEvent(el, type, handler) {
                    if (el.attachEvent) el.attachEvent('on' + type, handler);
                    else el.addEventListener(type, handler);
                }

                function removeEvent(el, type, handler) {
                    // if (el.removeEventListener) not working in IE11
                    if (el.detachEvent) el.detachEvent('on' + type, handler);
                    else el.removeEventListener(type, handler);
                }

                function live(elClass, event, cb, context) {
                    addEvent(context || document, event, function(e) {
                        var found, el = e.target || e.srcElement;
                        while (el && !(found = hasClass(el, elClass))) el = el.parentElement;
                        if (found) cb.call(el, e);
                    });
                }

                var o = {
                    selector: 0,
                    source: 0,
                    minChars: 3,
                    delay: 150,
                    cache: 1,
                    menuClass: '',
                    renderItem: function(item, search) {
                        // escape special characters
                        search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                        var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                        return '<div class="autocomplete-suggestion" data-val="' + item + '">' + item
                            .replace(re, "<b>$1</b>") + '</div>';
                    },
                    onSelect: function(e, term, item) {}
                };
                for (var k in options) {
                    if (options.hasOwnProperty(k)) o[k] = options[k];
                }

                // init
                var elems = typeof o.selector == 'object' ? [o.selector] : document.querySelectorAll(o.selector);
                for (var i = 0; i < elems.length; i++) {
                    var that = elems[i];

                    // create suggestions container "sc"
                    that.sc = document.createElement('div');
                    that.sc.className = 'autocomplete-suggestions ' + o.menuClass;

                    that.autocompleteAttr = that.getAttribute('autocomplete');
                    that.setAttribute('autocomplete', 'off');
                    that.cache = {};
                    that.last_val = '';

                    that.updateSC = function(resize, next) {
                        var rect = that.getBoundingClientRect();
                        that.sc.style.left = rect.left + (window.pageXOffset || document.documentElement
                            .scrollLeft) + 'px';
                        that.sc.style.top = rect.bottom + (window.pageYOffset || document.documentElement
                            .scrollTop) + 1 + 'px';
                        that.sc.style.width = rect.right - rect.left + 'px'; // outerWidth
                        if (!resize) {
                            that.sc.style.display = 'block';
                            if (!that.sc.maxHeight) {
                                that.sc.maxHeight = parseInt((window.getComputedStyle ? getComputedStyle(that
                                    .sc, null) : that.sc.currentStyle).maxHeight);
                            }
                            if (!that.sc.suggestionHeight) that.sc.suggestionHeight = that.sc.querySelector(
                                '.autocomplete-suggestion').offsetHeight;
                            if (that.sc.suggestionHeight)
                                if (!next) that.sc.scrollTop = 0;
                                else {
                                    var scrTop = that.sc.scrollTop,
                                        selTop = next.getBoundingClientRect().top - that.sc
                                        .getBoundingClientRect().top;
                                    if (selTop + that.sc.suggestionHeight - that.sc.maxHeight > 0)
                                        that.sc.scrollTop = selTop + that.sc.suggestionHeight + scrTop - that.sc
                                        .maxHeight;
                                    else if (selTop < 0)
                                        that.sc.scrollTop = selTop + scrTop;
                                }
                        }
                    }
                    addEvent(window, 'resize', that.updateSC);
                    document.body.appendChild(that.sc);

                    live('autocomplete-suggestion', 'mouseleave', function(e) {
                        var sel = that.sc.querySelector('.autocomplete-suggestion.selected');
                        if (sel) setTimeout(function() {
                            sel.className = sel.className.replace('selected', '');
                        }, 20);
                    }, that.sc);

                    live('autocomplete-suggestion', 'mouseover', function(e) {
                        var sel = that.sc.querySelector('.autocomplete-suggestion.selected');
                        if (sel) sel.className = sel.className.replace('selected', '');
                        this.className += ' selected';
                    }, that.sc);

                    live('autocomplete-suggestion', 'mousedown', function(e) {
                        if (hasClass(this, 'autocomplete-suggestion')) { // else outside click
                            var v = this.getAttribute('data-val');
                            that.value = v;
                            o.onSelect(e, v, this);
                            that.sc.style.display = 'none';
                        }
                    }, that.sc);

                    that.blurHandler = function() {
                        try {
                            var over_sb = document.querySelector('.autocomplete-suggestions:hover');
                        } catch (e) {
                            var over_sb = 0;
                        }
                        if (!over_sb) {
                            that.last_val = that.value;
                            that.sc.style.display = 'none';
                            setTimeout(function() {
                                that.sc.style.display = 'none';
                            }, 350); // hide suggestions on fast input
                        } else if (that !== document.activeElement) setTimeout(function() {
                            that.focus();
                        }, 20);
                    };
                    addEvent(that, 'blur', that.blurHandler);

                    var suggest = function(data) {
                        var val = that.value;
                        that.cache[val] = data;
                        if (data.length && val.length >= o.minChars) {
                            var s = '';
                            for (var i = 0; i < data.length; i++) s += o.renderItem(data[i], val);
                            that.sc.innerHTML = s;
                            that.updateSC(0);
                        } else
                            that.sc.style.display = 'none';
                    }

                    that.keydownHandler = function(e) {
                        var key = window.event ? e.keyCode : e.which;
                        // down (40), up (38)
                        if ((key == 40 || key == 38) && that.sc.innerHTML) {
                            var next, sel = that.sc.querySelector('.autocomplete-suggestion.selected');
                            if (!sel) {
                                next = (key == 40) ? that.sc.querySelector('.autocomplete-suggestion') : that.sc
                                    .childNodes[that.sc.childNodes.length - 1]; // first : last
                                next.className += ' selected';
                                that.value = next.getAttribute('data-val');
                            } else {
                                next = (key == 40) ? sel.nextSibling : sel.previousSibling;
                                if (next) {
                                    sel.className = sel.className.replace('selected', '');
                                    next.className += ' selected';
                                    that.value = next.getAttribute('data-val');
                                } else {
                                    sel.className = sel.className.replace('selected', '');
                                    that.value = that.last_val;
                                    next = 0;
                                }
                            }
                            that.updateSC(0, next);
                            return false;
                        }
                        // esc
                        else if (key == 27) {
                            that.value = that.last_val;
                            that.sc.style.display = 'none';
                        }
                        // enter
                        else if (key == 13 || key == 9) {
                            var sel = that.sc.querySelector('.autocomplete-suggestion.selected');
                            if (sel && that.sc.style.display != 'none') {
                                o.onSelect(e, sel.getAttribute('data-val'), sel);
                                setTimeout(function() {
                                    that.sc.style.display = 'none';
                                }, 20);
                            }
                        }
                    };
                    addEvent(that, 'keydown', that.keydownHandler);

                    that.keyupHandler = function(e) {
                        var key = window.event ? e.keyCode : e.which;
                        if (!key || (key < 35 || key > 40) && key != 13 && key != 27) {
                            var val = that.value;
                            if (val.length >= o.minChars) {
                                if (val != that.last_val) {
                                    that.last_val = val;
                                    clearTimeout(that.timer);
                                    if (o.cache) {
                                        if (val in that.cache) {
                                            suggest(that.cache[val]);
                                            return;
                                        }
                                        // no requests if previous suggestions were empty
                                        for (var i = 1; i < val.length - o.minChars; i++) {
                                            var part = val.slice(0, val.length - i);
                                            if (part in that.cache && !that.cache[part].length) {
                                                suggest([]);
                                                return;
                                            }
                                        }
                                    }
                                    that.timer = setTimeout(function() {
                                        o.source(val, suggest)
                                    }, o.delay);
                                }
                            } else {
                                that.last_val = val;
                                that.sc.style.display = 'none';
                            }
                        }
                    };
                    addEvent(that, 'keyup', that.keyupHandler);

                    that.focusHandler = function(e) {
                        that.last_val = '\n';
                        that.keyupHandler(e)
                    };
                    if (!o.minChars) addEvent(that, 'focus', that.focusHandler);
                }

                // public destroy method
                this.destroy = function() {
                    for (var i = 0; i < elems.length; i++) {
                        var that = elems[i];
                        removeEvent(window, 'resize', that.updateSC);
                        removeEvent(that, 'blur', that.blurHandler);
                        removeEvent(that, 'focus', that.focusHandler);
                        removeEvent(that, 'keydown', that.keydownHandler);
                        removeEvent(that, 'keyup', that.keyupHandler);
                        if (that.autocompleteAttr)
                            that.setAttribute('autocomplete', that.autocompleteAttr);
                        else
                            that.removeAttribute('autocomplete');
                        document.body.removeChild(that.sc);
                        that = null;
                    }
                };
            }
            return autoComplete;
        })();

        (function() {
            if (typeof define === 'function' && define.amd)
                define('autoComplete', function() {
                    return autoComplete;
                });
            else if (typeof module !== 'undefined' && module.exports)
                module.exports = autoComplete;
            else
                window.autoComplete = autoComplete;
        })();
    </script>
    <style>
        .autocomplete-suggestions {
            text-align: left;
            cursor: default;
            border: 1px solid #ccc;
            border-top: 0;
            background: #fff;
            box-shadow: -1px 1px 3px rgba(0, 0, 0, .1);

            /* core styles should not be changed */
            position: absolute;
            display: none;
            z-index: 9999;
            max-height: 254px;
            overflow: hidden;
            overflow-y: auto;
            box-sizing: border-box;
        }

        .autocomplete-suggestion {
            position: relative;
            padding: 0 .6em;
            line-height: 23px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 1.02em;
            color: #333;
        }

        .autocomplete-suggestion b {
            font-weight: normal;
            color: #1f8dd6;
        }

        .autocomplete-suggestion.selected {
            background: #f0f0f0;
        }

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

        * {
            box-sizing: border-box;
        }

        body {
            font: 16px Arial;
        }

        /*the container must be positioned relative:*/
        .autocomplete {
            position: relative;
            display: inline-block;
        }

        input {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 10px;
            font-size: 16px;
        }

        input[type=text] {
            background-color: #f1f1f1;
            width: 100%;
        }

        input[type=submit] {
            background-color: DodgerBlue;
            color: #fff;
            cursor: pointer;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }

        .search-form {
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            background: #fafafa;
            margin: 30px 0;
            padding: 5px 2px;
            text-align: center;
            z-index: 1000;
            position: absolute;
            top: 50px;
            left: 20px;
            width: 350px;
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
            <li class="nav"><a href="routing.html">Dẫn đường qua 2 điểm</a></li>
            <li class="nav"><a href="routingmulti.html">Dẫn đường qua nhiều điểm</a></li>
            <li class="nav active"><a href="autosearch.html">Auto Search</a></li>
        </ul>
    </div>
    <div class="center row">

        <div id="map">
            <form class="search-form" onsubmit="return false;">
                <input id="places-search" autofocus type="text" name="q"
                    placeholder="Nhập tên hoặc địa chỉ để tìm kiếm ..." style="width:100%;max-width:600px;outline:0">
            </form>
        </div>
    </div>
    <script>
        var map = L.map('map').setView([10.758810, 106.681450], 14);
        var marker = null;
        var reverseMarker = null;
        L.tileLayer('https://maps.vietmap.vn/tm/{z}/{x}/{y}.png?apikey=9cbf0bc15d3901b7e043d8f76be8d73f370a82fe629a2d46', {
            attribution: '&copy; <a href="http://maps.vietmap.vn/copyright">Vietmap</a> contributors'
        }).addTo(map);

        $(document).ready(function() {
            map.on('click', function(el) {
                //console.log(el);
                $.ajax({
                    url: 'https://maps.vietmap.vn/api/reverse?size=10&apikey=9cbf0bc15d3901b7e043d8f76be8d73f370a82fe629a2d46&lat=' +
                        el.latlng.lat + '&lon=' + el.latlng.lng,
                    type: 'get',
                    success: function(res) {
                        if (res.data.length == 0) return;
                        if (reverseMarker != null) {
                            map.removeLayer(reverseMarker);
                        }

                        var startIcon = L.icon({
                            iconUrl: 'pink.png',
                            iconAnchor: [32, 32],
                            popupAnchor: [0, -20]
                        });
                        reverseMarker = L.marker([el.latlng.lat, el.latlng.lng], {
                            icon: startIcon
                        });
                        reverseMarker.bindPopup('<p>' + res.data[0].properties.label + '</p>');
                        reverseMarker.addTo(map);
                        reverseMarker.openPopup();
                    }
                })
            })
        })

        var demo_with_map = new autoComplete({
            selector: '#places-search',
            minChars: 2,
            source: function(term, response) {
                var latlon = map.getCenter();

                fetch('https://maps.vietmap.vn/api/autocomplete?apikey=9cbf0bc15d3901b7e043d8f76be8d73f370a82fe629a2d46&focus.point.lat=' +
                        latlon.lat + '&focus.point.lon=' + latlon.lng + '&text=' + term)
                    .then(function(response) {
                        return response.text();
                    }).then(function(body) {
                        var json = JSON.parse(body);

                        var data = [];
                        for (var i = 0; i < json.data.length; i++) {
                            data.push({
                                nom: json.data[i].properties.label,
                                code: json.data[i].properties.name,
                                centre: {
                                    coordinates: json.data[i].geometry.coordinates
                                }
                            });
                        }

                        var new_json = data.map(function(el) {

                            return {
                                label: el.nom,
                                value: el.code,
                                lat: el.centre.coordinates[1],
                                lon: el.centre.coordinates[0],
                                boundingbox: null
                            }
                        })
                        response(new_json);
                    });
            },
            renderItem: function(item, search) {
                search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                var optional_bbox_attribute = '';
                if (item.boundingbox) {
                    var bbox = [item.boundingbox[2], item.boundingbox[0], item.boundingbox[3], item.boundingbox[
                        1]];
                    var optional_bbox_attribute = 'data-bbox="' + bbox.join(',') + '" ';
                }
                return '<div class="autocomplete-suggestion" ' + optional_bbox_attribute +
                    'data-lon="' + item.lon + '" data-lat="' + item.lat +
                    '" data-val="' + item.label + '">' +
                    item.label.replace(re, "<b>$1</b>") +
                    '</div>';
            },
            onSelect: function(e, term, item) {
                if (item.getAttribute('data-bbox') && (item.getAttribute('data-bbox').split(',')).length > 0) {
                    var extent = item.getAttribute('data-bbox').split(',');
                    if (extent.length > 0) {
                        extent = extent.map(function(el) {
                            return Number(el);
                        });
                    }
                    var bounds = [
                        [extent[1], extent[0]],
                        [extent[3], extent[2]]
                    ];

                    // zoom the map to the bounds
                    map.fitBounds(bounds);
                } else {
                    var lat = Number(item.getAttribute('data-lat'));
                    var lon = Number(item.getAttribute('data-lon'));

                    map.setView(L.latLng(lat, lon), map.getZoom());

                    if (marker != null) {
                        map.removeLayer(marker);
                    }

                    var startIcon = L.icon({
                        iconUrl: 'pin.png',
                        iconAnchor: [32, 32],
                        popupAnchor: [15, -20]
                    });
                    marker = L.marker([lat, lon], {
                        icon: startIcon
                    });
                    marker.bindPopup('<p>' + term + '</p>');
                    marker.addTo(map);
                    marker.openPopup();
                }
            }
        });
    </script>
</body>

</html>
