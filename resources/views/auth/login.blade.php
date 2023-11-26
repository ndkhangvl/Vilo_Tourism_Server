<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ trans('msg.login') }}</title>
    @include('/components.constraint')
</head>

<body>
    @include('/components.header_home')
    <main class="bg-slate-100 min-h-screen flex items-center justify-center p-8 md:p-0">
        <div
            class="bg-white shadow-lg flex flex-col items-center rounded-xl overflow-hidden lg:flex-row lg:w-2/3 2xl:w-1/2">

            <!-- form -->
            <div class="p-6 lg:w-1/2 sm:p-8">

                <h2 class="text-2xl text-center uppercase font-semibold mt-8 mb-6 text-gray-700">{{ trans('msg.login') }}
                </h2>

                <form action="/login" method="POST" class="flex flex-col" id="sendLogin">
                    @csrf
                    <div id="input-field" class="flex flex-col mb-4 relative">
                        <i class="fi fi-rr-envelope absolute top-11 right-5 text-zinc-400"></i>
                        <label for="email" class="mb-2 text-gray-700">{{ trans('msg.email') }}</label>
                        <input type="email" name="email" id="email" placeholder="email@gmail.com"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:border-blue-500 focus:outline-none">
                        <span class="text-bold text-red-700" id="email_error"></span>
                    </div>

                    <div id="input-field" class="flex flex-col relative">
                        <i class="fi fi-rr-lock absolute top-11 right-5 text-zinc-400"></i>
                        <label for="Password" class="mb-2 text-gray-700">{{ trans('msg.password') }}</label>
                        <input type="password" name="password" id="password" placeholder="*********"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:outline-none focus:border-blue-500">
                        <span class="text-bold text-red-700" id="password_error"></span>
                    </div>
                    <a href="/forgot-passwd"
                        class="text-blue-500 font-semibold no-underline text-right">{{ trans('msg.forgotpassword') }}</a>
                    <button type="submit"
                        class="my-6 bg-blue-600 hover:bg-blue-700 text-white font-medium text-lg px-4 py-2 rounded-md">{{ trans('msg.login') }}</button>
                </form>

                <p class="text-gray-500">{{ trans('msg.not_account') }}<a href="/register"
                        class="text-blue-500 font-semibold no-underline">{{ trans('msg.register') }}</a></p>

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
        //Ajax for login
        $(document).ready(function() {
            $(document).on('submit', '#sendLogin', function(event) {
                event.preventDefault();
                var csrfToken = $('input[name="_token"]').val();
                // Lấy dữ liệu từ form
                var formData = new FormData(this);
                $.ajax({
                    url: '/login',
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
                        Swal.fire({
                            icon: 'success',
                            title: '{{ trans('msg.successful') }}',
                            text: '{{ trans('msg.success_login') }}'
                        }).then(() => {
                            location.reload();
                        });
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
