<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\Genre; // <-- [NUEVO] Importación necesaria para la lógica de géneros

class Dashboard extends Component
{
    public $heroMovie;
    public $newMovies;
    public $trendingMovies;
    public $recommendedMovies;
    public $genresWithMovies; // <-- [NUEVO] Propiedad para los carruseles por género

    public function mount()
    {
        // Lógica de carga de datos existente
        $this->heroMovie = Movie::where('is_published', true)->where('is_trending', true)->latest('id')->first();
        $this->newMovies = Movie::where('is_published', true)->where('is_new', true)->latest('release_date')->take(12)->get();
        $this->trendingMovies = Movie::where('is_published', true)->where('is_trending', true)->latest('created_at')->take(12)->get();
        $this->recommendedMovies = $this->newMovies;

        // --- Lógica de carga de carruseles por género ---
        // Define los géneros que quieres destacar en el dashboard
        $this->genresWithMovies = Genre::with(['movies' => function ($query) {
            // Filtra solo películas publicadas y limita la cantidad por carrusel
            $query->where('is_published', true)
                ->limit(15);
        }])
            ->get() // Obtiene TODOS los géneros
            // Filtra solo los géneros que tienen películas asociadas después de la consulta
            ->filter(fn($genre) => $genre->movies->count() > 0);
    }

    public function render()
    {
        return view('livewire.dashboard')
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
