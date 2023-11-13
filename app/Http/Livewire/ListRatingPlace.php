<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListRatingPlace extends Component
{
    use WithPagination;
    public $idPlace;
    // protected $paginationTheme = 'tailwincss';

    public function changePage($event)
    {
        $this->emit('pageChanged');
    }


    public function mount($idPlace)
    {
        $this->idPlace = $idPlace;
    }

    public function paginationView()
    {
        return '/components.pagination-custom';
    }

    public function render()
    {
        // $this->emit('refreshRateYo');

        // \Log::info('refreshRateYo event fired');

        $listRating = DB::table('VLRating')
            ->join('users', 'VLRating.id_user', '=', 'users.id')
            ->select('users.id', 'users.name', 'VLRating.place_ratings', 'VLRating.date_post_rating')
            ->where('id_place', $this->idPlace)
            ->orderBy('VLRating.date_post_rating', 'desc')
            ->paginate(5);
        return view('livewire.list-rating-place', compact('listRating'));
    }
}
