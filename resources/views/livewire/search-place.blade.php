<div>
    <div class="w-full border shadow mb-4 rounded-lg p-2">
        <input type="text" id="search_place" name="search_place" wire:model.debounce.350ms="searchTerm"
            class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        <div class="flex gap-2">
            <div class="w-1/3 pt-2"><select
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="idArea">
                    <option value="">Chọn khu vực</option>
                    <option value="1000">Huyện Bình Tân</option>
                    <option value="1001">Huyện Long Hồ</option>
                    <option value="1002">Huyện Mang Thít</option>
                    <option value="1003">Huyện Tam Bình</option>
                    <option value="1004">Huyện Trà Ôn</option>
                    <option value="1005">Huyện Vũng Liêm</option>
                    <option value="1006">Thành phố Vĩnh Long</option>
                    <option value="1007">Thị xã Bình Minh</option>
                </select></div>
            <div class="w-1/3 pt-2"><select
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="idFree">
                    <option value="">Chọn phí</option>
                    <option value="3000">Miễn phí</option>
                    <option value="3001">Có phí</option>
                </select>
            </div>
            <div class="w-1/3 pt-2"><select
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="idTypeService">
                    <option value="">Chọn thể loại du lịch</option>
                    <option value="4000">Du lịch sinh thái</option>
                    <option value="4001">Du lịch làng nghề</option>
                    <option value="4002">Du lịch lịch sử - văn hóa</option>
                    <option value="4003">Du lịch tâm linh</option>
                    <option value="4004">Du lịch trở về nguồn cội</option>
                </select>
            </div>
        </div>
        <hr class="m-2 mx-auto w-24 h-1 bg-green-700" />
    </div>
    <div class="w-full shadow mb-4">
        <div class="p-2">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 md:grid-cols-3">
                @foreach ($vlplace as $vlplace)
                    <div class="relative shadow bg-gray-50 dark:bg-gray-800">
                        <a href="/detailplace/{{ $vlplace->id_place }}"> <img src="{{ $vlplace->image_url }}"
                                alt="" class="object-cover w-full h-64">
                            <div class="p-3 flex flex-col">
                                <p
                                    class="text-xl font-bold tracking-tight text-gray-900 dark:text-gray-300 line-clamp-1 hover:text-green-500">
                                    {{ $vlplace->name_place }}
                                </p>
                                <p class="line-clamp-1">{{ $vlplace->address_place }}</p>
                                <div class="flex place-items-center">
                                    <div class="rateYoPlace" data-rating="{{ $vlplace->rating }}"></div>
                                    <p class="italic">Lượt xem: {{ $vlplace->view_place }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        changeData();
    });

    document.addEventListener('livewire:load', function() {
        Livewire.on('renderedPlace', function() {
            changeData();
        });
    });

    function changeData() {
        const elements = document.getElementsByClassName('rateYoPlace');

        for (let index = 0; index < elements.length; index++) {

            const element = elements[index];
            var oldRateYo = $(element).rateYo();
            // console.log(oldRateYo);

            if (oldRateYo) {
                oldRateYo.rateYo("destroy");
            }

            $(element).rateYo({
                rating: element.getAttribute('data-rating'),
                starWidth: "16px",
                fullStar: true,
                readOnly: true,
            });
        }
    }
</script>
