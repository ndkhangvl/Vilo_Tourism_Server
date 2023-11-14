<div>
    <div class="border shadow p-2 mt-4 gap-2 table-data">
        @if (Auth::check())
            <div class="mb-4 p-2" wire:ignore>
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Hãy đánh giá</label>
                <div class="flex p-2">
                    <div class="l-list-rating">
                        <div
                            class="inline-flex rounded-full bg-slate-300 text-white w-12 h-12 items-center justify-center">
                            <span class="text-md font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                    </div>
                    <div class="r-list-rating ml-5">
                        <div class="relative">
                            <input type="text" id="username" name="username"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">

                            <div id="rateYo-rating" class="absolute top-0 right-0 left-0 mt-2 mr-2">
                                <!-- Your rating widget goes here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div>
                <button id="openLoginRegisterModalButton"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Open Login Modal
                </button>
            </div>
        @endif
        <hr class="p-2" />
        @foreach ($listRating as $listRatings)
            <div class="flex p-2">
                <div class="l-list-rating">
                    <div class="inline-flex rounded-full bg-slate-300 text-white w-12 h-12 items-center justify-center">
                        <span class="text-md font-medium">{{ strtoupper(substr($listRatings->name, 0, 1)) }}</span>
                    </div>
                </div>
                <div class="r-list-rating ml-5">
                    <div class="rounded-md bg-neutral-200 p-3">
                        <p class="dynamic-content text-md font-medium">{{ $listRatings->name }}</p>
                        <div class="listRateYo" data-rating="{{ $listRatings->place_ratings }}"></div>
                    </div>
                    <p class="italic text-slate-400">
                        {{ \Carbon\Carbon::parse($listRatings->date_post_rating)->format('d/m/Y') }}</p>
                </div>
            </div>
        @endforeach
        <div id="pagination-links" wire:click="changePage($event)"
            class="pagination flex justify-center items-center space-x-2">
            {{-- {{ $listRating->appends(request()->all())->links() }} --}}
            {{ $listRating->links() }}
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        changeData();
    });

    document.addEventListener('livewire:load', function() {
        Livewire.on('pageChanged', function() {
            changeData();
        });
    });
    $(function() {
        $("#rateYo-rating").rateYo({
            starWidth: "30px",
            rating: 0,
            fullStar: true,
        }).on("rateyo.set", function(e, data) {
            $('#place_rating').val(data.rating);
            $('#formRating').submit();
        });
    });

    function changeData() {
        // console.log('Change Data Clicked');
        const elements = document.getElementsByClassName('listRateYo');

        for (let index = 0; index < elements.length; index++) {

            const element = elements[index];
            // console.log(element);

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
