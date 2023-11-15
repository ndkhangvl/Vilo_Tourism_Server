<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('/components.constraint')
    <title>Tài khoản</title>
</head>

<body>
    @include('/components.header_home')
    <div class="container md:pt-6 md:px-56 mx-auto sm:w-750 md:w-970 lg:w-1170">
        <div class="p-2 border shadow mb-4">
            <h1 class="text-2xl text-black font-bold text-center">Thông tin tài khoản</h1>
            <hr class="m-2 mx-auto w-24 h-1 bg-green-700" />
            <p class="text-xl">Họ tên: <span class="text-2xl">{{ auth()->user()->name }}</span></p>
            <p class="text-xl">Email: <span class="text-2xl">{{ auth()->user()->email }}</span></p>
            <p class="text-xl">Ngày tạo: <span class="text-2xl">{{ auth()->user()->created_at }}</span></p>

            <div class="flex justify-center gap-2">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    onclick="changeInfo()">Đổi thông tin</button>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    onclick="changePassword()">Đổi mật khẩu</button>
            </div>
        </div>
    </div>

    @include('/components.footer')
    <script>
        function changePassword() {

            var str = '<div class="form-group">' +
                '<div class="mb-4">' +
                '<label for="username" class="block text-sm font-medium text-gray-600">Mật khẩu cũ</label>' +
                '<input type="password" id="old_password" oninput="checkOldPassword()" name="old_password" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>' +
                '<span class="text-sm text-red-500" id="old_password_error"></span>' +
                '</div>' +
                '<div class="mb-4">' +
                '<label for="username" class="block text-sm font-medium text-gray-600">Mật khẩu mới</label>' +
                '<input type="password" id="new_password" oninput="checkNewPassword()" name="new_password" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>' +
                '<span class="text-sm text-red-500" id="new_password_error"></span>' +
                '</div>' +
                '<div class="mb-4">' +
                '<label for="username" class="block text-sm font-medium text-gray-600">Xác nhận mật khẩu mới</label>' +
                '<input type="password" id="confirm_password" oninput="checkConfirmPassword()" name="confirm_password" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>' +
                '<span class="text-sm text-red-500" id="confirm_password_error"></span>' +
                '</div>' +
                '</div>';
            Swal.fire({
                title: "Thay đổi mật khẩu",
                html: str,
                showDenyButton: true,
                confirmButtonText: "Lưu thay đổi",
                denyButtonText: "Thoát"
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    // Thực hiện Ajax request ở đây
                    // Ví dụ sử dụng jQuery để thực hiện Ajax
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '/change-password',
                        method: 'POST',
                        data: {
                            _token: csrfToken,
                            old_password: $('#old_password').val(),
                            new_password: $('#new_password').val(),
                            confirm_password: $('#confirm_password').val()
                        },
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Đã sửa!',
                                    text: 'Sửa thông tin thành công'
                                }).then(() => {
                                    location.reload();
                                });
                            } else if (response.success == false)
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Không thể sửa mật khẩu!',
                                    text: 'Mật khẩu cũ không đúng, vui lòng thực hiện lại.'
                                });
                        },
                        error: function(error) {
                            Swal.fire("Lỗi!", "Bạn đang bỏ trống.", "error");
                        }
                    });
                } else if (result.isDenied) {
                    // Swal.fire("Hủy thao tác", "", "info");
                }
            });
        }

        function changeInfo() {
            var str = '<div class="form-group">' +
                '<div class="mb-4">' +
                '<label for="username" class="block text-sm font-medium text-gray-600">Tên</label>' +
                '<input type="text" id="name_change" value="{{ auth()->user()->name }}" name="name_change" class="mt-1 p-2 border border-gray-300 rounded-md w-full">' +
                '</div>' +
                '<div class="mb-4">' +
                '<label for="username" class="block text-sm font-medium text-gray-600">Email</label>' +
                '<input type="email" id="email_change" value="{{ auth()->user()->email }}" name="email_change" class="mt-1 p-2 border border-gray-300 rounded-md w-full">' +
                '</div>' +
                '</div>';

            Swal.fire({
                title: "Thay đổi thông tin",
                html: str,
                showDenyButton: true,
                confirmButtonText: "Lưu thay đổi",
                denyButtonText: "Thoát"
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    // Thực hiện Ajax request ở đây
                    // Ví dụ sử dụng jQuery để thực hiện Ajax
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '/change-info',
                        method: 'POST',
                        data: {
                            _token: csrfToken,
                            name_change: $('#name_change').val(),
                            email_change: $('#email_change').val(),
                        },
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Đã sửa!',
                                    text: 'Sửa thông tin thành công'
                                }).then(() => {
                                    location.reload();
                                });
                            } else if (response.success == false)
                                Swal.fire("Lỗi!", "Bạn đang bỏ trống.", "error");
                        },
                        error: function(error) {
                            Swal.fire("Error!", "There was an error.", "error");
                        }
                    });
                } else if (result.isDenied) {
                    // Swal.fire("Hủy thao tác", "", "info");
                }
            });
        }

        function checkOldPassword() {
            // Thực hiện kiểm tra validate cho mật khẩu cũ và cập nhật thông báo lỗi
            var oldPassword = document.getElementById('old_password').value;
            // Thêm logic kiểm tra và hiển thị thông báo lỗi
            // Ví dụ: (chỉ để minh họa)
            if (oldPassword.length < 6 || oldPassword.length > 50) {
                document.getElementById('old_password_error').innerText = 'Mật khẩu cũ phải có ít nhất 8 ký tự.';
            } else {
                document.getElementById('old_password_error').innerText = '';
            }
        }

        function checkNewPassword() {
            // Thực hiện kiểm tra validate cho mật khẩu cũ và cập nhật thông báo lỗi
            var newPassword = document.getElementById('new_password').value;
            // Thêm logic kiểm tra và hiển thị thông báo lỗi
            // Ví dụ: (chỉ để minh họa)
            if (newPassword.length < 6 || newPassword.length > 50) {
                document.getElementById('new_password_error').innerText = 'Mật khẩu mới phải có ít nhất 8 ký tự.';
            } else {
                document.getElementById('new_password_error').innerText = '';
            }
        }

        function checkConfirmPassword() {
            // Thực hiện kiểm tra validate cho mật khẩu cũ và cập nhật thông báo lỗi
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            // Thêm logic kiểm tra và hiển thị thông báo lỗi
            // Ví dụ: (chỉ để minh họa)
            if (confirmPassword !== newPassword) {
                document.getElementById('confirm_password_error').innerText = 'Không khớp với mật khẩu mới.';
            } else {
                document.getElementById('confirm_password_error').innerText = '';
            }
        }
    </script>
</body>

</html>
