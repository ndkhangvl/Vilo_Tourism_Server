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
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('/../assets/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/../assets/vendor/icon-set/style.css') }}">
    {{-- <link rel="stylesheet" href="../node_modules/select2/dist/css/select2.min.css"> --}}
    {{-- {{-- <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}"> --}}

    <!-- Sweetalrt -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Lightbox -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/js/lightbox.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/css/lightbox.min.css" rel="stylesheet">

    {{-- <script src="{{ asset('js/select2.min.js') }}"></script> --}}
    <style>
        .ck.ck-content:not(.ck-comment__input *) {
            min-height: 300px;
            overflow-y: auto;
        }
    </style>


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
            <button id="openModalAdd" data-toggle="modal" data-target="#addNewsModal"
                class="btn btn-primary btn-lg px-3 py-2">
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
                            <th class="p-2 text-center">Tên tin</th>
                            <th class="p-2 text-center">Nội dung</th>
                            <th class="p-2 text-center">Ngày viết</th>
                            <th class="p-2 text-center">Số lượt view</th>
                            <th class="p-2 text-center" style="width: 100px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vlnews as $vlnew)
                            <tr>
                                <td class="text-center align-middle">{{ $vlnew->id_new }}</td>
                                <td class="text-center text-truncate align-middle" style="max-width: 200px">
                                    {{ $vlnew->title_new }}</td>
                                <td class="text-center text-truncate align-middle" style="max-width: 150px;">
                                    {{ $vlnew->content_new }}</td>
                                <td class="text-center align-middle">{{ $vlnew->date_post_new }}</td>
                                <td class="text-center align-middle">{{ $vlnew->view_new }}</td>
                                <td class="d-flex align-items-center">
                                    <a href="/admin/news/detail/{{ $vlnew->id_new }}" class="view flex-grow-1"
                                        title="" data-toggle="tooltip" data-original-title="View"
                                        style="margin: 0 1px;" onclick="getDetailNews(event,this)"><i
                                            class="tio-visible-outlined"></i></a>
                                    <a href="/admin/news/detail/{{ $vlnew->id_new }}" class="edit flex-grow-1"
                                        title="" data-toggle="tooltip" data-original-title="Edit"
                                        style="margin: 0 1px;" onclick="getEditNews(event,this, {{ $vlnew->id_new }})"
                                        data-id="{{ $vlnew->id_new }}"><i class="tio-edit text-warning"></i></a>
                                    <form id="deleteForm-{{ $vlnew->id_new }}"
                                        action="/admin/news/delete/{{ $vlnew->id_new }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" id="submitDel"
                                            onclick="deleteNews('{{ $vlnew->id_new }}','{{ $vlnew->title_new }}')"
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
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="addNewsModal"
        aria-hidden="true" id="addNewsModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title h4" id="addModal">Thêm mới tin</h5>
                    <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                        aria-label="Close">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" class="" method="POST" id="addNews" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="label_title" class="font-weight-bold">Tên tin tức</label>
                                <input type="text" name="title_news" id="title_news" class="form-control"
                                    placeholder="Nhập vào tên tin tức" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content_news_label" class="font-weight-bold">Nội dung</label>
                            <textarea id="addNewsCKEditor" class="form-control" name="content_news"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file_input" class="font-weight-bold">Hình thumbnail</label>
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
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="detailModal"
        aria-hidden="true" id="detailNewsModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title h4" id="detailModal">Chi tiết tin tức</h5>
                    <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                        aria-label="Close">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" class="" method="POST" id="viewNews"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="label_view_title" class="font-weight-bold">Tên tin tức</label>
                                <input type="text" name="view_title_news" id="view_title_news"
                                    class="form-control" placeholder="Nhập vào tên tin tức" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content_news_view_label" class="font-weight-bold">Nội dung</label>
                            {{-- <textarea id="addNewCKEditor" class="form-control" name="content_news"></textarea> --}}
                            <div id="showContent" class="p-2 border rounded-sm"
                                style="height: 300px; overflow: auto;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file_input" class="font-weight-bold">Hình thumbnail</label>
                            <a class="example-image-link picture-view-from-firebase" href=""
                                data-lightbox="example-set-1" data-title=""><img class="example-image"
                                    src="" alt="" style="width: 50px; height: 50px" /></a>
                            {{-- <input class="js-dropzone dropzone-custom custom-file-boxed dz-clickable" id="file_input"
                                type="file" name="image"> --}}
                        </div>
                        {{-- <div class="form-group">
                            <button data-modal-hide="defaultModal" type="submit" class="btn btn-primary">Thêm
                                mới</button>
                        </div> --}}
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal Edit News -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="editNewsModal"
        aria-hidden="true" id="editNewsModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title h4" id="editNewsModal">Chi tiết tin tức</h5>
                    <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                        aria-label="Close">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" class="" method="POST" id="editNews"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="label_view_title" class="font-weight-bold">Tên tin tức</label>
                                <input type="text" name="edit_title_news" id="edit_title_news"
                                    class="form-control" placeholder="Nhập vào tên tin tức">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content_news_edit_label">Mô tả</label>
                            <textarea id="editCKeditor" class="form-control" name="editCKeditor"></textarea>
                        </div>
                        {{-- <div class="form-group">
                            <label for="content_news_view_label" class="font-weight-bold">Nội dung</label>
                            <textarea id="addNewCKEditor" class="form-control" name="content_news"></textarea>
                            <div id="showContent" class="p-2 border rounded-sm"
                                style="height: 300px; overflow: auto;">
                            </div>
                        </div>  --}}
                        <div class="form-group">
                            <label for="file_input" class="font-weight-bold">Hình thumbnail</label>
                            <a class="example-image-link picture-from-firebase" href=""
                                data-lightbox="example-set" data-title=""><img class="example-image" src=""
                                    alt="" style="width: 50px; height: 50px" /></a>
                            {{-- <input class="js-dropzone dropzone-custom custom-file-boxed dz-clickable" id="file_input"
                                type="file" name="image"> --}}
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
                .create(document.querySelector('#addNewsCKEditor'), {
                    contentCss: [
                        '{{ asset('assets/css/ckeditor-tailwind-reset.css') }}',
                        // Thêm các đường dẫn CSS khác tại đây nếu cần
                    ]
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
        //Get Edit News Modal
        var myEditorSend;

        function getEditNews(event, element, id) {
            event.preventDefault();
            var url = $(element).attr('href');
            var fileInput = document.getElementById('file_edit_input');
            fileInput.value = '';
            // console.log(id);
            fetchEditDetailData(url);
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
                    var detailData = response.vlnews[0];
                    id = detailData.id_new;
                    nameNews = detailData.title_new;
                    $('#edit_title_news').val(detailData.title_new);

                    // $('#email_edit_contact_place').val(detailData.email_contact_place);
                    // $('#image_edit_url').val(detailData.image_url);
                    var thumbnailLink = $('.picture-from-firebase');
                    if (!detailData.image_url_new) {
                        thumbnailLink.hide();
                    } else {
                        thumbnailLink.attr('href', detailData.image_url_new);
                        thumbnailLink.find('img').attr('src', detailData.image_url_new);
                        thumbnailLink.show();
                    }
                    // Gán dữ liệu vào CKEditor
                    //myEditorSend.setData(detailData.describe_place);
                    // console.log(myEditorSend.setData(detailData.describe_place));
                    if (!myEditorSend) {
                        ClassicEditor
                            .create(document.querySelector('#editCKeditor'))
                            .then(newEditor => {
                                myEditorSend = newEditor;
                                setCKEditorData(detailData.content_new);
                            })
                            .catch(error => {
                                console.error(error);
                            });
                        // console.log(myEditorSend.getData());
                    } else {
                        setCKEditorData(detailData.content_new);
                        // console.log(myEditorSend.getData());
                    }
                    $('#editNewsModal').modal('show');
                },
                error: function() {
                    // Xử lý lỗi (nếu cần)
                }
            });
        }

        //View Detail News
        function getDetailNews(event, element) {
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
                    var detailData = response.vlnews[0];

                    // $('#id_view_price').val(detailData.id_price);
                    // console.log(detailData.id_area);
                    $('#view_title_news').val(detailData.title_new);
                    // $('#address_view_place').val(detailData.address_place);
                    // $('#phone_view_place').val(detailData.phone_place);
                    // $('#start_view_time').val(detailData.start_time);
                    // $('#end_view_time').val(detailData.end_time);
                    // $('#email_view_contact_place').val(detailData.email_contact_place);
                    $('#showContent').html(detailData.content_new);
                    var thumbnailLinkView = $('.picture-view-from-firebase');
                    if (!detailData.image_url_new) {
                        thumbnailLinkView.hide();
                    } else {
                        thumbnailLinkView.attr('href', detailData.image_url_new);
                        thumbnailLinkView.find('img').attr('src', detailData.image_url_new);
                        thumbnailLinkView.show();
                    }
                    // Gán dữ liệu vào CKEditor
                    //myViewSend.setData(detailData.describe_place);

                    $('#detailNewsModal').modal('show');

                },
                error: function() {}
            });
        }

        //Ajax for Add New News
        $(document).ready(function() {
            $(document).on('submit', '#addNews', function(event) {
                event.preventDefault();
                var csrfToken = $('input[name="_token"]').val();
                // Lấy dữ liệu từ form
                var formData = new FormData(this);
                Swal.fire({
                    title: 'Xác nhận thêm tin tức này?',
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
                            url: '/admin/news/add/',
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
                                        text: 'Thêm tin tức thành công'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Không thể thêm tin tức!',
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
            });
        });

        //Ajax for Edit News
        $(document).ready(function() {
            $('#editNews').submit(function(event) {
                event.preventDefault();
                var csrfToken = $('input[name="_token"]').val();
                // Lấy dữ liệu từ form
                var formData = new FormData(this);
                var ckEditorData = myEditorSend.getData();
                formData.append('content_edit_news', ckEditorData);
                Swal.fire({
                    title: 'Chỉnh sửa bài viết này?',
                    text: "Thông tin bài viết " + nameNews +
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
                            url: '/admin/news/edit/' +
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
                                        text: 'Chỉnh sửa bài viết thành công'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Không thể sửa bài viết!',
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
            });
        });

        //Function Ajax for Delete News
        function deleteNews(id, name_place) {
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

        // function getdetailNews(id) {
        //     $.ajax({
        //         url: '/admin/news/detail/' + id,
        //         type: 'GET',
        //         success: function(response) {
        //             console.log(response);
        //         },
        //         error: function() {
        //             // Xử lý lỗi
        //         }
        //     });
        // }
        $('#openModalAdd').click(function() {
            // Đặt lại giá trị của form
            $('#addNews')[0].reset();
            $("#addNewsCKEditor").val("");
            // Đặt lại CKEditor
        });
    </script>

    <!-- IE Support -->
    <script>
        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write(
            '<script src="./assets/vendor/babel-polyfill/polyfill.min.js"><\/script>');
    </script>
</body>

</html>
