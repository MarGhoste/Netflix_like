<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\Genre;

class Dashboard extends Component
{
    public $heroMovie;
    public $newMovies;
    public $trendingMovies;
    public $recommendedMovies;
    public $genresWithMovies; // Propiedad para los carruseles por género

    public function mount()
    {
        // Lógica de carga de datos existente
        $this->heroMovie = Movie::where('is_published', true)->where('is_trending', true)->latest('id')->first();
        $this->newMovies = Movie::where('is_published', true)->where('is_new', true)->latest('release_date')->take(12)->get();
        $this->trendingMovies = Movie::where('is_published', true)->where('is_trending', true)->latest('created_at')->take(12)->get();
        $this->recommendedMovies = $this->newMovies;

        // --- Lógica de carga de carruseles por género (se mantiene) ---
        $this->genresWithMovies = Genre::with(['movies' => function ($query) {
            $query->where('is_published', true)
                ->limit(15);
        }])
            ->get()
            ->filter(fn($genre) => $genre->movies->count() > 0);
    }

    public function toggleHeroFavorite(int $movieId)
    {
        // Disparamos un evento global con el ID de la película.
        // El componente MovieRating que tenga este ID lo escuchará.
        $this->dispatch('heroFavoriteToggled', movieId: $movieId);
    }


    public function render()
    {
        // **<< INICIO DEL CAMBIO >>**
        // 1. Consultamos los géneros para el sidebar (todos, ordenados por nombre)
        $sidebarGenres = Genre::orderBy('name')->get();

        // 2. Pasamos esta nueva variable a la vista
        return view('livewire.dashboard', [
            'sidebarGenres' => $sidebarGenres // <-- Lista de géneros para el menú
        ])
            // **<< FIN DEL CAMBIO >>**
            ->layout('layouts.app');
    }

    public function logout()
    {
        // ... (Lógica de logout) ...
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }
}
