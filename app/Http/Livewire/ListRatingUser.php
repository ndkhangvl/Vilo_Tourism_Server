<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListRatingUser extends Component
{
    use WithPagination;
    public $idUser;
    public function changePage($event)
    {
        $this->emit('pageChanged');
    }

    public function mount($idUser)
    {
        $this->idUser = $idUser;
    }
    public function paginationView()
    {
        return '/components.pagination-custom';
    }

    public function deleteData($idPlace, $idUser)
    {
        DB::table('VLRating')->where('id_place', $idPlace)->where('id_user', $idUser)->delete();
        $this->emit('dataDeleted');
    }


    public function render()
    {
        // $listRating = DB::table('VLRating')
        //     ->join('users', 'VLRating.id_user', '=', 'users.id')
        //     ->select('users.id', 'users.name', 'VLRating.place_ratings', 'VLRating.date_post_rating')
        //     // ->where('id_place', $this->idPlace)
        //     ->orderBy('VLRating.date_post_rating', 'desc')
        //     ->paginate(5);
        $listRating = DB::table('vlrating as vlr')
            ->join('vlplace as vlp', 'vlr.id_place', '=', 'vlp.id_place')
            ->where('vlr.id_user', '=', $this->idUser)
            ->select('vlr.*', 'vlp.name_place')
            ->orderBy('vlr.date_post_rating', 'desc')
            ->paginate(4);

        //listRating = DB::table('VLRating')->join('VLRating.id_place','=','VLPlace.id_place')->where('id_user', $this->idUser)->paginate(5);
        $this->emit('renderedPlace');
        return view('livewire.list-rating-user', compact('listRating'));
    }
}
