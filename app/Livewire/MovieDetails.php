<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Movie; // Importa el modelo

class MovieDetails extends Component
{
    // 1. Define una propiedad pública para almacenar el objeto de la película
    public $movie;

    // 2. Método Mount: Se ejecuta cuando el componente se inicializa
    // Recibe el ID de la película desde la URL
    public function mount($id)
    {
        // Busca la película por ID o falla (error 404)
        $this->movie = Movie::findOrFail($id);
    }

    // 3. Render: Envía la vista
    public function render()
    {
        return view('livewire.movie-details');
        // NOTA: Livewire envía automáticamente la propiedad $this->movie a la vista
    }
}
