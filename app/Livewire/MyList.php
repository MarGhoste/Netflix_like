<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Genre; // Necesario para el sidebar
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination; // Importar para usar paginación

class MyList extends Component
{
    // Usar el trait WithPagination para manejar la paginación de la lista
    use WithPagination;

    public function render()
    {
        // 1. Verificar si el usuario está autenticado
        if (!Auth::check()) {
            // Si no está autenticado, redirigir al dashboard o login
            return redirect()->route('dashboard');
        }

        $user = Auth::user();

        // 2. Cargar las películas favoritas del usuario (Mi Lista)
        // Usamos la relación 'favorites()' definida en el modelo User
        $favoriteMovies = $user->favorites()
            // Opcional: ordenar por fecha en que se añadió (más reciente primero)
            ->orderByDesc('movie_favorites.created_at')
            ->paginate(24); // Paginamos para listas largas

        // 3. Cargar los géneros para el sidebar (como en MovieDetails)
        $sidebarGenres = Genre::orderBy('name')->get();

        return view('livewire.my-list', [
            'sidebarGenres' => $sidebarGenres,
            'favoriteMovies' => $favoriteMovies,
        ])
            // Usamos la plantilla principal (layouts.app)
            ->layout('layouts.app');
    }
}
