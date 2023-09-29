<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('/components.constraint')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />

    {{-- @include('constraint') --}}
    <style>
        #main {
            padding-left: 300px;
        }
    </style>
</head>

<body>
    @include('/components.header')
    <div id="main">
        <div class="container bg-white shadow p-2">
            {{-- Modal --}}
            <button data-modal-target="extralarge-modal" data-modal-toggle="extralarge-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Thêm mới
            </button>
            <!-- Main modal -->
            <div id="extralarge-modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-4xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Thông tin địa điểm
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="extralarge-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <form action="/admin/place/add" class="" method="POST" id="addPlace"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-rows-3 grid-flow-col gap-4">
                                    <div>
                                        <label for="id_area"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Khu
                                            vực</label>
                                        <select id="id_area" name="id_area"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                                    <div>
                                        <label for="id_price"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại
                                            giá</label>
                                        <select id="id_price" name="id_price"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="3000">Miễn phí</option>
                                            <option value="3001">Có phí</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="id_type"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại
                                            dịch vụ</label>
                                        <select id="id_type" name="id_type"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="4000">Du lịch sinh thái</option>
                                            <option value="4001">Du lịch làng nghề</option>
                                            <option value="4002">Du lịch lịch sử - văn hóa</option>
                                            <option value="4003">Du lịch tâm linh</option>
                                            <option value="4004">Du lịch trở về nguồn cội</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="id_service"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại
                                            dịch vụ</label>
                                        <select id="type_service"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="1003">Miễn phí</option>
                                            <option value="1002">Có phí</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="name_place"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên
                                            địa
                                            điểm</label>
                                        <input type="text" name="name_place" id="name_place"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Nhập vào tên địa điểm" required>
                                    </div>
                                    <div>
                                        <label for="address_place"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Địa
                                            chỉ</label>
                                        <input type="text" name="address_place" id="address_place"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Nhập vào địa chỉ" required>
                                    </div>
                                    <div>
                                        <label for="phone_place"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Số
                                            điện
                                            thoại</label>
                                        <input type="text" name="phone_place" id="phone_place"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Nhập vào số điện thoại" required>
                                    </div>
                                    <div>
                                        <label for="time_open"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thời
                                            gian mở cửa</label>
                                        <input type="text" name="start_time" id="start_time"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Nhập thời gian mở cửa" required>
                                    </div>
                                    <div>
                                        <label for="time_close"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thời
                                            gian đóng cửa</label>
                                        <input type="text" name="end_time" id="end_time"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Nhâp thời gian đóng cửa" required>
                                    </div>
                                    <div>
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                        <input type="email" name="email_contact_place" id="email_contact_place"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Nhập vào email" required>
                                    </div>
                                </div>
                                <div>
                                    <label for="describe_place"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô
                                        tả</label>
                                    <textarea id="editor"
                                        class="bg-gray-50 border border-gray-300 w-full h-40 p-2 border border-gray-300 rounded-lg resize-none"
                                        name="describe_place"></textarea>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="file_input">Upload file</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input" type="file" name="image">
                                </div>
                                <div
                                    class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="defaultModal" type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                        accept</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table for VLPlace --}}
            <div class="overflow-x-auto p-3">
                <table class="border-collapse table-auto w-full">
                    <thead>
                        <tr>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600" style="width: 5%">STT
                            </th>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Tên địa điểm</th>
                            {{-- <th class="p-2 text-center whitespace-nowrap border text-blue-600">Địa chỉ</th> --}}
                            {{-- <th class="p-2 text-center whitespace-nowrap border text-blue-600">Thời gian mở cửa</th>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Thời gian đóng cửa</th> --}}
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Số điện thoại</th>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Email</th>
                            {{-- <th class="p-2 text-center whitespace-nowrap border text-blue-600">Mô tả địa điểm</th> --}}
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vlplaces as $vlplace)
                            <tr>
                                <td class="text-center align-middle border">{{ $vlplace->id_place }}</td>
                                <td class="text-center align-middle truncate border">{{ $vlplace->name_place }}</td>
                                {{-- <td class="text-center align-middle truncate ... border">
                                    {{ $vlplace->address_place }}
                                </td> --}}
                                {{-- <td class="text-center align-middle border">{{ $vlplace->start_time }}</td>
                                <td class="text-center align-middle border">{{ $vlplace->end_time }}</td> --}}
                                <td class="text-center align-middle border">{{ $vlplace->phone_place }}</td>
                                <td class="text-center align-middle border">{{ $vlplace->email_contact_place }}</td>
                                {{-- <td class="text-center align-middle truncate border">{{ $vlplace->describe_place }} --}}
                                </td>
                                <td class="border p-2">
                                    <a href="/admin/place/{{ $vlplace->id_place }}">
                                        <button type="button"
                                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Chi tiết
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function dropDown() {
                document.querySelector('#submenu').classList.toggle('hidden')
                document.querySelector('#arrow').classList.toggle('rotate-0')
            }
            dropDown()

            function Openbar() {
                var sidebar = document.querySelector('.sidebar');
                var main = document.querySelector('#main');

                // Kiểm tra nếu sidebar đang có class 'left-[-300px]'
                if (sidebar.classList.contains('left-[-300px]')) {
                    sidebar.classList.remove('left-[-300px]');
                    sidebar.style.left = '0px';
                    main.style.left = '0px';
                    main.style.paddingLeft = '300px';
                } else {
                    sidebar.classList.add('left-[-300px]');
                    sidebar.style.left = '-300px';
                    main.style.left = '300px';
                    main.style.paddingLeft = '0px';
                }
            }
        </script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        </script>
</body>

</html>
