<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recommendations Place</title>
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
            <h1 class="text-2xl font-bold italic text-green-600">{{ trans('msg.recommend_like') }}</h1>
        </div>
        <span class="devider mb-2"></span>
        <div class="border shadow pb-2">
            <h1 class="italic p-2">{{ trans('msg.what_type') }}</h1>
            <form action="/recommend-content" method="POST" id="recommendForm">
                @csrf
                <div class="grid grid-cols-4 gap-4 p-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="souvneirStore" value="Cửa_hàng_lưu_niệm"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">{{ trans('msg.souvneir_store') }}</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" name="archArt" value="Kiến_trúc_và_nghệ_thuật"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">{{ trans('msg.arch_art') }}</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" name="culHistory" value="Văn_hóa_và_lịch_sử"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">{{ trans('msg.cul_history') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="diCuisine" value="Ẩm_thực_đa_dạng"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">{{ trans('msg.di_cuisine') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="resort" value="Khu_nghỉ_dưỡng"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">{{ trans('msg.resort') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="goFishing" value="Câu_cá"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">{{ trans('msg.go_fishing') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="folkGames" value="Trò_chơi_dân_gian"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">{{ trans('msg.folk_game') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="scenic" value="Phong_cảnh_đẹp"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">{{ trans('msg.scenic') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="meArea" value="Khu_tưởng_niệm"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">{{ trans('msg.me_area') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="temMonuments" value="Đền_&_tượng_đài"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">{{ trans('msg.tem_monuments') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="crafVillage" value="Làng_nghề"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">{{ trans('msg.craf_village') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="pagoda" value="Chùa"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2">{{ trans('msg.pagoda') }}</span>
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
            <h1 class="text-2xl font-bold italic text-green-600">{{ trans('msg.recommend_for_you') }}</h1>
        </div>
        <span class="devider mb-2"></span>
        @if (count($responseData) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-2 border shadow mb-2">
                @foreach ($responseData as $responseItem)
                    @if ($loop->index < 6)
                        <div class="relative rounded overflow-hidden">
                            <a href="/detailplace/{{ $responseItem['id'] }}" target="_blank">
                                <img class="w-full" style="height: 300px" src="{{ $responseItem['image_url'] }}" />
                            </a>
                            <p class="absolute bg-gray-600 bg-opacity-50 text-white text-center inset-x-0 bottom-0">
                                {{ $responseItem['name'] }}
                            </p>
                        </div>
                    @else
                    @break
                @endif
            @endforeach
        @else
            <div class="gap-3 p-2 border shadow mb-2">
                <p>{{ trans('msg.one_rating') }}</p>
            </div>
    @endif

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
                    console.log(responseData);
                    var container = $('#dynamicContentContainer');

                    container.empty();
                    if (responseData.length == 0) {
                        // container.empty();
                        Swal.fire("{{ trans('msg.one_option') }}");
                        // container.append(`<div><p>Hãy chọn ít nhất 1 lựa chọn</p></div>`);
                    } else {
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
                    }
                    // Iterate through the data and append HTML dynamically
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
