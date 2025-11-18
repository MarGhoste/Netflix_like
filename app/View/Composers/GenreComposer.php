<?php

namespace App\View\Composers;

use App\Models\Genre;
use Illuminate\View\View;

class GenreComposer
{
    /**
     * The genre repository implementation.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    protected $genres;

    public function __construct()
    {
        // Se obtienen los géneros una vez y se cachean para la solicitud.
        $this->genres = Genre::orderBy('name')->get();
    }

    public function compose(View $view)
    {
        $view->with('sidebarGenres', $this->genres);
    }
}
