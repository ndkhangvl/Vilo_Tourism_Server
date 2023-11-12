<div>
    <div class="border shadow p-2 mt-4 gap-2 table-data" style="height: 600px;">
        @foreach ($listRating as $index => $listRatings)
            <div class="pb-2">
                <p class="dynamic-content">{{ $listRatings->name }} and {{ $listRatings->place_ratings }}</p>
                <div class="listRateYo" data-rating="{{ $listRatings->place_ratings }}"></div>
            </div>
        @endforeach
        <div id="pagination-links" class="d-flex justify-content-center">
            {{ $listRating->appends(request()->all())->links() }}
        </div>
    </div>
</div>
