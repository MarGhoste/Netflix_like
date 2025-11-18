<?php

namespace App\Livewire;

use App\Models\Genre;
use Livewire\Component;

class SearchMovies extends Component
{
    public function render()
    {
        $sidebarGenres = Genre::orderBy('name')->get(); // Consultamos los géneros
        return view('livewire.search-movies', [
            'sidebarGenres' => $sidebarGenres,
        ]); // Los pasamos a la vista
    }
}
