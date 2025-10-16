<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie; // Asumiendo que tienes un modelo Movie

class CatalogController extends Controller
{
    public function show($category)
    {
        // 1. Lógica para determinar el Título y la Descripción
        $title = '';
        $description = '';
        $movies = collect(); // Inicializamos una colección vacía

        // Simulación de la lógica de datos (cuando implementes la DB, esto será real)
        switch ($category) {
            case 'recomendados':
                $title = 'Recomendados para ti';
                $description = 'Una selección personalizada basada en tu historial.';
                // Aquí iría la lógica: $movies = Movie::getRecommended()->paginate(20);
                // Usaremos un array de ejemplo por ahora.
                $movies = range(1, 20); 
                break;
            case 'nuevo':
                $title = 'Lo más Nuevo en Streaming';
                $description = 'Descubre los últimos lanzamientos de la semana.';
                $movies = range(21, 40);
                break;
            case 'tendencias':
                $title = 'Las Películas más Vistas';
                $description = 'El Top Global de lo que el mundo está mirando.';
                $movies = range(41, 60);
                break;
            default:
                abort(404); // Si la categoría no existe, error
        }

        // 2. Retornar la ÚNICA vista, pasándole los datos dinámicos
        return view('catalog', [
            'pageTitle' => $title,
            'pageDescription' => $description,
            'movies' => $movies, // La lista de películas/series
        ]);
    }
}