<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gợi ý địa điểm</title>
    @include('/components.constraint')
    <style>
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
        <div class="border shadow pb-2">
            <h1 class="italic p-2">Bạn thích loại địa điểm nào?</h1>
            <form action="/recommend-content" method="POST" id="recommendForm">
                @csrf
                <div class="flex gap-4 p-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="history" value="Lịch sử"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Lịch sử</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" name="landscape" value="Khung cảnh đẹp"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Phong cảnh đẹp</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" name="view" value="Tìm hiểu lịch sử"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Tìm hiểu lịch sử</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="chua" value="Chùa"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Chùa</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="tuongdai" value="Đền tượng đài"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Đền, tượng đài</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="khust" value="Khu sinh thái"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">Khu sinh thái</span>
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
            <h1 class="text-2xl font-bold capitalize italic text-green-600">Gợi ý cho bạn</h1>
        </div>
        <hr class="p-2">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-2">
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
