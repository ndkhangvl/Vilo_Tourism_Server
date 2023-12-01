<div>
    <div class="border shadow p-2 gap-2 table-data rounded-lg">
        @foreach ($listRating as $listRatings)
            <div class="flex p-2">
                <div class="l-list-rating">
                    {{-- <div class="inline-flex rounded-full bg-slate-300 text-white w-12 h-12 items-center justify-center">
                        <span class="text-md font-medium">{{ strtoupper(substr($listRatings->name, 0, 1)) }}</span>
                    </div> --}}
                </div>
                <div class="r-list-rating ml-5">
                    <div class="rounded-md bg-neutral-200 p-3">
                        <a href="/detailplace/{{ $listRatings->id_place }}">
                            <p class="dynamic-content text-md font-medium hover:text-green-700">
                                {{ $listRatings->name_place }}</p>
                        </a>
                        <div class="listRateYo" data-rating="{{ $listRatings->place_ratings }}"></div>
                        <button class="text-red-500 rounded text-right pt-2"
                            wire:click="deleteData({{ $listRatings->id_place }},{{ $listRatings->id_user }})">Delete
                            rating</button>
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
    document.addEventListener('livewire:load', function() {
        Livewire.on('confirmDelete', (idPlace, idUser) => {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteData', idPlace, idUser);
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        changeData();
    });

    document.addEventListener('livewire:load', function() {
        Livewire.on('pageChanged', function() {
            changeData();
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('dataDeleted', function() {
            changeData();
            Swal.fire({
                icon: 'success',
                title: '{{ trans('msg.successful') }}',
                text: '{{ trans('msg.delete_success') }}'
            });
        })
    })

    $(function() {
        $("#rateYo-rating").rateYo({
            starWidth: "40px",
            rating: 0,
            fullStar: true,
            spacing: "10px",

        }).on("rateyo.set", function(e, data) {
            $('#place_rating').val(data.rating);
            $('#formRating').submit();
        }).on("rateyo.change", function(e, data) {
            // Hiển thị văn bản khi rê vào
            var rating = data.rating;
            var feedbackText = getFeedbackText(rating);

            // Hiển thị văn bản phản hồi
            $("#feedbackText").text(feedbackText);
        });;
    });

    function getFeedbackText(rating) {
        if (rating == 0) {
            return "";
        } else if (rating === 1) {
            return "{{ __('msg.one_star') }} 😡";
        } else if (rating === 2) {
            return "{{ __('msg.two_star') }} 😤";
        } else if (rating === 3) {
            return "{{ __('msg.three_star') }} 😑";
        } else if (rating === 4) {
            return "{{ __('msg.four_star') }} 😁";
        } else {
            return "{{ __('msg.five_star') }} 🥰";
        }
    }

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
