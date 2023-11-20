<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gợi ý địa điểm</title>
    @include('/components.constraint')
    <style>
        .devider {
            display: block;
            width: 70px;
            background-color: green;
            height: 2px;
            margin-left: auto;
            margin-right: auto;
        }

        .title_introduction {
            width: 100%;
            padding-right: 10%;
            padding-left: 10%;
            margin-right: auto;
            margin-left: auto;
        }

        .dotted-list {
            list-style-type: disc;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    @include('/components.header_home')
    <div class="container pt-6 px-16 mx-auto sm:w-750 md:w-970 lg:w-1170">
        <div class="text-center pb-2">
            <h1 class="text-2xl font-bold italic text-green-600">Gợi ý theo sở thích</h1>
        </div>
        <span class="devider mb-2"></span>
        <div class="border shadow pb-2">
            <h1 class="italic p-2">Bạn thích loại địa điểm nào?</h1>
            <form action="/recommend-content" method="POST" id="recommendForm">
                @csrf
                <div class="grid grid-cols-4 gap-4 p-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="history" value="Cửa hàng lưu niệm"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Cửa hàng lưu niệm</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" name="landscape" value="Kiến trúc và nghệ thuật"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Kiến trúc và nghệ thuật</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" name="view" value="Tìm hiểu lịch sử"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Tìm hiểu lịch sử</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="chua" value="Văn hóa và lịch sử"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Văn hóa và lịch sử</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="tuongdai" value="Ẩm thực đa dạng"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Ẩm thực đa dạng</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="khust" value="Khu nghỉ dưỡng"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Khu nghỉ dưỡng</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="khust" value="Câu cá"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Câu cá</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="khust" value="Trò chơi dân gian"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Trò chơi dân gian</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="khust" value="Phong cảnh đẹp"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Phong cảnh đẹp</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="khust" value="Khu tưởng niệm"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Khu tưởng niệm</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="khust" value="Đền & tượng đài"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Đền & tượng đài</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="khust" value="Làng nghề"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Làng nghề</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="khust" value="Chùa"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Chùa</span>
                    </label>
                </div>
                <button type="submit"
                    class="w-40 block mx-auto text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Gợi
                    ý</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-2" id="dynamicContentContainer">
            </div>
        </div>
        <div class="text-center pb-2">
            <h1 class="text-2xl font-bold italic text-green-600">Gợi ý cho bạn</h1>
        </div>
        <span class="devider mb-2"></span>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-2 border shadow mb-2">
            @foreach ($responseData as $responseData)
                @if ($loop->index < 6)
                    <div class="relative rounded overflow-hidden">
                        <a href="/detailplace/{{ $responseData['id'] }}" target="_blank">
                            <img class="w-full" style="height: 300px" src="{{ $responseData['image_url'] }}" />
                        </a>
                        <p class="absolute bg-gray-600 bg-opacity-50 text-white text-center inset-x-0 bottom-0">
                            {{ $responseData['name'] }}</p>
                    </div>
                @else
                @break
            @endif
        @endforeach
    </div>
</div>
@include('/components.footer')
<script>
    $(document).ready(function() {
        // Intercept the form submission
        $('#recommendForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting the traditional way

            // Serialize the form data
            var formData = $(this).serialize();

            // Submit the form via AJAX
            $.ajax({
                type: 'POST',
                url: '/recommend-content',
                data: formData,
                success: function(response) {
                    var responseData = response.responseData2;

                    var container = $('#dynamicContentContainer');

                    container.empty();

                    // Iterate through the data and append HTML dynamically
                    $.each(responseData, function(index, data) {
                        if (index < 6) {
                            var html = `
                    <div class="relative rounded overflow-hidden">
                        <a href="/detailplace/${data.id_place}" target="_blank">
                            <img class="w-full" style="height: 300px" src="${data.image_url}" />
                        </a>
                        <p class="absolute bg-gray-600 bg-opacity-50 text-white text-center inset-x-0 bottom-0">
                            ${data.name_place}
                        </p>
                    </div>
                `;

                            // Append the HTML to the container
                            container.append(html);
                        }
                    });
                },
                error: function(error) {
                    // Handle errors here
                    console.error('Error submitting form', error);
                }
            });
        });
    });
</script>

</body>

</html>