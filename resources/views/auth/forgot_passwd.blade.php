<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    @include('/components.header_home')
    <main class="bg-slate-100 min-h-screen flex items-center justify-center p-8 md:p-0">
        <div
            class="bg-white shadow-lg flex flex-col items-center rounded-xl overflow-hidden lg:flex-row lg:w-2/3 2xl:w-1/2">

            <!-- form -->
            <div class="p-6 lg:w-1/2 sm:p-8">

                <h2 class="text-2xl text-center uppercase font-semibold mt-8 mb-6 text-gray-700">Quên mật khẩu</h2>

                <form action="/forgot-pass" method="POST" class="flex flex-col">
                    @csrf
                    <div id="input-field" class="flex flex-col mb-4 relative">
                        <i class="fi fi-rr-envelope absolute top-11 right-5 text-zinc-400"></i>
                        <label for="email" class="mb-2 text-gray-700">Email</label>
                        <input type="email" name="forgot_pass" id="forgot_pass" placeholder="email@gmail.com"
                            class="px-4 py-2 border-2 border-slate-300 rounded-md max-w-full focus:border-blue-500 focus:outline-none">
                        @error('forgot_pass')
                            <span class="text-danger" id="forgot_pass_error">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit"
                        class="my-6 bg-blue-600 hover:bg-blue-700 text-white font-medium text-lg px-4 py-2 rounded-md">Xác
                        nhận</button>
                </form>

                <p class="text-gray-500">Bạn không có tài khoản? <a href="/forgot-passwd"
                        class="text-blue-500 font-semibold no-underline">Xác nhận</a></p>

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
</body>

</html>
