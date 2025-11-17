<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; // ¡Necesario para las consultas de SUM!

class CatalogController extends Controller
{
    public function show($category)
    {
        $title = '';
        $description = '';
        $categorySlug = strtolower($category);

        // La consulta inicial selecciona todas las columnas de 'movies'
        $query = Movie::where('is_published', true)->select('movies.*');

        switch ($categorySlug) {
            case 'nuevo':
            case 'novedades':
                $title = 'Lo más Nuevo en Streaming';
                $description = 'Descubre los últimos lanzamientos de la semana.';
                $query->where('is_new', true)->latest('release_date');
                break;

            case 'tendencias':
                $title = 'Las Películas más Vistas (Basado en Votos)';
                $description = 'El Top Global ordenado por la puntuación neta de la comunidad.';

                // LÓGICA DE TENDENCIAS DINÁMICAS (JOIN para calcular puntuación)

                // 1. Usar Left Join con la tabla 'ratings'
                // Unimos la tabla de películas con la de votos para calcular la popularidad.
                $query->leftJoin('ratings', 'movies.id', '=', 'ratings.movie_id')

                    // 2. Agrupar por las columnas de la tabla movies
                    // Necesario para poder usar la función SUM por película.
                    ->groupBy('movies.id', 'movies.title', 'movies.image', 'movies.description', 'movies.release_date', 'movies.is_published', 'movies.is_new', 'movies.is_trending', 'movies.created_at', 'movies.updated_at', 'movies.slug')

                    // 3. Seleccionar las columnas originales de la película y calcular la puntuación neta (SUM(rating))
                    // La columna 'net_score' es temporal para ordenar.
                    ->addSelect(DB::raw('SUM(ratings.rating) as net_score'))

                    // 4. Ordenar por la puntuación neta (de mayor a menor)
                    ->orderByDesc('net_score');

                break;

            case 'recomendados':
                $title = 'Recomendados para ti';
                $description = 'Una selección personalizada basada en el catálogo.';
                $query->latest('release_date');
                break;

            default:
                // Búsqueda de GÉNERO (Lógica Robusta)
                $potentialName = ucwords(str_replace('-', ' ', $categorySlug));

                $genre = Genre::where('name', $potentialName)
                    ->orWhereRaw('LOWER(name) = ?', [$categorySlug])
                    ->first();

                if ($genre) {
                    $title = 'Catálogo de ' . $genre->name;
                    $description = 'Explora todas las películas del género ' . $genre->name . '.';

                    // Filtra las películas que tienen este género asociado
                    $query->whereHas('genres', function ($q) use ($genre) {
                        $q->where('genre_id', $genre->id);
                    })->latest('release_date');
                } else {
                    abort(404);
                }
                break;
        }

        // Ejecuta la consulta y aplica paginación
        $movies = $query->paginate(24);

        return view('catalog', [
            'pageTitle' => $title,
            'pageDescription' => $description,
            'movies' => $movies,
        ]);
    }
}
