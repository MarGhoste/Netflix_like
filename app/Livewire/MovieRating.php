<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;
use App\Models\Movie;

class MovieRating extends Component
{
    // Propiedad inyectada desde la vista
    public Movie $movie;

    // Estado para la votación (1: Like, -1: Dislike, 0: No votado)
    public int $userVote = 0;

    // Conteo de votos
    public int $likesCount = 0;
    public int $dislikesCount = 0;

    // Estado para la Lista de Favoritos
    public bool $isFavorite = false;

    // =========================================================================
    // ARREGLO CLAVE: Define qué eventos estamos escuchando y qué método ejecutar.
    // =========================================================================
    protected $listeners = [
        // Cuando se recibe 'heroFavoriteToggled', se ejecuta el método 'handleHeroFavoriteToggle'
        'heroFavoriteToggled',
    ];


    public function mount(Movie $movie)
    {
        $this->movie = $movie;

        if (Auth::check()) {
            $user = Auth::user();

            // 1. Cargar el voto del usuario
            $rating = Rating::where('user_id', $user->id)
                ->where('movie_id', $this->movie->id)
                ->first();

            if ($rating) {
                $this->userVote = $rating->rating;
            }

            // 2. Cargar el estado de favorito (Verificación directa en la relación)
            $this->isFavorite = $user->favorites()
                ->where('movie_favorites.movie_id', $this->movie->id)
                ->exists();
        }

        $this->updateCounts();
    }

    private function updateCounts()
    {
        $this->likesCount = $this->movie->ratings()->where('rating', 1)->count();
        $this->dislikesCount = $this->movie->ratings()->where('rating', -1)->count();
    }

    // =========================================================================
    // NUEVO MÉTODO PUENTE: Escucha el evento del Hero Banner
    // =========================================================================
    public function handleHeroFavoriteToggle(int $movieId)
    {
        // El evento nos envía el ID de la película.
        // Solo procedemos si el ID coincide con la película que maneja ESTA INSTANCIA.
        if ($this->movie->id === $movieId) {
            // Llamamos a la lógica principal de la lista, sin argumentos forzados.
            $this->toggleFavorite();

            // Opcional: Emitir un evento para que otros componentes que muestren 
            // la lista de favoritos sepan que el contenido ha cambiado.
            $this->dispatch('favoriteStatusUpdated');
        }
    }


    /**
     * Alterna el estado de favorito (Añadir/Quitar de Mi Lista).
     * @param bool|null $forceAction Si se fuerza a añadir (true) o eliminar (false).
     */
    public function toggleFavorite($forceAction = null)
    {
        if (!Auth::check()) {
            session()->flash('error_favorite', 'Debes iniciar sesión para gestionar tu lista.');
            return;
        }

        $user = Auth::user();
        $movieId = $this->movie->id;

        // --- Lógica forzada (llamada desde vote()) ---
        if ($forceAction === true) {
            if (!$this->isFavorite) {
                $user->favorites()->attach($movieId);
                $this->isFavorite = true;
            }
        } elseif ($forceAction === false) {
            if ($this->isFavorite) {
                $user->favorites()->detach($movieId);
                $this->isFavorite = false;
            }
        }

        // --- Lógica del botón de lista (+Mi Lista) ---
        // ESTE CAMINO ES EL QUE SE EJECUTA AHORA POR EL EVENTO DEL HERO
        else {
            $user->favorites()->toggle($movieId);

            // Recalculamos el estado
            $this->isFavorite = $user->favorites()
                ->where('movie_favorites.movie_id', $movieId)
                ->exists();

            if ($this->isFavorite) {
                session()->flash('message_favorite', '¡Película añadida a Mi Lista!');
            } else {
                session()->flash('message_favorite', 'Película eliminada de Mi Lista.');
            }
        }
    }


    // Método principal para manejar el voto (Like o Dislike)
    public function vote(int $type)
    {
        // ... (Tu lógica existente de vote permanece igual) ...
        if (!Auth::check()) {
            session()->flash('error_rating', 'Debes iniciar sesión para votar.');
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $movieId = $this->movie->id;

        $rating = Rating::firstOrNew([
            'user_id' => $userId,
            'movie_id' => $movieId
        ]);

        if ($this->userVote === $type) {
            // Caso 1: Deshacer el voto
            $rating->delete();
            $this->userVote = 0;

            // INTEGRACIÓN: Si se deshace el voto, también se quita de favoritos
            $this->toggleFavorite(false);
        } else {
            // Caso 2: Votar o cambiar el voto
            $rating->rating = $type;
            $rating->save();
            $this->userVote = $type;

            // INTEGRACIÓN: Si el voto es LIKE (1), se añade a favoritos (Mi Lista)
            if ($type === 1) {
                $this->toggleFavorite(true);
            } elseif ($type === -1) {
                // Si da Dislike (-1), la quitamos de la lista si estaba.
                $this->toggleFavorite(false);
            }
        }

        // Recalcular y actualizar la vista
        $this->updateCounts();
    }

    public function render()
    {
        return view('livewire.movie-rating');
    }
}
