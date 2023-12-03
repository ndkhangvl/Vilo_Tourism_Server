<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ trans('msg.register') }}</title>
    @include('/components.constraint')
</head>

<body>
    @include('/components.header_home')
    <main class="bg-slate-100 min-h-screen flex items-center justify-center p-8 md:p-0">
        <div
            class="bg-white shadow-lg flex flex-col items-center rounded-xl overflow-hidden lg:flex-row lg:w-2/3 2xl:w-1/2">

            <!-- form -->
            <div class="p-6 lg:w-1/2 sm:p-8">

                <h2 class="text-2xl text-center uppercase font-semibold mt-8 mb-6 text-gray-700">
                    {{ trans('msg.register') }}</h2>

                <form action="/register" method="POST" class="flex flex-col" id="sendRegister">
                    @csrf
                    <div id="input-field" class="flex flex-col mb-4 relative">
                        <i class="fi fi-rr-envelope absolute top-11 right-5 text-zinc-400"></i>
                        <label for="name" class="mb-2 text-gray-700">{{ trans('msg.uname') }} (<span
                                class="text-red-500">*</span>)</label>
                        <input type="name" name="name_register" id="name_register"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:border-blue-500 focus:outline-none">
                        <span class="text-bold text-red-700" id="name_register_error"></span>
                    </div>

                    <div id="input-field" class="flex flex-col mb-4 relative">
                        <i class="fi fi-rr-envelope absolute top-11 right-5 text-zinc-400"></i>
                        <label for="email" class="mb-2 text-gray-700">{{ trans('msg.email') }} (<span
                                class="text-red-500">*</span>)</label>
                        <input type="email" name="email_register" id="email_register"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:border-blue-500 focus:outline-none">
                        <span class="text-bold text-red-700" id="email_register_error"></span>
                    </div>

                    <div id="input-field" class="flex flex-col relative">
                        <i class="fi fi-rr-lock absolute top-11 right-5 text-zinc-400"></i>
                        <label for="Password" class="mb-2 text-gray-700">{{ trans('msg.password') }} (<span
                                class="text-red-500">*</span>)</label>
                        <input type="password" name="password_register" id="password_register"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:outline-none focus:border-blue-500">
                        <span class="text-bold text-red-700" id="password_register_error"></span>
                    </div>

                    <button
                        class="my-6 bg-blue-600 hover:bg-blue-700 text-white font-medium text-lg px-4 py-2 rounded-md">{{ trans('msg.register') }}</button>
                </form>

                <p class="text-gray-500">{{ trans('msg.yes_account') }} <a href="/login"
                        class="text-blue-500 font-semibold no-underline">{{ trans('msg.login') }}</a></p>

            </div>

            <!-- image -->
            <div class="w-1/2">
                <img src="https://thvl.vn/wp-content/uploads/2013/02/h%C3%ACnh-%C4%90%C3%A0i-v%E1%BB%81-%C4%91%C3%AAm_2M.jpg"
                    alt="" class="object-cover h-full w-full">
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
                        if (response.success == true) {
                            Swal.fire({
                                icon: 'success',
                                title: '{{ trans('msg.successful') }}',
                                text: '{{ trans('msg.success_register') }}'
                            }).then(() => {
                                window.location.href = '/login';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: '{{ trans('msg.error') }}',
                                text: '{{ trans('msg.have_error') }}'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        if (xhr.status === 422) {
                            $('#name_register_error').empty();
                            $('#email_register_error').empty();
                            $('#password_register_error').empty();
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
