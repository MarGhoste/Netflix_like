<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating; // Asumiendo que tiene un modelo Rating
use App\Models\Movie;  // Asumiendo que tiene el modelo Movie

class MovieRating extends Component
{
    // Propiedad pública que Livewire inyectará desde la vista
    public Movie $movie;

    // Estado local para guardar la votación del usuario actual
    public int $userVote = 0; // 1: Like, -1: Dislike, 0: No votado

    // Propiedades para mostrar el conteo total (opcional, pero útil)
    public int $likesCount = 0;
    public int $dislikesCount = 0;

    public function mount(Movie $movie)
    {
        $this->movie = $movie;

        // 1. Cargar el voto del usuario al iniciar
        if (Auth::check()) {
            $rating = Rating::where('user_id', Auth::id())
                ->where('movie_id', $this->movie->id)
                ->first();

            if ($rating) {
                $this->userVote = $rating->rating; // Esto será 1 o -1
            }
        }

        // 2. Cargar el conteo inicial
        $this->updateCounts();
    }

    // Función de ayuda para actualizar el conteo total
    private function updateCounts()
    {
        // Contamos todos los votos positivos (Like = 1)
        $this->likesCount = $this->movie->ratings()->where('rating', 1)->count();
        // Contamos todos los votos negativos (Dislike = -1)
        $this->dislikesCount = $this->movie->ratings()->where('rating', -1)->count();
    }

    // Método para manejar el voto (Like o Dislike)
    public function vote(int $type)
    {
        // 1. Verificar si el usuario está autenticado
        if (!Auth::check()) {
            // Opcional: Redirigir al login o mostrar un mensaje
            session()->flash('error', 'Debes iniciar sesión para votar.');
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $movieId = $this->movie->id;

        // Buscar si ya existe un voto del usuario para esta película
        $rating = Rating::firstOrNew([
            'user_id' => $userId,
            'movie_id' => $movieId
        ]);

        if ($this->userVote === $type) {
            // Caso 1: El usuario hace clic en el mismo botón (deshacer el voto)
            $rating->delete();
            $this->userVote = 0;
        } else {
            // Caso 2: Votar o cambiar el voto
            $rating->rating = $type;
            $rating->save();
            $this->userVote = $type;
        }

        // 3. Recalcular y actualizar la vista
        $this->updateCounts();
    }

    public function render()
    {
        return view('livewire.movie-rating');
    }
}
