<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @include('/components.constraint')
</head>

<body>
    @include('/components.header_home')
    <main class="bg-slate-100 min-h-screen flex items-center justify-center p-8 md:p-0">
        <div
            class="bg-white shadow-lg flex flex-col items-center rounded-xl overflow-hidden lg:flex-row lg:w-2/3 2xl:w-1/2">

            <!-- form -->
            <div class="p-6 lg:w-1/2 sm:p-8">

                <h2 class="text-2xl text-center uppercase font-semibold mt-8 mb-6 text-gray-700">Đăng ký</h2>

                <form action="/register" method="POST" class="flex flex-col" id="sendRegister">
                    @csrf
                    <div id="input-field" class="flex flex-col mb-4 relative">
                        <i class="fi fi-rr-envelope absolute top-11 right-5 text-zinc-400"></i>
                        <label for="name" class="mb-2 text-gray-700">Tên người dùng (<span
                                class="text-red-500">*</span>)</label>
                        <input type="name" name="name_register" id="name_register"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:border-blue-500 focus:outline-none">
                        <span class="text-bold text-red-700" id="name_register_error"></span>
                    </div>

                    <div id="input-field" class="flex flex-col mb-4 relative">
                        <i class="fi fi-rr-envelope absolute top-11 right-5 text-zinc-400"></i>
                        <label for="email" class="mb-2 text-gray-700">Email (<span
                                class="text-red-500">*</span>)</label>
                        <input type="email" name="email_register" id="email_register"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:border-blue-500 focus:outline-none">
                        <span class="text-bold text-red-700" id="email_register_error"></span>
                    </div>

                    <div id="input-field" class="flex flex-col relative">
                        <i class="fi fi-rr-lock absolute top-11 right-5 text-zinc-400"></i>
                        <label for="Password" class="mb-2 text-gray-700">Mật khẩu (<span
                                class="text-red-500">*</span>)</label>
                        <input type="password" name="password_register" id="password_register"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:outline-none focus:border-blue-500">
                        <span class="text-bold text-red-700" id="password_register_error"></span>
                    </div>

                    <button
                        class="my-6 bg-blue-600 hover:bg-blue-700 text-white font-medium text-lg px-4 py-2 rounded-md">Đăng
                        ký</button>
                </form>

                <p class="text-gray-500">Bạn có tài khoản? <a href="/login"
                        class="text-blue-500 font-semibold no-underline">Đăng nhập</a></p>

            </div>

            <!-- image -->
            <div class="w-1/2 p-2">
                <img src="https://baovinhlong.com.vn/dataimages/201905/original/images2202122_11__10_.jpg"
                    alt="" class="h-f lg:block hidden">

            </div>



        </div>
        </div>
    </main>
    @include('/components.footer')
    <script>
        //Ajax for register
        $(document).ready(function() {
            $(document).on('submit', '#sendRegister', function(event) {
                event.preventDefault();
                var csrfToken = $('input[name="_token"]').val();
                // Lấy dữ liệu từ form
                var formData = new FormData(this);
                $.ajax({
                    url: '/register',
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
                                title: 'Thành công!',
                                text: 'Đăng ký thành công'
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
            });
        });
    </script>
</body>

</html>
