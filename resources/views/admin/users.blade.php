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

    <!-- Sweetalrt -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>


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
                                    <a href="/admin/users/detail/{{ $vluser->id }}" class="view flex-grow-1"
                                        title="" data-toggle="tooltip" data-original-title="View"
                                        style="margin: 0 1px;" onclick="getDetailUser(event, this)"><i
                                            class="tio-visible-outlined"></i></a>
                                    <a href="/admin/users/detail/{{ $vluser->id }}" class="edit flex-grow-1"
                                        title="" data-toggle="tooltip" data-original-title="Edit"
                                        style="margin: 0 1px;"
                                        onclick="getEditDetailPlace(event,this,{{ $vluser->id }})"><i
                                            class="tio-edit text-warning"></i></a>
                                    <form id="deleteForm-{{ $vluser->id }}"
                                        action="/admin/users/delete/{{ $vluser->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" id="submitDel"
                                            onclick="deleteUser('{{ $vluser->id }}','{{ $vluser->email }}')"
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

    <!-- Modal View -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="detailModal"
        aria-hidden="true" id="detailUserModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title h4" id="detailModal">Thông tin người dùng</h5>
                    <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                        aria-label="Close">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" class="" method="POST" id="viewNews" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="label_view_title" class="font-weight-bold pr-2">Vai trò:</label>
                                {{-- <input type="text" name="view_name_user" id="view_name_user" class="form-control"
                                    placeholder="Nhập vào tên tin tức" readonly> --}}
                                <span class="" id="view_role_user"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="label_view_title" class="font-weight-bold">Tên người dùng</label>
                                <input type="text" name="view_name_user" id="view_name_user" class="form-control"
                                    placeholder="Nhập vào tên tin tức" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="label_view_title" class="font-weight-bold">Tên đăng nhập</label>
                                <input type="text" name="view_email_user" id="view_email_user"
                                    class="form-control" placeholder="Nhập vào tên tin tức" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="label_view_title" class="font-weight-bold">Ngày tạo</label>
                                <input type="text" name="view_date_user" id="view_date_user" class="form-control"
                                    placeholder="Nhập vào tên tin tức" readonly>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal Edit -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="detailModal"
        aria-hidden="true" id="editUserModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title h4" id="detailModal">Chỉnh sửa người dùng</h5>
                    <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                        aria-label="Close">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" class="" method="POST" id="editUser"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="label_view_title" class="font-weight-bold pr-2">Vai trò:</label>
                                <div class="flex flex-row flex-nowrap">
                                    <input type="radio" name="roleGroup" value="1" class="mr-2"><span
                                        class="badge badge-soft-success mr-4">Admin</span>
                                    <input type="radio" name="roleGroup" value="0" class="mr-2">
                                    <span class="badge badge-soft-primary mr-4">User</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="label_view_title" class="font-weight-bold">Tên người dùng</label>
                                <input type="text" name="edit_name_user" id="edit_name_user" class="form-control"
                                    placeholder="Nhập vào tên tin tức">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="label_view_title" class="font-weight-bold">Tên đăng nhập</label>
                                <input type="text" name="edit_email_user" id="edit_email_user"
                                    class="form-control" placeholder="Nhập vào tên tin tức">
                            </div>
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
            // var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
            //     select: {
            //         style: 'multi',
            //         selector: 'td:first-child input[type="checkbox"]',
            //         classMap: {
            //             checkAll: '#datatableCheckAll',
            //             counter: '#datatableCounter',
            //             counterInfo: '#datatableCounterInfo'
            //         }
            //     },
            //     language: {
            //         zeroRecords: '<div class="text-center p-4">' +
            //             '<img class="mb-3" src="./assets/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
            //             '<p class="mb-0">No data to show</p>' +
            //             '</div>'
            //     }
            // });

            // $('.js-datatable-filter').on('change', function() {
            //     var $this = $(this),
            //         elVal = $this.val(),
            //         targetColumnIndex = $this.data('target-column-index');

            //     datatable.column(targetColumnIndex).search(elVal).draw();
            // });

            // $('#datatableSearch').on('mouseup', function(e) {
            //     var $input = $(this),
            //         oldValue = $input.val();

            //     if (oldValue == "") return;

            //     setTimeout(function() {
            //         var newValue = $input.val();

            //         if (newValue == "") {
            //             // Gotcha
            //             datatable.search('').draw();
            //         }
            //     }, 1);
            // });

            // INITIALIZATION OF CLIPBOARD
            // =======================================================
            $('.js-clipboard').each(function() {
                var clipboard = $.HSCore.components.HSClipboard.init(this);
            });
        });
    </script>


    <script>
        //Function Ajax for Delete User
        function deleteUser(id, u_name) {
            event.preventDefault();
            var form = $('#deleteForm-' + id);
            var url = form.attr('action');
            var csrfToken = $('input[name="_token"]').val();
            Swal.fire({
                title: 'Xóa người dùng này?',
                text: "Người dùng " + u_name + " sẽ được xóa!",
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
                                    text: 'Xóa người dùng thành công'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Không thể xóa người dùng!',
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

        //Ajax for Edit User 
        $(document).ready(function() {
            $('#editUser').submit(function(event) {
                event.preventDefault();
                var csrfToken = $('input[name="_token"]').val();
                // Lấy dữ liệu từ form
                var formData = new FormData(this);
                console.log(formData.get('roleGroup'));
                // var ckEditorData = myEditorSend.getData();
                // formData.append('describe_edit_place', ckEditorData);
                Swal.fire({
                    title: 'Chỉnh sửa thông tin người dùng này?',
                    text: "Thông tin người dùng " + uName +
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
                            url: '/admin/users/edit/' +
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
                                        text: 'Chỉnh sửa người dùng thành công'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Không thể sửa người dùng!',
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

        //View Detail User
        function getDetailUser(event, element) {
            event.preventDefault();
            var url = $(element).attr('href');
            console.log(url);
            fetchUserData(url);
        }

        function fetchUserData(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    var detailData = response.vluser[0];
                    $('#view_name_user').val(detailData.name);
                    $('#view_email_user').val(detailData.email);
                    // $('#view_role_user').text(detailData.role);
                    console.log(detailData.created_at);
                    var formattedDate = moment(detailData.created_at).format('DD/MM/YYYY');
                    $('#view_date_user').val(formattedDate);

                    var roleValue = detailData.role;
                    var viewRoleUser = $('#view_role_user');

                    if (roleValue == 1) {
                        viewRoleUser.removeAttr('class');
                        viewRoleUser.text('Admin');
                        viewRoleUser.addClass('badge badge-soft-danger p-2');
                        // viewRoleUser.removeClass('badge-soft-success');
                        // viewRoleUser.removeClass('badge-soft-primary');
                    } else {
                        viewRoleUser.removeAttr('class');
                        viewRoleUser.text('User');
                        viewRoleUser.addClass('badge badge-soft-primary p-2');
                    }

                    $('#detailUserModal').modal('show');

                },
                error: function() {}
            });
        }


        //Get Edit Modal
        function getEditDetailPlace(event, element, id) {
            event.preventDefault();
            var url = $(element).attr('href');
            fetchEditDetailData(url);
        }

        function fetchEditDetailData(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // console.log(response);
                    var detailData = response.vluser[0];
                    id = detailData.id;
                    uName = detailData.name;
                    $('#edit_name_user').val(detailData.name);
                    $('#edit_email_user').val(detailData.email);
                    // $('#view_role_user').val(detailData.role);
                    $('input[name="roleGroup"]').filter('[value="' + detailData.role + '"]').prop('checked',
                        true);
                    $('#editUserModal').modal('show');
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
