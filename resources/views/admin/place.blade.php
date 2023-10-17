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
    {{-- <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

    <!-- SweetAlert2 JS -->
    <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                    <a href="/admin/place/detail/{{ $vlplace->id_place }}" class="view flex-grow-1"
                                        title="" data-toggle="tooltip" data-original-title="View"
                                        style="margin: 0 1px;" onclick="getDetailPlace(event,this)"><i
                                            class="tio-visible-outlined"></i></a>
                                    <a href="/admin/place/detail/{{ $vlplace->id_place }}" class="edit flex-grow-1"
                                        title="" data-toggle="tooltip" data-original-title="Edit"
                                        style="margin: 0 1px;"
                                        onclick="getEditDetailPlace(event,this, {{ $vlplace->id_place }})"
                                        data-id="{{ $vlplace->id_place }}"><i class="tio-edit text-warning"></i></a>
                                    {{-- <a href="/admin/place/delete/{{ $vlplace->id_place }}" class="delete"
                                        title="" data-toggle="tooltip" data-original-title="Delete"
                                        style="margin: 0 5px;"><i class="tio-delete-outlined text-danger"></i></a> --}}
                                    <form id="deleteForm-{{ $vlplace->id_place }}"
                                        action="/admin/place/delete/{{ $vlplace->id_place }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" id="submitDel"
                                            onclick="deletePlace('{{ $vlplace->id_place }}','{{ $vlplace->name_place }}')"
                                            class="btn btn-link p-0" style="margin: 0 1px;" data-toggle="tooltip"
                                            data-original-title="Delete">
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
                    <div id="detailContent">
                        <form action="/admin/place/add" class="" method="POST" id="viewPlace"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="label_view_area">Khu vực</label>
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
                                    <input type="text" name="name_view_place" id="name_view_place"
                                        class="form-control" placeholder="Nhập vào tên địa điểm" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="label_address_place">Địa chỉ</label>
                                    <input type="text" name="address_view_place" id="address_view_place"
                                        class="form-control" placeholder="Nhập vào địa chỉ" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="label_phone_place">Số điện thoại</label>
                                    <input type="text" name="phone_view_place" id="phone_view_place"
                                        class="form-control" placeholder="Nhập vào số điện thoại" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="start_time">Thời gian mở cửa</label>
                                    <input type="text" name="start_view_time" id="start_view_time"
                                        class="form-control" placeholder="Nhập thời gian mở cửa" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_time">Thời gian đóng cửa</label>
                                    <input type="text" name="end_view_time" id="end_view_time"
                                        class="form-control" placeholder="Nhập thời gian đóng cửa" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email_contact_place">Email</label>
                                <input type="email" name="email_view_contact_place" id="email_view_contact_place"
                                    class="form-control" placeholder="Nhập vào email" required>
                            </div>
                            <div class="form-group">
                                <label for="describe_place">Mô tả</label>
                                <textarea id="viewCKeditor" class="form-control" name="describe_view_place"></textarea>
                            </div>
                            {{-- <div class="form-group">
                                <label for="file_input">Upload file</label>
                                <input class="js-dropzone dropzone-custom custom-file-boxed dz-clickable"
                                    id="file_view_input" type="file" name="image">
                            </div> --}}
                            {{-- <div class="form-group">
                                <button data-modal-hide="defaultModal" type="submit" class="btn btn-primary">I
                                    accept</button>
                            </div> --}}
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal Edit -->
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="editPlaceModal"
        aria-hidden="true" id="editPlaceModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="editPlaceModal">Chỉnh sửa địa điểm</h5>
                    <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                        aria-label="Close">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" class="" method="POST" id="editPlace"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="id_area">Khu vực</label>
                                <select id="id_edit_area" name="id_edit_area" class="js-select2-custom custom-select"
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
                                <select id="id_edit_price" name="id_edit_price"
                                    class="js-select2-custom custom-select" size="1" style="opacity: 0;"
                                    data-hs-select2-options='{
          "minimumResultsForSearch": "Infinity"
        }'>
                                    <option value="3000">Miễn phí</option>
                                    <option value="3001">Có phí</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="id_type">Loại dịch vụ</label>
                                <select id="id_edit_type" name="id_edit_type" class="js-select2-custom custom-select"
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
                                <select id="type_edit_service" class="js-select2-custom custom-select" size="1"
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
                                <input type="text" name="name_edit_place" id="name_edit_place"
                                    class="form-control" placeholder="Nhập vào tên địa điểm" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="address_place">Địa chỉ</label>
                                <input type="text" name="address_edit_place" id="address_edit_place"
                                    class="form-control" placeholder="Nhập vào địa chỉ" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phone_place">Số điện thoại</label>
                                <input type="text" name="phone_edit_place" id="phone_edit_place"
                                    class="form-control" placeholder="Nhập vào số điện thoại" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="start_time">Thời gian mở cửa</label>
                                <input type="text" name="start_edit_time" id="start_edit_time"
                                    class="form-control" placeholder="Nhập thời gian mở cửa" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="end_time">Thời gian đóng cửa</label>
                                <input type="text" name="end_edit_time" id="end_edit_time" class="form-control"
                                    placeholder="Nhập thời gian đóng cửa" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email_contact_place">Email</label>
                            <input type="email" name="email_edit_contact_place" id="email_edit_contact_place"
                                class="form-control" placeholder="Nhập vào email" required>
                        </div>
                        <div class="form-group">
                            <label for="describe_place">Mô tả</label>
                            <textarea id="editCKeditor" class="form-control" name="describe_edit_place"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file_input">Upload file</label>
                            <input class="js-dropzone dropzone-custom custom-file-boxed dz-clickable"
                                id="file_edit_input" type="file" name="image">
                        </div>
                        <div class="form-group">
                            <button data-modal-hide="defaultModal" type="submit" class="btn btn-primary">Chỉnh
                                sửa</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
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

            // ClassicEditor
            //     .create(document.querySelector('#editCKeditor'))
            //     .catch(error => {
            //         console.error(error);
            //     });

            // INITIALIZATION OF CLIPBOARD
            // =======================================================
            $('.js-clipboard').each(function() {
                var clipboard = $.HSCore.components.HSClipboard.init(this);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#editPlace').submit(function(event) {
                event.preventDefault();
                var csrfToken = $('input[name="_token"]').val();
                // Lấy dữ liệu từ form
                var formData = new FormData(this);
                console.log(formData.get('describe_edit_place'));
                // console.log(formData.get('name_edit_place'));
                $.ajax({
                    url: '/admin/place/edit/' + id, // Đường dẫn URL để gửi Ajax request
                    data: formData,
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        console.log('Success:', response);
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
                console.log(formData.get('name_edit_place'));
            });
        });

        // function deletePlace(id) {
        //     var form = $('#deleteForm-' + id);
        //     var url = form.attr('action');
        //     Swal.fire({
        //         title: 'Xóa địa điểm này?',
        //         text: "Thông tin địa diểm sẽ được xóa!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#0d6efd',
        //         cancelButtonColor: '#6c757d',
        //         confirmButtonText: 'Xóa',
        //         cancelButtonText: 'Hủy'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             Swal.fire({
        //                 title: 'Đang xử lý...',
        //                 allowOutsideClick: false,
        //                 allowEscapeKey: false,
        //                 allowEnterKey: false,
        //                 onBeforeOpen: () => {
        //                     Swal.showLoading();
        //                 },
        //                 onClose: () => {
        //                     Swal.hideLoading();
        //                 }
        //             });
        //             $.ajax({
        //                 url: url,
        //                 type: 'DELETE',
        //                 beforeSend: function() {
        //                     Swal.fire({
        //                         title: 'Đang xử lý...',
        //                         allowOutsideClick: false,
        //                         allowEscapeKey: false,
        //                         allowEnterKey: false,
        //                         onBeforeOpen: () => {
        //                             Swal.showLoading();
        //                         },
        //                         onClose: () => {
        //                             Swal.hideLoading();
        //                         }
        //                     });
        //                 },
        //                 success: function(response) {
        //                     Swal.close();
        //                     if (response.success == true) {
        //                         Swal.fire({
        //                             icon: 'success',
        //                             title: 'Đã cập nhật!',
        //                             text: 'Xóa địa điểm thành công'
        //                         }).then(() => {
        //                             location.reload();
        //                         });
        //                     } else {
        //                         Swal.fire({
        //                             icon: 'error',
        //                             title: 'Không thể xóa địa điểm!',
        //                             text: 'Đã xảy ra lỗi, vui lòng kiểm tra lại.'
        //                         });
        //                     }
        //                 },
        //                 error: function(xhr) {
        //                     console.log(xhr)
        //                 }
        //             });
        //         }
        //     });
        // }

        function deletePlace(id, name_place) {
            event.preventDefault();
            var form = $('#deleteForm-' + id);
            var url = form.attr('action');
            var csrfToken = $('input[name="_token"]').val();
            Swal.fire({
                title: 'Xóa địa điểm này?',
                text: "Thông tin địa điểm " + name_place + " sẽ được xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Đang xử lý...',
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
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        beforeSend: function() {
                            Swal.showLoading();
                        },
                        success: function(response) {
                            Swal.close();
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Đã xóa!',
                                    text: 'Xóa địa điểm thành công'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Không thể xóa địa điểm!',
                                    text: 'Đã xảy ra lỗi, vui lòng kiểm tra lại.'
                                });
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr);
                        }
                    });
                }
            });
        }
        var myEditorSend;
        var myViewSend;
        //Get View Modal
        function getDetailPlace(event, element) {
            event.preventDefault();
            var url = $(element).attr('href');

            // Tạo CKEditor nếu chưa tồn tại
            if (!myViewSend) {
                ClassicEditor
                    .create(document.querySelector('#viewCKeditor'))
                    .then(newEditor1 => {
                        myViewSend = newEditor1;
                        fetchDetailData(url);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                fetchDetailData(url);
            }
        }

        function fetchDetailData(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // console.log(response);
                    var detailData = response.vlplace[0];

                    // $('#id_view_price').val(detailData.id_price);
                    // console.log(detailData.id_area);
                    $('#id_view_price').val(detailData.id_price).trigger('change');
                    $('#id_view_area').val(detailData.id_area).trigger('change');
                    $('#id_view_type').val(detailData.id_type).trigger('change');
                    $('#type_view_service').val(detailData.type_service).trigger('change');
                    $('#name_view_place').val(detailData.name_place);
                    $('#address_view_place').val(detailData.address_place);
                    $('#phone_view_place').val(detailData.phone_place);
                    $('#start_view_time').val(detailData.start_time);
                    $('#end_view_time').val(detailData.end_time);
                    $('#email_view_contact_place').val(detailData.email_contact_place);
                    // Gán dữ liệu vào CKEditor
                    myViewSend.setData(detailData.describe_place);

                    $('#detailPlaceModal').modal('show');
                },
                error: function() {
                    // Xử lý lỗi (nếu cần)
                }
            });
        }

        //Get Edit Modal
        function getEditDetailPlace(event, element, id) {
            event.preventDefault();
            var url = $(element).attr('href');
            // Tạo CKEditor nếu chưa tồn tại
            if (!myEditorSend) {
                ClassicEditor
                    .create(document.querySelector('#editCKeditor'))
                    .then(newEditor => {
                        fetchEditDetailData(url);
                        myEditorSend = newEditor;
                        // fetchEditDetailData(url);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                fetchEditDetailData(url);
            }
        }

        function fetchEditDetailData(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // console.log(response);
                    var detailData = response.vlplace[0];

                    // $('#id_view_price').val(detailData.id_price);
                    // console.log(detailData.id_area);
                    id = detailData.id_place;
                    $('#id_edit_price').val(detailData.id_price).trigger('change');
                    $('#id_edit_area').val(detailData.id_area).trigger('change');
                    $('#id_edit_type').val(detailData.id_type).trigger('change');
                    $('#type_edit_service').val(detailData.type_service).trigger('change');
                    $('#name_edit_place').val(detailData.name_place);
                    $('#address_edit_place').val(detailData.address_place);
                    $('#phone_edit_place').val(detailData.phone_place);
                    $('#start_edit_time').val(detailData.start_time);
                    $('#end_edit_time').val(detailData.end_time);
                    $('#email_edit_contact_place').val(detailData.email_contact_place);
                    // Gán dữ liệu vào CKEditor
                    myEditorSend.setData(detailData.describe_place);

                    $('#editPlaceModal').modal('show');
                },
                error: function() {
                    // Xử lý lỗi (nếu cần)
                }
            });
        }
    </script>

    <!-- IE Support -->
    <script>
        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write(
            '<script src="./assets/vendor/babel-polyfill/polyfill.min.js"><\/script>');
    </script>
</body>

</html>
