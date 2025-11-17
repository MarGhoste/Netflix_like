<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Collection; // Asumiendo que tienes un modelo Movie

class CatalogController extends Controller
{
    public function show($category)
    {
        // Variables por defecto
        $title = '';
        $description = '';

        // Inicia la consulta con las películas publicadas
        $query = Movie::where('is_published', true);

        switch ($category) {
            case 'nuevo':
                $title = 'Lo más Nuevo en Streaming';
                $description = 'Descubre los últimos lanzamientos de la semana.';
                // Filtra solo por las que tienen el flag 'is_new' en true
                $query->where('is_new', true)->latest('release_date');
                break;

            case 'tendencias':
                $title = 'Las Películas más Vistas';
                $description = 'El Top Global de lo que el mundo está mirando.';
                // Filtra solo por las que tienen el flag 'is_trending' en true
                $query->where('is_trending', true)->latest('created_at');
                break;

            case 'recomendados':
                // Si aún no tienes lógica de recomendación, puedes mostrar las novedades o todo
                $title = 'Recomendados para ti';
                $description = 'Una selección personalizada basada en el catálogo.';
                $query->latest('release_date'); // Mostrar todas las publicadas por fecha
                break;

            default:
                abort(404); // Si la categoría no existe
        }

        // Ejecuta la consulta y aplica paginación (ej. 24 películas por página)
        $movies = $query->paginate(24);

        // Retorna la vista única (catalog.blade.php) con los datos
        return view('catalog', [
            'pageTitle' => $title,
            'pageDescription' => $description,
            'movies' => $movies, // <-- Ahora son datos reales de la BD
        ]);
    }
}
