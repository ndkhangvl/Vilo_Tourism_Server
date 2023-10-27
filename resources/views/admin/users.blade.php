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
    <link rel="stylesheet" href="{{ asset('/../assets/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/../assets/vendor/icon-set/style.css') }}">
    <link rel="stylesheet" href="../node_modules/select2/dist/css/select2.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <script src="{{ asset('js/select2.min.js') }}"></script> --}}



    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{ asset('/../assets/css/theme.min.css?v=1.0') }}">
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
        <div class="p-2">
            {{-- <button data-toggle="modal" data-target="#addPlaceModal" class="btn btn-primary btn-lg px-3 py-2">
                <i class="tio-add"></i>
                Thêm mới
            </button> --}}
        </div>
        <div class="container-fluid p-3">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="p-2 text-center" style="width: 5%">STT</th>
                            <th class="p-2 text-center">Tên người dùng</th>
                            <th class="p-2 text-center">Email</th>
                            <th class="p-2 text-center">Vai trò</th>
                            <th class="p-2 text-center" style="width: 100px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vlusers as $vluser)
                            <tr>
                                <td class="text-center align-middle">{{ $vluser->id }}</td>
                                <td class="text-center align-middle">{{ $vluser->name }}</td>
                                <td class="text-center align-middle">{{ $vluser->email }}</td>
                                <td class="text-center align-middle">
                                    @if ($vluser->role == 2)
                                        <span class="badge badge-soft-danger p-1">Super Admin</span>
                                    @elseif($vluser->role == 1)
                                        <span class="badge badge-soft-success p-1">Admin</span>
                                    @else
                                        <span class="badge badge-soft-primary p-1">User</span>
                                    @endif
                                </td>
                                <td class="d-flex align-items-center">
                                    <a href="/admin/user/{{ $vluser->id }}" class="view flex-grow-1" title=""
                                        data-toggle="tooltip" data-original-title="View" style="margin: 0 1px;"><i
                                            class="tio-visible-outlined"></i></a>
                                    <a href="#" class="edit flex-grow-1" title="" data-toggle="tooltip"
                                        data-original-title="Edit" style="margin: 0 1px;"
                                        data-bs-target="#detailPlaceModal"><i class="tio-edit text-warning"></i></a>
                                    <form id="deleteForm-{{ $vluser->id }}"
                                        action="/admin/user/delete/{{ $vluser->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" id="submitDel" class="btn btn-link p-0"
                                            style="margin: 0 1px;" data-toggle="tooltip" data-original-title="Delete">
                                            <i class="tio-delete-outlined text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- ========== END MAIN CONTENT ========== -->

    <!-- JS Implementing Plugins -->
    <script src="\..\assets\js\vendor.min.js"></script>
    <script src="\..\assets\vendor\chart.js\dist\Chart.min.js"></script>
    <script src="\..\assets\vendor\chart.js.extensions\chartjs-extensions.js"></script>
    <script src="\..\assets\vendor\chartjs-plugin-datalabels\dist\chartjs-plugin-datalabels.min.js"></script>
    <script src="../node_modules/select2/dist/js/select2.full.min.js"></script>



    <!-- JS Front -->
    <script src="\..\assets\js\theme.min.js"></script>
    <script src="\..\assets/js/hs.select2.js"></script>

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

            //CKEditor 
            ClassicEditor
                .create(document.querySelector('#addCKeditor'))
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#editCKeditor'))
                .catch(error => {
                    console.error(error);
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
