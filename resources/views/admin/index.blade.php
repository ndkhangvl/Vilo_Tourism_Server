<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Title -->
    <title>Travel &amp; Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- CKEDitor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/icon-set/style.css') }}">

    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css?v=1.0') }}">
</head>

<body class="footer-offset footer-offset has-navbar-vertical-aside navbar-vertical-aside-show-xl">

    {{-- <script src="{{ asset('assets/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js') }}"></script> --}}


    <!-- ONLY DEV -->
    <!-- JS Preview mode only -->
    @include('/admin.components.header');

    {{-- <script src="assets\js\demo.js"></script> --}}

    <!-- END ONLY DEV -->

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main pointer-event">
        <div class="content container-fluid">
            <!-- Stats -->
            <div class="row gx-2 gx-lg-3">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="/admin/users">
                        <div class="card-body">
                            <h6 class="card-subtitle">Tổng Người Dùng</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <span class="card-title h2">{{ $vltotal[0]->UserCount }}</span>
                                </div>

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart"
                                            data-hs-chartjs-options='{
                                "type": "line",
                                "data": {
                                   "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                   "datasets": [{
                                    "data": [21,20,24,20,18,17,15,17,18,30,31,30,30,35,25,35,35,40,60,90,90,90,85,70,75,70,30,30,30,50,72],
                                    "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                    "borderColor": "#377dff",
                                    "borderWidth": 2,
                                    "pointRadius": 0,
                                    "pointHoverRadius": 0
                                  }]
                                },
                                "options": {
                                   "scales": {
                                     "yAxes": [{
                                       "display": false
                                     }],
                                     "xAxes": [{
                                       "display": false
                                     }]
                                   },
                                  "hover": {
                                    "mode": "nearest",
                                    "intersect": false
                                  },
                                  "tooltips": {
                                    "postfix": "k",
                                    "hasIndicator": true,
                                    "intersect": false
                                  }
                                }
                              }'>
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                            </div>
                            <!-- End Row -->

                            {{-- <span class="badge badge-soft-success">
                                <i class="tio-trending-up"></i> 12.5%
                            </span>
                            <span class="text-body font-size-sm ml-1">from 70,104</span> --}}
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="/admin/place">
                        <div class="card-body">
                            <h6 class="card-subtitle">Tổng Địa Điểm</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <span class="card-title h2">{{ $vltotal[0]->PlaceCount }}</span>
                                </div>

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart"
                                            data-hs-chartjs-options='{
                                "type": "line",
                                "data": {
                                   "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                   "datasets": [{
                                    "data": [21,20,24,20,18,17,15,17,30,30,35,25,18,30,31,35,35,90,90,90,85,100,120,120,120,100,90,75,75,75,90],
                                    "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                    "borderColor": "#377dff",
                                    "borderWidth": 2,
                                    "pointRadius": 0,
                                    "pointHoverRadius": 0
                                  }]
                                },
                                "options": {
                                   "scales": {
                                     "yAxes": [{
                                       "display": false
                                     }],
                                     "xAxes": [{
                                       "display": false
                                     }]
                                   },
                                  "hover": {
                                    "mode": "nearest",
                                    "intersect": false
                                  },
                                  "tooltips": {
                                    "postfix": "%",
                                    "hasIndicator": true,
                                    "intersect": false
                                  }
                                }
                              }'>
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                            </div>
                            <!-- End Row -->

                            {{-- <span class="badge badge-soft-success">
                                <i class="tio-trending-up"></i> 1.7%
                            </span>
                            <span class="text-body font-size-sm ml-1">from 29.1%</span> --}}
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="/admin/news">
                        <div class="card-body">
                            <h6 class="card-subtitle">Tổng Tin Tức</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <span class="card-title h2">{{ $vltotal[0]->NewsCount }}</span>
                                </div>

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart"
                                            data-hs-chartjs-options='{
                                "type": "line",
                                "data": {
                                   "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                   "datasets": [{
                                    "data": [25,18,30,31,35,35,60,60,60,75,21,20,24,20,18,17,15,17,30,120,120,120,100,90,75,90,90,90,75,70,60],
                                    "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                    "borderColor": "#377dff",
                                    "borderWidth": 2,
                                    "pointRadius": 0,
                                    "pointHoverRadius": 0
                                  }]
                                },
                                "options": {
                                   "scales": {
                                     "yAxes": [{
                                       "display": false
                                     }],
                                     "xAxes": [{
                                       "display": false
                                     }]
                                   },
                                  "hover": {
                                    "mode": "nearest",
                                    "intersect": false
                                  },
                                  "tooltips": {
                                    "postfix": "%",
                                    "hasIndicator": true,
                                    "intersect": false
                                  }
                                }
                              }'>
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                            </div>
                            <!-- End Row -->

                            {{-- <span class="badge badge-soft-danger">
                                <i class="tio-trending-down"></i> 4.4%
                            </span>
                            <span class="text-body font-size-sm ml-1">from 61.2%</span> --}}
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="/admin">
                        <div class="card-body">
                            <h6 class="card-subtitle">Lượt ghé trang</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <span class="card-title h2">92,913</span>
                                </div>

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart"
                                            data-hs-chartjs-options='{
                                "type": "line",
                                "data": {
                                   "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                   "datasets": [{
                                    "data": [21,20,24,15,17,30,30,35,35,35,40,60,12,90,90,85,70,75,43,75,90,22,120,120,90,85,100,92,92,92,92],
                                    "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                    "borderColor": "#377dff",
                                    "borderWidth": 2,
                                    "pointRadius": 0,
                                    "pointHoverRadius": 0
                                  }]
                                },
                                "options": {
                                   "scales": {
                                     "yAxes": [{
                                       "display": false
                                     }],
                                     "xAxes": [{
                                       "display": false
                                     }]
                                   },
                                  "hover": {
                                    "mode": "nearest",
                                    "intersect": false
                                  },
                                  "tooltips": {
                                    "postfix": "k",
                                    "hasIndicator": true,
                                    "intersect": false
                                  }
                                }
                              }'>
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                            </div>
                            <!-- End Row -->

                            {{-- <span class="badge badge-soft-secondary">0.0%</span>
                            <span class="text-body font-size-sm ml-1">from 2,913</span> --}}
                        </div>
                    </a>
                    <!-- End Card -->
                </div>
            </div>
            <!-- End Stats -->
        </div>
    </main>

    <!-- ========== END MAIN CONTENT ========== -->

    <!-- Modal Add -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="addModal"
        aria-hidden="true" id="addPlaceModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title h4" id="addModal">Large modal</h5>
                    <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                        aria-label="Close">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin/place/add" class="" method="POST" id="addPlace"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="id_area">Khu vực</label>
                                <select id="id_area" name="id_area" class="js-select2-custom custom-select"
                                    size="1" style="opacity: 0;"
                                    data-hs-select2-options='{
          "minimumResultsForSearch": "Infinity"
        }'>
                                    <option value="1000">Huyện Bình Tân</option>
                                    <option value="1001">Huyện Long Hồ</option>
                                    <option value="1002">Huyện Mang Thít</option>
                                    <option value="1003">Huyện Tam Bình</option>
                                    <option value="1004">Huyện Trà Ôn</option>
                                    <option value="1005">Huyện Vũng Liêm</option>
                                    <option value="1006">Thành phố Vĩnh Long</option>
                                    <option value="1007">Thị xã Bình Minh</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="id_price">Loại giá</label>
                                <select id="id_price" name="id_price" class="js-select2-custom custom-select"
                                    size="1" style="opacity: 0;"
                                    data-hs-select2-options='{
          "minimumResultsForSearch": "Infinity"
        }'>
                                    <option value="3000">Miễn phí</option>
                                    <option value="3001">Có phí</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="id_type">Loại dịch vụ</label>
                                <select id="id_type" name="id_type" class="js-select2-custom custom-select"
                                    size="1" style="opacity: 0;"
                                    data-hs-select2-options='{
          "minimumResultsForSearch": "Infinity"
        }'>
                                    <option value="4000">Du lịch sinh thái</option>
                                    <option value="4001">Du lịch làng nghề</option>
                                    <option value="4002">Du lịch lịch sử - văn hóa</option>
                                    <option value="4003">Du lịch tâm linh</option>
                                    <option value="4004">Du lịch trở về nguồn cội</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="type_service">Loại dịch vụ</label>
                                <select id="type_service" class="js-select2-custom custom-select" size="1"
                                    style="opacity: 0;"
                                    data-hs-select2-options='{
          "minimumResultsForSearch": "Infinity"
        }'>
                                    <option value="1003">Miễn phí</option>
                                    <option value="1002">Có phí</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name_place">Tên địa điểm</label>
                                <input type="text" name="name_place" id="name_place" class="form-control"
                                    placeholder="Nhập vào tên địa điểm" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="address_place">Địa chỉ</label>
                                <input type="text" name="address_place" id="address_place" class="form-control"
                                    placeholder="Nhập vào địa chỉ" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phone_place">Số điện thoại</label>
                                <input type="text" name="phone_place" id="phone_place" class="form-control"
                                    placeholder="Nhập vào số điện thoại" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="start_time">Thời gian mở cửa</label>
                                <input type="text" name="start_time" id="start_time" class="form-control"
                                    placeholder="Nhập thời gian mở cửa" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="end_time">Thời gian đóng cửa</label>
                                <input type="text" name="end_time" id="end_time" class="form-control"
                                    placeholder="Nhập thời gian đóng cửa" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email_contact_place">Email</label>
                            <input type="email" name="email_contact_place" id="email_contact_place"
                                class="form-control" placeholder="Nhập vào email" required>
                        </div>
                        <div class="form-group">
                            <label for="describe_place">Mô tả</label>
                            <textarea id="addCKeditor" class="form-control" name="describe_place"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file_input">Upload file</label>
                            <input class="js-dropzone dropzone-custom custom-file-boxed dz-clickable" id="file_input"
                                type="file" name="image">
                        </div>
                        <div class="form-group">
                            <button data-modal-hide="defaultModal" type="submit" class="btn btn-primary">I
                                accept</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- JS Implementing Plugins -->
    <script src="assets\js\vendor.min.js"></script>
    <script src="assets\vendor\chart.js\dist\Chart.min.js"></script>
    <script src="assets\vendor\chart.js.extensions\chartjs-extensions.js"></script>
    <script src="assets\vendor\chartjs-plugin-datalabels\dist\chartjs-plugin-datalabels.min.js"></script>
    <script src="../node_modules/select2/dist/js/select2.full.min.js"></script>



    <!-- JS Front -->
    <script src="assets\js\theme.min.js"></script>
    <script src="assets/js/hs.select2.js"></script>

    <!-- JS Plugins Init. -->
    <script>
        $(document).on('ready', function() {
            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

        $(document).on('ready', function() {
            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom1').each(function() {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

        $(document).on('ready', function() {
            // ONLY DEV
            // =======================================================

            if (window.localStorage.getItem('hs-builder-popover') === null) {
                $('#builderPopover').popover('show')
                    .on('shown.bs.popover', function() {
                        $('.popover').last().addClass('popover-dark')
                    });

                $(document).on('click', '#closeBuilderPopover', function() {
                    window.localStorage.setItem('hs-builder-popover', true);
                    $('#builderPopover').popover('dispose');
                });
            } else {
                $('#builderPopover').on('show.bs.popover', function() {
                    return false
                });
            }

            // END ONLY DEV
            // =======================================================


            // BUILDER TOGGLE INVOKER
            // =======================================================
            $('.js-navbar-vertical-aside-toggle-invoker').click(function() {
                $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
            });


            // INITIALIZATION OF MEGA MENU
            // =======================================================
            var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
                desktop: {
                    position: 'left'
                }
            }).init();



            // INITIALIZATION OF NAVBAR VERTICAL NAVIGATION
            // =======================================================
            var sidebar = $('.js-navbar-vertical-aside').hsSideNav();


            // INITIALIZATION OF TOOLTIP IN NAVBAR VERTICAL MENU
            // =======================================================
            $('.js-nav-tooltip-link').tooltip({
                boundary: 'window'
            })

            $(".js-nav-tooltip-link").on("show.bs.tooltip", function(e) {
                if (!$("body").hasClass("navbar-vertical-aside-mini-mode")) {
                    return false;
                }
            });


            // INITIALIZATION OF UNFOLD
            // =======================================================
            $('.js-hs-unfold-invoker').each(function() {
                var unfold = new HSUnfold($(this)).init();
            });


            // INITIALIZATION OF FORM SEARCH
            // =======================================================
            $('.js-form-search').each(function() {
                new HSFormSearch($(this)).init()
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
                // var select2 = $(this).select2();
            });


            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                        '<img class="mb-3" src="./assets/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                        '<p class="mb-0">No data to show</p>' +
                        '</div>'
                }
            });

            $('.js-datatable-filter').on('change', function() {
                var $this = $(this),
                    elVal = $this.val(),
                    targetColumnIndex = $this.data('target-column-index');

                datatable.column(targetColumnIndex).search(elVal).draw();
            });

            $('#datatableSearch').on('mouseup', function(e) {
                var $input = $(this),
                    oldValue = $input.val();

                if (oldValue == "") return;

                setTimeout(function() {
                    var newValue = $input.val();

                    if (newValue == "") {
                        // Gotcha
                        datatable.search('').draw();
                    }
                }, 1);
            });
            // INITIALIZATION OF CLIPBOARD
            // =======================================================
            $('.js-clipboard').each(function() {
                var clipboard = $.HSCore.components.HSClipboard.init(this);
            });
        });
    </script>

    <!-- IE Support -->
    <script>
        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write(
            '<script src="./assets/vendor/babel-polyfill/polyfill.min.js"><\/script>');
    </script>
</body>

</html>
