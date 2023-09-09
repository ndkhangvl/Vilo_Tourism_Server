<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    @include('constraint')
</head>

<body>
    @include('header')
    <div id="main">
        <div class="container bg-white shadow">
            {{-- Modal --}}
            <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Toggle modal
            </button>
            <!-- Main modal -->
            <div id="defaultModal" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Thông tin địa điểm
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="defaultModal">
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
                            <form action="/admin/place/add" class="" method="POST">
                                <div class="grid grid-rows-4 grid-flow-col gap-4">
                                    <div>
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thông
                                            tin</label>
                                        <input type="email" name="email" id="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="name@company.com" required>
                                    </div>
                                    <div>
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thông
                                            tin</label>
                                        <input type="email" name="email" id="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="name@company.com" required>
                                    </div>
                                    <div>
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thông
                                            tin</label>
                                        <input type="email" name="email" id="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="name@company.com" required>
                                    </div>
                                    <div>
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thông
                                            tin</label>
                                        <input type="email" name="email" id="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="name@company.com" required>
                                    </div>
                                    <div>
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thông
                                            tin</label>
                                        <input type="email" name="email" id="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="name@company.com" required>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="defaultModal" type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                accept</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table for VLPlace --}}
            <div class="overflow-x-auto p-3">
                <table class="border-collapse">
                    <thead>
                        <tr>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600" style="width: 5%">Mã
                                địa
                                điểm</th>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Tên địa điểm</th>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Địa chỉ</th>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Thời gian mở cửa</th>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Thời gian đóng cửa</th>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Số điện thoại</th>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Email</th>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Mô tả địa điểm</th>
                            <th class="p-2 text-center whitespace-nowrap border text-blue-600">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vlplaces as $vlplace)
                            <tr>
                                <td class="text-center align-middle border">{{ $vlplace->id_place }}</td>
                                <td class="text-center align-middle truncate border">{{ $vlplace->name_place }}</td>
                                <td class="text-center align-middle truncate border">{{ $vlplace->address_place }}</td>
                                <td class="text-center align-middle border">{{ $vlplace->start_time }}</td>
                                <td class="text-center align-middle border">{{ $vlplace->end_time }}</td>
                                <td class="text-center align-middle border">{{ $vlplace->phone_place }}</td>
                                <td class="text-center align-middle border">{{ $vlplace->email_contact_place }}</td>
                                <td class="text-center align-middle truncate border">{{ $vlplace->describe_place }}
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
</body>

</html>
