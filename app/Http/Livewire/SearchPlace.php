<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SearchPlace extends Component
{
    public $vlplace;
    public $searchTerm;
    public $idArea;
    public $idFree;
    public $idTypeService;

    public function changePage($event)
    {
        $this->emit('pageChanged');
    }

    public function rendered($event)
    {
        // Xử lý sau khi component đã được render lại
        $this->emit('searchPlaceRendered');
    }

    public function render()
    {
        $query = DB::table('vlplace')
            ->select('vlplace.*', 'vlr.rating')
            ->join(DB::raw('(SELECT id_place, CAST(AVG(CAST(place_ratings AS FLOAT)) AS DECIMAL(3, 1)) AS rating FROM vlrating GROUP BY id_place) as vlr'), 'vlplace.id_place', '=', 'vlr.id_place')
            ->whereRaw("vlplace.name_place COLLATE SQL_Latin1_General_CP1_CI_AI LIKE ?", ['%' . $this->searchTerm . '%'])
            ->when($this->idArea, function ($query) {
                $query->where('vlplace.id_area', $this->idArea);
            })
            ->when($this->idFree, function ($query) {
                $query->where('vlplace.id_price', $this->idFree);
            })
            ->when($this->idTypeService, function ($query) {
                $query->where('vlplace.id_type', $this->idTypeService);
            })
            ->orderBy('id_place');
        $this->emit('renderedPlace');
        $this->vlplace = $query->get();
        return view('livewire.search-place');
    }
}
