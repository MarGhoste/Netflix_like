<?php

namespace App\Http\Livewire;

use App\Models\Genre;
use App\Models\Movie;
use Livewire\Component;

class MovieDetails extends Component
{
    public Movie $movie;

    /**
     * Mount the component with the given movie.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function mount(Movie $movie)
    {
        $this->movie = $movie;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.movie-details');
    }
}
