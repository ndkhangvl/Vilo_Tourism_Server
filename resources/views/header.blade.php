<body style="font-family: 'Quicksand', sans-serif;">
    <div class="wrapper">
        <header id="banner" role="banner" class="menu-width-sub">
            <div class="header-toolbar-app">
                <div class="container">
                    <div class="col-md-16">
                        <div id="toppage-header">
                            <div class="hidden-xs date_time_sys col-md-12 col-sm-12">


                                <span id="weather"></span>
                                <script>
                                    $(document).ready(function() {
                                        callAjax();
                                        //jQuery.simpleWeather({
                                        //  woeid: '',
                                        // unit: 'c',
                                        // success: function (weather) {
                                        //    var html = '<i class="icon-' + weather.code + '"></i> <span class="data">' + weather.city +
                                        //       ', ' + weather.region + ' ' + weather.temp + '&deg;' +
                                        //       weather.units.temp + ' </span>';

                                        //   var rootWeather = jQuery('body').find('#weather');
                                        //  rootWeather.html(html);
                                        //},
                                        // error: function (error) {
                                        //  var rootWeather = jQuery('body').find('#weather');
                                        //  rootWeather.html('<p>' + error + '</p>');
                                        //}
                                        // });


                                        function callAjax() {
                                            $.ajax({
                                                type: 'POST',
                                                url: '/Modules/Utilities/GetWeathers',
                                                data: {
                                                    UnitCode: 'VLG'
                                                },
                                                success: function(weather) {
                                                    //console.log(weather);
                                                    if (weather.list != null) {
                                                        var html = '<img src="https://vinhlongtourist.vn/Images/weathericon/' +
                                                            weather.list[0].weather[0].icon +
                                                            '.png" style="width:30px;height:30px"> <span class="data">' +
                                                            Math.round(weather.list[0].main.temp_min) + '&deg;C </span>';
                                                        var rootWeather = jQuery('body').find('#weather');
                                                        rootWeather.html(html);
                                                    }

                                                },
                                                error: function(error) {
                                                    var rootWeather = jQuery('body').find('#weather');
                                                    rootWeather.html('<p>' + error + '</p>');
                                                }
                                            })
                                        }

                                    });
                                </script>

                                <i class="ion-clock"></i><span id="time-date"></span>
                            </div>
                            <div id="login-system" class="col-md-4 col-sm-4">
                                <span id="inline-langage">

                                    <a href="https://vinhlongtourist.vn/en/login">
                                        <img src="/Images/language/en.png" />
                                    </a>
                                    <a href="https://vinhlongtourist.vn/vi/login">
                                        <img src="/Images/language/vi.png" />
                                    </a>




                                </span>
                                <span id="login-btn">
                                    <span class="ion-locked dropdown nav-user">
                                        <a id="login_system" class="login" href="javascript:;">Đăng nhập</a>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
