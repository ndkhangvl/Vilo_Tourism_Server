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

    <!-- Magnific Popup Picture -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/js/lightbox.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/css/lightbox.min.css" rel="stylesheet">

    {{-- <link rel="stylesheet" href="../node_modules/select2/dist/css/select2.min.css"> --}}
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
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="addPlaceModal"
        aria-hidden="true" id="addPlaceModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title h4" id="addModal">Thêm mới địa điểm</h5>
                    <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                        aria-label="Close">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" class="" method="POST" id="addPlace" enctype="multipart/form-data">
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
                                <label for="type_service">Đặc trưng dịch vụ</label>
                                <input type="text" name="name_type_service" id="name_type_service"
                                    class="form-control" placeholder="Nhập vào đặc trưng">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name_place">Tên địa điểm</label>
                                <input type="text" name="name_place" id="name_place" class="form-control"
                                    placeholder="Nhập vào tên địa điểm">
                                <span class="invalid-feedback" id="name_place_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="address_place">Địa chỉ</label>
                                <input type="text" name="address_place" id="address_place" class="form-control"
                                    placeholder="Nhập vào địa chỉ">
                                <span class="invalid-feedback" id="address_place_error"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phone_place">Số điện thoại</label>
                                <input type="text" name="phone_place" id="phone_place" class="form-control"
                                    placeholder="Nhập vào số điện thoại">
                                <span class="invalid-feedback" id="phone_place_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="start_time">Thời gian mở cửa</label>
                                <input type="text" name="start_time" id="start_time" class="form-control"
                                    placeholder="Nhập thời gian mở cửa">
                                <span class="invalid-feedback" id="start_time_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="end_time">Thời gian đóng cửa</label>
                                <input type="text" name="end_time" id="end_time" class="form-control"
                                    placeholder="Nhập thời gian đóng cửa">
                                <span class="invalid-feedback" id="end_time_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email_contact_place">Email</label>
                            <input type="text" name="email_contact_place" id="email_contact_place"
                                class="form-control" placeholder="Nhập vào email">
                            <span class="invalid-feedback" id="email_contact_place_error"></span>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="lat_place" class="font-weight-bold">Vĩ độ</label>
                                <input type="text" name="latitude_place" id="latitude_place" class="form-control"
                                    placeholder="Nhập vĩ độ">
                                <span class="invalid-feedback" id="latitude_place_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="long_place" class="font-weight-bold">Kinh độ</label>
                                <input type="text" name="longitude_place" id="longitude_place"
                                    class="form-control" placeholder="Nhập kinh độ">
                                <span class="invalid-feedback" id="longitude_place_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="describe_place">Mô tả</label>
                            <textarea id="addCKeditor" class="form-control" name="describe_place"></textarea>
                            <span class="invalid-feedback" id="describe_place_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="file_input">Upload file</label>
                            <input class="js-dropzone dropzone-custom custom-file-boxed dz-clickable" id="file_input"
                                type="file" name="image">
                        </div>
                        <div class="form-group">
                            <button data-modal-hide="defaultModal" type="submit" class="btn btn-primary">Thêm
                                mới</button>
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
        <div class="modal-dialog modal-xl" role="document">
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
                        <form action="" class="" method="POST" id="viewPlace"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="label_view_area"><span class="font-weight-bold">Khu
                                                    vực</span></label>
                                            <select id="id_view_area" name="id_view_area"
                                                class="js-select2-custom1 custom-select" size="1"
                                                style="opacity: 0;"
                                                data-hs-select2-options='{
          "minimumResultsForSearch": "Infinity"
        }'
                                                disabled>
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
                                        <div class="form-group col-md-6">
                                            <label for="id_view_price"><span class="font-weight-bold">Loại
                                                    giá</span></label>
                                            <select id="id_view_price" name="id_view_price"
                                                class="js-select2-custom1 custom-select" size="1"
                                                style="opacity: 0;"
                                                data-hs-select2-options='{
          "minimumResultsForSearch": "Infinity"
        }'
                                                disabled>
                                                <option value="3000">Miễn phí</option>
                                                <option value="3001">Có phí</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="id_view_type"><span class="font-weight-bold">Loại hình dịch
                                                    vụ</span></label>
                                            <select id="id_view_type" name="id_view_type"
                                                class="js-select2-custom1 custom-select" size="1"
                                                style="opacity: 0;"
                                                data-hs-select2-options='{
          "minimumResultsForSearch": "Infinity"
        }'
                                                disabled>
                                                <option value="4000">Du lịch sinh thái</option>
                                                <option value="4001">Du lịch làng nghề</option>
                                                <option value="4002">Du lịch lịch sử - văn hóa</option>
                                                <option value="4003">Du lịch tâm linh</option>
                                                <option value="4004">Du lịch trở về nguồn cội</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="type_view_service"><span class="font-weight-bold">Loại du
                                                    lịch</span></label>
                                            <select id="type_view_service" class="js-select2-custom1 custom-select"
                                                size="1" style="opacity: 0;"
                                                data-hs-select2-options='{
          "minimumResultsForSearch": "Infinity"
        }'
                                                disabled>
                                                <option value="2000">Trò chơi trong nhà</option>
                                                <option value="2001">Chèo xuồng</option>
                                                <option value="2002">Tát ao bắt cá</option>
                                                <option value="2003">Đạp vịt</option>
                                                <option value="2004">Cửa hàng lưu niệm</option>
                                                <option value="2005">Câu cá sấu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name_place"><span class="font-weight-bold">Tên địa
                                                    điểm</span></label>
                                            <input type="text" name="name_view_place" id="name_view_place"
                                                class="form-control" placeholder="Nhập vào tên địa điểm" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="label_address_place"><span class="font-weight-bold">Địa
                                                    chỉ</span></label>
                                            <input type="text" name="address_view_place" id="address_view_place"
                                                class="form-control" placeholder="Nhập vào địa chỉ" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="start_time"><span class="font-weight-bold">Thời gian mở
                                                    cửa</span></label>
                                            <input type="text" name="start_view_time" id="start_view_time"
                                                class="form-control" placeholder="Nhập thời gian mở cửa" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="end_time"><span class="font-weight-bold">Thời gian đóng
                                                    cửa</span></label>
                                            <input type="text" name="end_view_time" id="end_view_time"
                                                class="form-control" placeholder="Nhập thời gian đóng cửa" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="label_phone_place"><span class="font-weight-bold">Số điện
                                                    thoại</span></label>
                                            <input type="text" name="phone_view_place" id="phone_view_place"
                                                class="form-control" placeholder="Nhập vào số điện thoại" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email_contact_place"><span
                                                    class="font-weight-bold">Email</span></label>
                                            <input type="email" name="email_view_contact_place"
                                                id="email_view_contact_place" class="form-control"
                                                placeholder="Nhập vào email" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="lat_view_place" class="font-weight-bold">Vĩ độ</label>
                                            <input type="text" name="latitude_view_place" id="latitude_view_place"
                                                class="form-control" placeholder="Nhập vĩ độ" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="long_view_place" class="font-weight-bold">Kinh độ</label>
                                            <input type="text" name="longitude_view_place"
                                                id="longitude_view_place" class="form-control"
                                                placeholder="Nhập kinh độ" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a class="example-image-link picture-view-from-firebase" href=""
                                        data-lightbox="example-set-1" data-title=""><img class="example-image"
                                            src="" alt="" style="width: 50px; height: 50px" /></a>
                                    <div class="form-group">
                                        <label for="describe_place">Mô tả</label>
                                        {{-- <textarea id="viewCKeditor" class="form-control" name="describe_view_place"></textarea> --}}
                                        <div id="showDescribe" class="p-2 border rounded-sm"
                                            style="height: 425px; overflow: auto;">
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <label for="type_service">Đặc trưng dịch vụ</label>
                                <input type="text" name="name_edit_type_service" id="name_edit_type_service"
                                    class="form-control" placeholder="Nhập vào đặc trưng">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name_place">Tên địa điểm</label>
                                <input type="text" name="name_edit_place" id="name_edit_place"
                                    class="form-control" placeholder="Nhập vào tên địa điểm">
                                <span class="invalid-feedback" id="name_edit_place_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="address_place">Địa chỉ</label>
                                <input type="text" name="address_edit_place" id="address_edit_place"
                                    class="form-control" placeholder="Nhập vào địa chỉ">
                                <span class="invalid-feedback" id="address_edit_place_error"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phone_place">Số điện thoại</label>
                                <input type="text" name="phone_edit_place" id="phone_edit_place"
                                    class="form-control" placeholder="Nhập vào số điện thoại">
                                <span class="invalid-feedback" id="phone_edit_place_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="start_time">Thời gian mở cửa</label>
                                <input type="text" name="start_edit_time" id="start_edit_time"
                                    class="form-control" placeholder="Nhập thời gian mở cửa">
                                <span class="invalid-feedback" id="start_edit_time_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="end_time">Thời gian đóng cửa</label>
                                <input type="text" name="end_edit_time" id="end_edit_time" class="form-control"
                                    placeholder="Nhập thời gian đóng cửa">
                                <span class="invalid-feedback" id="end_edit_time_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email_contact_place">Email</label>
                            <input type="email" name="email_edit_contact_place" id="email_edit_contact_place"
                                class="form-control" placeholder="Nhập vào email">
                            <span class="invalid-feedback" id="email_edit_contact_place_error"></span>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="start_time">Vĩ độ</label>
                                <input type="text" name="edit_latitude_place" id="edit_latitude_place"
                                    class="form-control" placeholder="Nhập vĩ độ">
                                <span class="invalid-feedback" id="edit_latitude_place_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="start_time">Kinh độ</label>
                                <input type="text" name="edit_longitude_place" id="edit_longitude_place"
                                    class="form-control" placeholder="Nhập kinh độ">
                                <span class="invalid-feedback" id="edit_longitude_place_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="describe_place">Mô tả</label>
                            <textarea id="editCKeditor" class="form-control" name="editCKeditor"></textarea>
                            <span class="invalid-feedback" id="describe_edit_place_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="image_url">Đường dẫn hình</label>
                            {{-- <input type="text" name="image_edit_url" id="image_edit_url" class="form-control"
                                placeholder=""> --}}
                            <a class="example-image-link picture-from-firebase" href=""
                                data-lightbox="example-set" data-title=""><img class="example-image" src=""
                                    alt="" style="width: 50px; height: 50px" /></a>
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
    {{-- <script src="../node_modules/select2/dist/js/select2.full.min.js"></script> --}}



    <!-- JS Front -->
    <script src="\..\assets\js\theme.min.js"></script>
    {{-- <script src="\..\assets/js/hs.select2.js"></script> --}}

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
                .create(document.querySelector('#addCKeditor'), {
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            '|',
                            'bulletedList',
                            'numberedList',
                            '|',
                            'blockQuote',
                            '|',
                            'undo',
                            'redo'
                        ]
                    },
                })
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
        //Ajax for Add Place 
        $(document).ready(function() {
            $(document).on('submit', '#addPlace', function(event) {
                event.preventDefault();
                var csrfToken = $('input[name="_token"]').val();
                // Lấy dữ liệu từ form
                var formData = new FormData(this);
                // var ckEditorData = myEditorSend.getData();
                // formData.append('describe_edit_place', ckEditorData);
                Swal.fire({
                    title: 'Xác nhận thêm thông tin địa điểm này?',
                    // text: "Thông tin địa điểm " + $('#name_edit_place').val() +
                    //     " sẽ được chỉnh sửa!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#35A745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Xác nhận',
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
                            url: '/admin/place/add/',
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
                                        title: 'Đã thêm!',
                                        text: 'Thêm địa điểm thành công'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Không thể thêm địa điểm!',
                                        text: 'Đã xảy ra lỗi, vui lòng kiểm tra lại.'
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.close();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: 'Có lỗi xảy ra trong quá trình xử lý, vui lòng thực hiện lại sau'
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

        //Ajax for Edit Place
        $(document).ready(function() {
            $('#editPlace').submit(function(event) {
                event.preventDefault();
                var csrfToken = $('input[name="_token"]').val();
                // Lấy dữ liệu từ form
                var formData = new FormData(this);
                var ckEditorData = myEditorSend.getData();
                formData.append('describe_edit_place', ckEditorData);
                Swal.fire({
                    title: 'Chỉnh sửa thông tin địa điểm này?',
                    text: "Thông tin địa điểm " + $('#name_edit_place').val() +
                        " sẽ được chỉnh sửa!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#35A745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Xác nhận',
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
                            url: '/admin/place/edit/' +
                                id, // Đường dẫn URL để gửi Ajax request
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
                                        title: 'Đã sửa!',
                                        text: 'Chỉnh sửa địa điểm thành công'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Không thể sửa địa điểm!',
                                        text: 'Đã xảy ra lỗi, vui lòng kiểm tra lại.'
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.close();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: 'Có lỗi xảy ra trong quá trình xử lý, vui lòng thực hiện lại sau'
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

        //Function Ajax for Delete Place
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

        //All Modal for Place Admin
        var myEditorSend;
        var myViewSend;
        //Get View Modal
        function getDetailPlace(event, element) {
            event.preventDefault();
            var url = $(element).attr('href');
            fetchDetailData(url);
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

                    $('#latitude_view_place').val(detailData.latitude);
                    $('#longitude_view_place').val(detailData.longitude);

                    $('#showDescribe').html(detailData.describe_place);
                    var thumbnailLinkView = $('.picture-view-from-firebase');
                    if (!detailData.image_url) {
                        thumbnailLinkView.hide();
                    } else {
                        thumbnailLinkView.attr('href', detailData.image_url);
                        thumbnailLinkView.find('img').attr('src', detailData.image_url);
                        thumbnailLinkView.show();
                    }
                    // Gán dữ liệu vào CKEditor
                    //myViewSend.setData(detailData.describe_place);

                    $('#detailPlaceModal').modal('show');

                },
                error: function() {}
            });
        }

        //Get Edit Modal
        function getEditDetailPlace(event, element, id) {
            event.preventDefault();
            var url = $(element).attr('href');
            var fileInput = document.getElementById('file_edit_input');
            fileInput.value = '';
            fetchEditDetailData(url);
            // $('.picture-from-firebase').magnificPopup({
            //     type: 'image'
            //     // other options
            // });
        }

        function setCKEditorData(data) {
            if (myEditorSend) {
                if (data !== null && data !== undefined) {
                    myEditorSend.setData(data);
                } else {
                    myEditorSend.setData('');
                }
            }
        }

        function fetchEditDetailData(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // console.log(response);
                    $('.invalid-feedback').empty();
                    var detailData = response.vlplace[0];
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

                    $('#edit_latitude_place').val(detailData.latitude);
                    $('#edit_longitude_place').val(detailData.longitude);
                    // $('#image_edit_url').val(detailData.image_url);
                    var thumbnailLink = $('.picture-from-firebase');
                    if (!detailData.image_url) {
                        thumbnailLink.hide();
                    } else {
                        thumbnailLink.attr('href', detailData.image_url);
                        thumbnailLink.find('img').attr('src', detailData.image_url);
                        thumbnailLink.show();
                    }
                    // Gán dữ liệu vào CKEditor
                    //myEditorSend.setData(detailData.describe_place);
                    // console.log(myEditorSend.setData(detailData.describe_place));
                    if (!myEditorSend) {
                        ClassicEditor
                            .create(document.querySelector('#editCKeditor'), {
                                toolbar: {
                                    items: [
                                        'heading',
                                        '|',
                                        'bold',
                                        'italic',
                                        '|',
                                        'bulletedList',
                                        'numberedList',
                                        '|',
                                        'blockQuote',
                                        '|',
                                        'undo',
                                        'redo'
                                    ]
                                },
                            })
                            .then(newEditor => {
                                myEditorSend = newEditor;
                                setCKEditorData(detailData.describe_place);
                            })
                            .catch(error => {
                                console.error(error);
                            });
                        // console.log(myEditorSend.getData());
                    } else {
                        setCKEditorData(detailData.describe_place);
                        // console.log(myEditorSend.getData());
                    }
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
