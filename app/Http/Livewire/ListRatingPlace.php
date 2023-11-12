<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListRatingPlace extends Component
{
    use WithPagination;
    public $idPlace;

    public function mount($idPlace)
    {
        $this->idPlace = $idPlace;
    }

    public function updatedPage()
    {
        $this->dispatchBrowserEvent('rateYoUpdated');
    }

    public function render()
    {
        // $this->emit('refreshRateYo');

        // \Log::info('refreshRateYo event fired');

        $listRating = DB::table('VLRating')
            ->join('users', 'VLRating.id_user', '=', 'users.id')
            ->select('users.id', 'users.name', 'VLRating.place_ratings')
            ->where('id_place', $this->idPlace)
            ->paginate(10);
        return view('livewire.list-rating-place', compact('listRating'));
    }
}
