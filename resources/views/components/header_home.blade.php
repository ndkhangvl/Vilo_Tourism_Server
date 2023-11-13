<!-- Main navigation container -->
<style>
    .hover-bounce {
        transition: border-bottom 0.3s ease-in-out;
        /* Thời gian và hiệu ứng transition */
    }

    .hover-bounce:hover {
        border-bottom-width: 2px;
        /* Chiều rộng của thanh gạch dưới khi hover */
    }
</style>
<nav class="relative flex w-full flex-wrap items-center justify-between bg-[#FBFBFB] py-2 text-neutral-500 shadow-lg hover:text-neutral-700 focus:text-neutral-700 dark:bg-neutral-600 lg:py-4"
    data-te-navbar-ref>
    <div class="flex w-full flex-wrap items-center justify-between px-3">
        <div>
            <a class="mx-2 my-1 flex items-center text-neutral-900 hover:text-neutral-900 focus:text-neutral-900 lg:mb-0 lg:mt-0"
                href="/">
                <img class="mr-2"
                    src="https://media.vnptit3.vn/resources/portal//Images/VLG/superadminportal.vlg/Logo/logongangvinhlong214x74_vlg_636838381478241361.png"
                    style="height: 50px" alt="TE Logo" loading="lazy" />
            </a>
        </div>
        <!-- Hamburger button for mobile view -->
        <button
            class="block border-0 bg-transparent px-2 text-neutral-500 hover:no-underline hover:shadow-none focus:no-underline focus:shadow-none focus:outline-none focus:ring-0 dark:text-neutral-200 lg:hidden"
            type="button" data-te-collapse-init data-te-target="#navbarSupportedContent4"
            aria-controls="navbarSupportedContent4" aria-expanded="false" aria-label="Toggle navigation">
            <!-- Hamburger icon -->
            <span class="[&>svg]:w-7">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-7 w-7">
                    <path fill-rule="evenodd"
                        d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </button>

        <!-- Collapsible navbar container -->
        <div class="!visible mt-2 hidden flex-grow basis-[100%] items-center lg:mt-0 lg:!flex lg:basis-auto"
            id="navbarSupportedContent4" data-te-collapse-item>
            <!-- Left links -->
            <ul class="list-style-none mr-auto flex flex-col pl-0 lg:mt-1 lg:flex-row" data-te-navbar-nav-ref>
                <!-- Home link -->
                <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                    <a class="font-bold text-neutral-500 hover-bounce hover:border-b border-gray-500 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
                        aria-current="page" href="/" data-te-nav-link-ref>Trang chủ</a>
                </li>
                <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                    <a class="font-bold text-neutral-500 hover-bounce hover:border-b border-gray-500 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
                        aria-current="page" href="/introduction" data-te-nav-link-ref>Giới thiệu</a>
                </li>
                <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                    <a class="font-bold text-neutral-500 hover-bounce hover:border-b border-gray-500 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
                        aria-current="page" href="/list-news" data-te-nav-link-ref>Tin tức</a>
                </li>
                <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                    <a class="font-bold text-neutral-500 hover-bounce hover:border-b border-gray-500 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
                        aria-current="page" href="/recommend-place" onclick="checkLogin()" data-te-nav-link-ref>Gợi
                        ý</a>
                </li>
                <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                    <a class="font-bold text-neutral-500 hover-bounce hover:border-b border-gray-500 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
                        aria-current="page" href="/list-place" data-te-nav-link-ref>Điểm đến</a>
                </li>
                {{-- <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                    <a class="font-bold text-neutral-500 hover-bounce hover:border-b border-gray-500 focus:text-neutral-700 disabled:text-black/30 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
                        aria-current="page" href="#" data-te-nav-link-ref>Lịch trình</a>
                </li> --}}
            </ul>

            <div class="flex items-center">
                @if (auth()->check())
                    <p>Welcome, <span class="font-bold" style="color: green;">
                            {{ auth()->user()->name }}</span>
                    </p>
                    <a href="/logout">Đăng xuất</a>
                @else
                    <a href="/login"
                        class="mr-3 inline-block rounded px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:bg-neutral-100 hover:text-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:text-primary-700 motion-reduce:transition-none">
                        Đăng nhập
                    </a>
                    <a href="/register"
                        class="mr-3 inline-block rounded bg-emerald-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-emerald-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-emerald-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] hover:text-white">
                        Đăng kí
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>
<script>
    function checkLogin() {
        event.preventDefault()
        $.ajax({
            url: "/login-check",
            method: 'GET',
            success: function(response) {
                console.log(response.message);
                if (response.message === 'Authenticated.') {
                    // Người dùng đã đăng nhập, chuyển hướng đến /recommend-place
                    window.location.href = "/recommend-place";
                } else {
                    // Người dùng chưa đăng nhập
                    Swal.fire('Thông báo', 'Bạn chưa đăng nhập.', 'error');
                }
            },
            error: function(error) {
                // Xử lý lỗi
                Swal.fire('Thông báo', 'Bạn chưa đăng nhập.', 'error');
            }
        });
    }
</script>
