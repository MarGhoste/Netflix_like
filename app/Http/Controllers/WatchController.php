<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    /**
     * Muestra la vista de reproducción para una película específica y calcula la recomendación.
     */
    public function show(Movie $movie) // Ya tienes la película completa aquí
    {
        // 1. Verifica si hay una URL de tráiler/video disponible
        if (empty($movie->trailer_url)) {
            return redirect()->route('movie.show', ['id' => $movie->id])
                ->with('error', 'El video de esta película no está disponible actualmente.');
        }

        // 2. Lógica de Recomendación: Encuentra la siguiente película en la BD
        $nextMovie = Movie::where('id', '>', $movie->id)->first() ?? Movie::first();

        // 3. Carga la vista de reproducción
        return view('watch', compact('movie', 'nextMovie'));
    }
}
