<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
        <div class="p-2">
            <button data-toggle="modal" data-target="#addPlaceModal" class="btn btn-primary btn-lg px-3 py-2">
                <i class="tio-add"></i>
                Thêm mới
            </button>
            {{-- <button data-toggle="modal" data-target="#detailPlaceModal" class="btn btn-primary btn-lg px-3 py-2">
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
                            <th class="p-2 text-center">Tên địa điểm</th>
                            <!-- <th class="p-2 text-center">Địa chỉ</th> -->
                            <!-- <th class="p-2 text-center">Thời gian mở cửa</th>
                        <th class="p-2 text-center">Thời gian đóng cửa</th> -->
                            <th class="p-2 text-center">Số điện thoại</th>
                            <th class="p-2 text-center">Email</th>
                            <!-- <th class="p-2 text-center">Mô tả địa điểm</th> -->
                            <th class="p-2 text-center">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vlplaces as $vlplace)
                            <tr>
                                <td class="text-center align-middle">{{ $vlplace->id_place }}</td>
                                <td class="text-center align-middle">{{ $vlplace->name_place }}</td>
                                <!-- <td class="text-center align-middle">{{ $vlplace->address_place }}</td> -->
                                <!-- <td class="text-center align-middle">{{ $vlplace->start_time }}</td>
                            <td class="text-center align-middle">{{ $vlplace->end_time }}</td> -->
                                <td class="text-center align-middle">{{ $vlplace->phone_place }}</td>
                                <td class="text-center align-middle">{{ $vlplace->email_contact_place }}</td>
                                <!-- <td class="text-center align-middle">{{ $vlplace->describe_place }}</td> -->
                                <td class="d-flex align-items-center">
                                    <a href="/admin/place/{{ $vlplace->id_place }}" class="view flex-grow-1"
                                        title="" data-toggle="tooltip" data-original-title="View"
                                        style="margin: 0 1px;"><i class="tio-visible-outlined"></i></a>
                                    <a href="#" class="edit flex-grow-1" title="" data-toggle="tooltip"
                                        data-original-title="Edit" style="margin: 0 1px;"
                                        data-bs-target="#detailPlaceModal"><i class="tio-edit text-warning"></i></a>
                                    {{-- <a href="/admin/place/delete/{{ $vlplace->id_place }}" class="delete"
                                        title="" data-toggle="tooltip" data-original-title="Delete"
                                        style="margin: 0 5px;"><i class="tio-delete-outlined text-danger"></i></a> --}}
                                    <form id="deleteForm-{{ $vlplace->id_place }}"
                                        action="/admin/place/delete/{{ $vlplace->id_place }}" method="POST">
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

    <!-- Modal View -->
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="detailModal"
        aria-hidden="true" id="detailPlaceModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title h4" id="detailModal">Chi tiết địa điểm</h5>
                    <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                        aria-label="Close">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin/place/add" class="" method="POST" id="viewPlace"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="id_view_area">Khu vực</label>
                                <select id="id_view_area" name="id_view_area"
                                    class="js-select2-custom1 custom-select" size="1" style="opacity: 0;"
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
                                <label for="id_view_price">Loại giá</label>
                                <select id="id_view_price" name="id_view_price"
                                    class="js-select2-custom1 custom-select" size="1" style="opacity: 0;"
                                    data-hs-select2-options='{
          "minimumResultsForSearch": "Infinity"
        }'>
                                    <option value="3000">Miễn phí</option>
                                    <option value="3001">Có phí</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="id_view_type">Loại dịch vụ</label>
                                <select id="id_view_type" name="id_view_type"
                                    class="js-select2-custom1 custom-select" size="1" style="opacity: 0;"
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
                                <label for="type_view_service">Loại dịch vụ</label>
                                <select id="type_view_service" class="js-select2-custom1 custom-select"
                                    size="1" style="opacity: 0;"
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
                            <textarea id="editCKeditor" class="form-control" name="describe_place"></textarea>
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

    <!-- Modal Edit -->
    <!-- Modal -->
    {{-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="editPlaceModal"
        aria-hidden="true" id="editPlaceModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title h4" id="editPlaceModal">Large modal</h5>
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
                            <textarea id="editor" class="form-control" name="describe_place"></textarea>
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
    </div> --}}
    <!-- End Modal -->

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

    <script>
        function deletePlace(id) {
            $.ajax({
                url: '/admin/place/delete/' + id,
                type: 'DELETE',
                success: function(response) {
                    // Xử lý thành công
                },
                error: function() {
                    // Xử lý lỗi
                }
            });
        }

        function getdetailPlace(id) {
            $.ajax({
                url: '/admin/place/detail/' + id,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                },
                error: function() {
                    // Xử lý lỗi
                }
            });
        }
    </script>

    {{-- <script>
        $('#detailPlaceModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var itemId = button.data('id');

            var ngaytao = $('#detailPlaceModal #dtngaytao');
            var sohoadon = $('#detailPlaceModal #dtsohoadon');
            var trangthai = $('#detailPlaceModal #dttrangthai');
            var filelink = $('#detailPlaceModal #dtfilelink');
            var khachhang = $('#detailPlaceModal #dtkhachhang');
            var dienthoai = $('#detailPlaceModal #dtdienthoai');
            var diachi = $('#detailPlaceModal #dtdiachi');
            var sohopdong = $('#detailPlaceModal #dtsohopdong');
            var goithau = $('#detailPlaceModal #dtgoithau');
            var duan = $('#detailPlaceModal #dtduan');
            var nguoitao = $('#detailPlaceModal #dtnguoitao');
            var nguoimuahang = $('#detailPlaceModal #dtnguoimuahang');
            var tongtien = $('#detailPlaceModal #dttongtien');
            var thuesuat = $('#detailPlaceModal #dtthuesuat');
            var tienthue = $('#detailPlaceModal #dttienthue');
            var tongtiencothue = $('#detailPlaceModal #dttongtiencothue');
            var sotienbangchu = $('#detailPlaceModal #dtsotienbangchu');
            var xuathoadon = $('#detailPlaceModal #dtbtnxuatpdf');
            // Make an AJAX request to get the item details
            $.ajax({
                url: '/gethoadon/' + itemId,
                type: 'GET',
                success: function(response) {
                    var hoadon = response.hoadon2;
                    var cthd = response.chitiethoadon2;
                    var cntcthd = response.cntcthd;

                    ngaytao.text(hoadon.HOADON_NGAYTAO);
                    sohoadon.text(hoadon.HOADON_SO);
                    if (hoadon.HOADON_TRANGTHAI == 1) {
                        trangthai.css('color', 'green');
                        trangthai.text("Đã thanh toán");
                    } else {
                        trangthai.css('color', 'red');
                        trangthai.text("Chưa thanh toán");
                    }
                    filelink.attr('href', '{{ asset('storage/') }}' + "/" + hoadon
                        .HOADON_FILE);
                    filelink.text(hoadon.HOADON_FILE);
                    khachhang.attr('href', 'khachhang' + "/" + hoadon.KHACHHANG_ID);
                    khachhang.text(hoadon.KHACHHANG_TEN);
                    dienthoai.text(hoadon.KHACHHANG_SDT);
                    diachi.text(hoadon.KHACHHANG_DIACHI);
                    sohopdong.attr('href', '/hopdong' + "/" + hoadon.HOPDONG_SO);
                    sohopdong.text(hoadon.HOPDONG_SO);
                    goithau.text(hoadon.HOPDONG_TENGOITHAU);
                    duan.text(hoadon.HOPDONG_TENDUAN);
                    nguoitao.text(hoadon.HOADON_NGUOITAO);
                    nguoimuahang.text(hoadon.HOADON_NGUOIMUAHANG);
                    tongtien.text(hoadon.HOADON_TONGTIEN);
                    thuesuat.text(hoadon.HOADON_THUESUAT);
                    tienthue.text(hoadon.HOADON_TIENTHUE);
                    tongtiencothue.text(hoadon.HOADON_TONGTIEN_COTHUE);
                    sotienbangchu.text(hoadon.HOADON_SOTIENBANGCHU);

                    for (var i = 0; i < cthd.length; i++) {
                        var item = cthd[i];
                        var tr = $("<tr>");
                        var tdSTT = $("<td>").text(item.STT);
                        tr.append(tdSTT);
                        var tdNOIDUNG = $("<td>").text(item.NOIDUNG);
                        tr.append(tdNOIDUNG);
                        var tdSOLUONG = $("<td>").text(item.SOLUONG);
                        tr.append(tdSOLUONG);
                        var tdDVT = $("<td>").text(item.DVT);
                        tr.append(tdDVT);
                        var tdDONGIA = $("<td>").text(item.DONGIA);
                        tr.append(tdDONGIA);
                        var tdTHANHTIEN = $("<td>").text(item.THANHTIEN);
                        tr.append(tdTHANHTIEN);
                        $("#dtcthd").append(tr);
                    }

                    xuathoadon.attr('href', '/hoadon' + "/" + hoadon.HOADON_ID + "/" +
                        "pdf");
                }
            });
        });
    </script> --}}
    <!-- IE Support -->
    <script>
        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write(
            '<script src="./assets/vendor/babel-polyfill/polyfill.min.js"><\/script>');
    </script>
</body>

</html>
