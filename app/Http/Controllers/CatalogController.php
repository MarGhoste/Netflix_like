<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; // Necesario para las consultas de SUM

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
                $title = 'Las Películas más Vistas (Basado en Likes 👍)';
                $description = 'El Top Global ordenado por la puntuación neta de la comunidad.';

                // LÓGICA DE TENDENCIAS DINÁMICAS (JOIN para calcular puntuación)
                $query->leftJoin('ratings', 'movies.id', '=', 'ratings.movie_id')

                    // Agrupamos por el ID de la película, que es suficiente para que la BD identifique cada registro único.
                    // Esto es más robusto que listar todas las columnas manualmente.
                    ->groupBy('movies.id')
                    ->addSelect(DB::raw('SUM(ratings.rating) as net_score'))
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

        // **<< INICIO DEL CAMBIO CLAVE >>**
        // 1. Consulta necesaria para el sidebar: Obtenemos todos los géneros.
        $sidebarGenres = Genre::orderBy('name')->get();

        // 2. Pasamos la lista de géneros a la vista
        return view('catalog', [
            'pageTitle' => $title,
            'pageDescription' => $description,
            'movies' => $movies,
            'sidebarGenres' => $sidebarGenres, // <-- ¡Esto inyecta los géneros al layout!
        ]);
        // **<< FIN DEL CAMBIO CLAVE >>**
    }
}
